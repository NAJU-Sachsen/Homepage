
<!-- mod_event_calendar -->

<?php
$sql = rex_sql::factory();

$local_group = 'REX_VALUE[id=4 ifempty=-1]';
$local_group_filter = 'REX_VALUE[id=1 ifempty="false"]' === 'true';
$include_all_future_events = 'REX_VALUE[id=3 ifempty="false"]' === 'true';
$ignore_past_events = 'REX_VALUE[id=7 ifempty="false"]' === 'true';
$month_filter = 'REX_VALUE[id=2 ifempty="false"]' === 'true';
$any_user_filter = $local_group_filter || $month_filter;
$event_year = 'REX_VALUE[id=8]';

if (!$event_year) {
    $event_year = date('Y');
}

if ($ignore_past_events) {
    $start_date = $event_year . '-' . date('m-d');
} else {
    $start_date = $event_year . '-01-01';
}
$end_date = $event_year . '-12-31';
$months = array('Januar', 'Februar', 'März', 'April', 'Mai', 'Juni',
    'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember');

$req_month = '';
if ('events' === rex_get('filter')) {
    $local_group = rex_get('local_group', 'int', $local_group);

    if (rex_get('month', 'int', 0)) {
        $req_month = rex_get('month', 'int');

        if ($req_month != -1) {
            $start_date = $event_year . '-' . $req_month . '-01';
            $end_date = $event_year . '-' . $req_month . '-31';
        }
    }
} else if ($include_all_future_events) {
    $end_date = '9999-12-31';
}

$additional_filters = '';
$filter_target_group = rex_get('target_group');
if (!$filter_target_group) {
    $filter_target_group = rex_var::toArray('REX_VALUE[id=5]');
}

if ($filter_target_group) {
    $target_group_criteria = 'and (';
    $target_groups = array();
    foreach ($filter_target_group as $target_group) {
        $target_groups[] = 'find_in_set(' . $sql->escape($target_group) . ', event_target_group_type)';
    }
    $target_group_criteria .= implode(' OR ', $target_groups) . ')';

    $additional_filters .=  $target_group_criteria;
}

$filter_event_type = rex_get('event_type');
if (!$filter_event_type) {
    $filter_event_type = rex_var::toArray('REX_VALUE[id=6]');
}

if ($filter_event_type) {
    $event_type_criteria = 'and (';
    $event_types = array();
    foreach ($filter_event_type as $event_type) {
        $event_types[] = 'event_type = ' . $sql->escape($event_type);
    }
    $event_type_criteria .= implode(' OR ', $event_types) . ')';

    $additional_filters .= $event_type_criteria;
}

if ($local_group == -1) {
    $event_query = <<<EOSQL
        select
            event_name,
            group_name,
            event_start,
            event_end,
            event_start_time,
            event_end_time,
            event_description,
            event_location,
            event_target_group,
            event_price,
            event_price_reduced,
            event_registration,
            event_type,
            event_link
        from
            naju_event
            join naju_local_group
            on event_group = group_id
        where
            ((event_start >= :start and event_end <= :end) or
                (event_end is null and event_start >= :start and event_start <= :end))
            and event_active = true
            $additional_filters
		order by event_start, event_end
EOSQL;
    $events = $sql->getArray($event_query, ['start' => $start_date, 'end' => $end_date]);
} else {
    $event_query = <<<EOSQL
        select
            event_name,
            group_name,
            event_start,
            event_end,
            event_start_time,
            event_end_time,
            event_description,
            event_location,
            event_target_group,
            event_price,
            event_price_reduced,
            event_registration,
            event_type,
            event_link
        from
            naju_event
            join naju_local_group
            on event_group = group_id
        where
            group_id = :group and
            ((event_start >= :start and event_end <= :end) or
                (event_end is null and event_start >= :start and event_start <= :end))
            and event_active = true
            $additional_filters
		order by event_start, event_end
EOSQL;
    $events = $sql->getArray($event_query, ['group' => $local_group, 'start' => $start_date, 'end' => $end_date]);
}

$slice_id = 'REX_SLICE_ID';
$event_counter = 0;
?>

<div class="container-fluid">

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
                    $local_groups = $sql->getArray('SELECT group_id, group_name FROM naju_local_group');
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
            <?php
            foreach ($events as $event) :
                $event_counter++;
            ?>
            <article class="list-group-item event">
                <header class="d-flex w-100 justify-content-between event-header">
                    <h3 class="mb-1 text-left">
                        <?php
                        if ($event['event_type'] == 'work_assignment') {
                            echo 'Arbeitseinsatz: ';
                        } elseif ($event['event_type'] == 'group_meeting') {
                            echo 'Aktiventreffen: ';
                        }


                        echo rex_escape($event['event_name']);
                        ?>
                        <small class="text-muted">
                            <?php
                            $start_date = $event['event_start'];
                            $end_date = $event['event_end'];
                            $start_time = $event['event_start_time'];
                            $end_time = $event['event_end_time'];

                            if (!$end_date) {
                                echo DateTime::createFromFormat(naju_event_calendar::$DB_DATE_FMT, $start_date)->format('d.m.y');

                                if ($start_time) {
                                    echo ' ' . DateTime::createFromFormat('H:i:s', $start_time)->format('H:i');
                                    if ($end_time) {
                                        echo ' &dash; ' . DateTime::createFromFormat('H:i:s', $end_time)->format('H:i');
                                    }
                                    echo ' Uhr';
                                }

                            } else {
                                $start_date = DateTime::createFromFormat(naju_event_calendar::$DB_DATE_FMT, $start_date);
                                $end_date = DateTime::createFromFormat(naju_event_calendar::$DB_DATE_FMT, $end_date);

                                if ($start_date->format('Y') == $end_date->format('Y')) {
                                    if ($start_date->format('m') == $end_date->format('m')) {
                                        echo $start_date->format('d.') . '&dash;' . $end_date->format('d.m.y');
                                    } else {
                                        echo $start_date->format('d.m.') . '&dash;' . $end_date->format('d.m.y');
                                    }
                                } else {
                                    echo $start_date->format('d.m.y') . '&dash;' . $end_date->format('d.m.y');
                                }

                            }
                            ?>
                        </small>
                    </h3>
					<!-- TODO: insert group link -->
                    <small class="text-muted"><?= rex_escape($event['group_name']); ?></small>
                </header>

                <?php if ($event['event_description']) : ?>
                <?php $event_description_id = 'event-description-' . $slice_id . '-' . $event_counter; ?>
                <div class="event-description-wrapper">
                    <p class="event-description collapse mb-1" id="<?= $event_description_id ?>" aria-expanded="false">
                        <?= rex_escape($event['event_description']); ?>
                    </p>
                    <a href="#<?= $event_description_id; ?>" class="float-right further-reading mr-3 mb-3"
                        data-toggle="collapse" role="button" aria-expanded="false" aria-controls="<?= $event_description_id; ?>">
                        Weiterlesen
                    </a>
                </div>
                <?php endif; ?>

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

</div>
