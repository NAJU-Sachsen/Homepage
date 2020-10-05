
<!-- mod_event_calendar -->

<?php

$local_group = 'REX_VALUE[id=4 ifempty=-1]';
$local_group_filter = 'REX_VALUE[id=1 ifempty="false"]' === 'true';
$include_all_events = 'REX_VALUE[id=3 ifempty="false"]' === 'true';
$month_filter = 'REX_VALUE[id=2 ifempty="false"]' === 'true';
$any_user_filter = $local_group_filter || $month_filter;

$start_date = date('Y') . '-01-01';
$end_date = date('Y') . '-12-31';
$months = array('Januar', 'Februar', 'März', 'April', 'Mai', 'Juni',
    'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember');

$req_month = '';
if ('events' === rex_get('filter')) {
    $local_group = rex_get('local_group', 'int', $local_group);

    if (rex_get('month', 'int', 0)) {
        $req_month = rex_get('month', 'int');

        if ($req_month != -1) {
            $start_date = date('Y') . '-' . $req_month . '-01';
            $end_date = date('Y') . '-' . $req_month . '-31';
        }
    }
} else if ($include_all_events) {
    $end_date = '9999-12-31';
}

$additional_filters = '';
$filter_target_group = rex_get('target_group');
if (!$filter_target_group) {
    $filter_target_group = 'REX_VALUE[id=5]';
}

if ($filter_target_group) {
    $event_target_group = rex_sql::factory()->escape($filter_target_group);
    $additional_filters .= " and find_in_set($event_target_group, event_target_group_type) ";
}

$filter_event_type = rex_get('event_type');
if (!$filter_event_type) {
    $filter_event_type = 'REX_VALUE[id=6]';
}

if ($filter_event_type) {
    $event_type = rex_sql::factory()->escape($filter_event_type);
    $additional_filters .= " and event_type = $event_type ";
}

if ($local_group == -1) {
    $event_query = <<<EOSQL
        select
            event_name,
            group_name,
            event_start,
            event_end,
            event_description,
            event_location,
            event_target_group,
            event_price,
            event_price_reduced,
            event_registration,
            event_link
        from
            naju_event
            join naju_local_group
            on event_group = group_id
        where
            event_start >= :start and
            event_end <= :end
            $additional_filters
		order by event_start, event_end
EOSQL;
    $events = rex_sql::factory()->setQuery($event_query,
				['start' => $start_date, 'end' => $end_date])->getArray();
} else {
    $event_query = <<<EOSQL
        select
            event_name,
            group_name,
            event_start,
            event_end,
            event_description,
            event_location,
            event_target_group,
            event_price,
            event_price_reduced,
            event_registration,
            event_link
        from
            naju_event
            join naju_local_group
            on event_group = group_id
        where
            group_id = :group and
            event_start >= :start and
            event_end <= :end
            $additional_filters
		order by event_start, event_end
EOSQL;
    $events = rex_sql::factory()->setQuery($event_query,
        ['group' => $local_group, 'start' => $start_date, 'end' => $end_date])->getArray();
}

?>

<section class="container-fluid">

    <?php if ($any_user_filter) : ?>
    <div class="row justify-content-center">
        <form action="<?= rex_getUrl(); ?>" method="get" class="form-inline p-3 mb-5 bg-light rounded">
            <input type="hidden" name="filter" value="events">

            <!-- local group filter -->
            <?php if ($local_group_filter) : ?>
            <label class="my-1 mr-2" for="select-local-group">Wähle deine Ortsgruppe:</label>
            <select name="local_group" id="select-local-group" class="form-control my-2 mr-sm-5">
                <option value="-1" <?= $local_group == -1 ? 'selected' : '' ?>>alle</option>
                <?php
                    $local_groups = rex_sql::factory()->setQuery('select group_id, group_name from naju_local_group')->getArray();
                    foreach ($local_groups as $group) {
                        $selected = $local_group == $group['group_id'] ? ' selected' : '';
                        echo '<option value="' . rex_escape($group['group_id']) . '"' . $selected . '>' .
                                rex_escape($group['group_name']) .
                            '</option>';
                    }
                ?>
            </select>
            <?php endif; ?>

            <!-- month filter -->
            <?php if($month_filter) : ?>
            <label class="my-1 mr-2" for="select-month">Wähle den Monat:</label>
            <select name="month" id="select-month" class="form-control my-2 mr-sm-5">
                <option value="-1" <?= $req_month == -1 ? ' selected' : '' ?>>alle</option>
                <?php
                foreach ($months as $midx => $month) {
										/* $months is a static variable, no need to escape it */
                    echo '<option value="' . ($midx+1) . '"' . ($req_month == $midx+1 ? ' selected' : '') . '>' . $month . '</option>';
                }
                ?>
            </select>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary my-2">Los</button>

        </form>
    </div>
    <?php endif; ?>

    <!-- event list -->
    <div class="row">
				<?php if ($events) : ?>
        <div class="list-group list-group-flush event-calendar">
            <?php foreach ($events as $event) : ?>
            <article class="list-group-item event">
                <header class="d-flex w-100 justify-content-between event-header">
                    <h3 class="mb-1">
                        <?= rex_escape($event['event_name']); ?>
                        <small class="text-muted">
                            <?php
                            $start_date = $event['event_start'];
                            $end_date = $event['event_end'];

                            if (!$end_date) {
                                echo rex_escape(DateTime::createFromFormat(naju_event_calendar::$DB_DATE_FMT, $start_date)->format('d.m'));
                            } else {
                                $start_date = DateTime::createFromFormat(naju_event_calendar::$DB_DATE_FMT, $start_date);
                                $end_date = DateTime::createFromFormat(naju_event_calendar::$DB_DATE_FMT, $end_date);

                                if ($start_date->format('Y') == $end_date->format('Y')) {
                                    if ($start_date->format('m') == $end_date->format('m')) {
                                        echo rex_escape($start_date->format('d.')) . '&dash;' . rex_escape($end_date->format('d.m.'));
                                    } else {
                                        echo rex_escape($start_date->format('d.m.')) . '&dash;' . rex_escape($end_date->format('d.m.'));
                                    }
                                } else {
                                    echo rex_escape($start_date->format('d.m.y')) . '&dash;' . rex_escape($end_date->format('d.m.y'));
                                }

                            }
                            ?>
                        </small>
                    </h3>
										<!-- TODO: insert group link -->
                    <small class="text-muted"><?= rex_escape($event['group_name']); ?></small>
                </header>

                <p class="mb-1">
                    <?= rex_escape($event['event_description']); ?>
                </p>

                <?php if (naju_event_calendar::hasExtraInfos($event)) : ?>
                <div class="container mt-3">
                  <table class="table table-sm">

                    <?php if ($event['event_location']) : ?>
                    <tr class="row">
                      <th class="col-lg-2">Wo?</th>
                      <td class="col-lg-10"><?= rex_escape($event['event_location']); ?></td>
                    </tr>
                    <?php endif; ?>

                    <?php if ($event['event_target_group']) : ?>
                    <tr class="row">
                      <th class="col-lg-2">Für wen?</th>
                      <td class="col-lg-10"><?= rex_escape($event['event_target_group']) ?></td>
                    </tr>
                    <?php endif; ?>

                    <?php if ($event['event_price'] || $event['event_price_reduced']) : ?>
                    <tr class="row">
                      <th class="col-lg-2">Was kostet es?</th>
                      <td class="col-lg-10">
                          <?php
                            $normal_price = $event['event_price'];
                            $reduced_price = $event['event_price_reduced'];

                            if ($normal_price) {
                                echo rex_escape($normal_price);
                            }

                            if ($normal_price && $reduced_price) {
                                echo ' bzw. ';
                            }

                            if ($reduced_price) {
                                echo rex_escape($reduced_price) . ' ermäßigt';
                            }

                          ?>
                        </td>
                    </tr>
                    <?php endif; ?>

                    <?php if ($event['event_registration']) : ?>
                    <tr class="row">
                        <th class="col-lg-2">Anmeldung?</th>
                        <td class="col-lg-10"><?= naju_article::make_emails_anchors(rex_escape($event['event_registration'])); ?></td>
                    </tr>
                    <?php endif; ?>

                  </table>
                </div>
                <?php endif; ?>

                <?php if ($event['event_link']) : ?>
                <a href="<?= rex_getUrl($event['event_link']); ?>" class="mb-1 link">Mehr Infos</a>
                <?php endif; ?>
            </article>
            <?php endforeach; ?>
        </div>
				<?php else : ?>
					<div class="mx-auto"><p class="alert alert-secondary">Es wurden keine Veranstaltungen gefunden</p></div>
				<?php endif; ?>
		</div>

</section>
