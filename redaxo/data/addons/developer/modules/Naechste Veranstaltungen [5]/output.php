<!-- mod_upcoming_events -->

<?php

define('DATE_FMT', 'd.m.');
$sql = rex_sql::factory();

$limit = 3;
$local_group = 'REX_VALUE[1]';

$today = date(naju_event_calendar::$DB_DATE_FMT);

$additional_filters = '';
$filter_target_group = 'REX_VALUE[id=2]';
if ($filter_target_group) {
    $event_target_group = rex_sql::factory()->escape($filter_target_group);
    $additional_filters .= " and find_in_set($event_target_group, event_target_group_type) ";
}

$filter_event_type = 'REX_VALUE[id=3]';
if ($filter_event_type) {
    $event_type = rex_sql::factory()->escape($filter_event_type);
    $additional_filters .= " and event_type = $event_type ";
}

$filter_event_tags = rex_var::toArray('REX_VALUE[id=7]');
if ($filter_event_tags && !in_array('##inactive##', $filter_event_tags)) {
    $event_tag_criteria = '';
    foreach ($filter_event_tags as $event_tag) {
        $tag_value = "'%," . trim($sql->escape($event_tag), "'") . ",%'";
        $event_tag_criteria .= ' and event_tags like ' . $tag_value;
    }
    $additional_filters .= $event_tag_criteria;
}

// local group == -1 means no group selected => show all instead
if ($local_group == -1) {
    $event_query = <<<EOSQL
        select
            event_name,
            group_name,
            event_start,
            event_end,
            event_location,
            event_type,
            event_link
        from
            naju_event
            join naju_local_group
            on event_group = group_id
        where
            (event_end >= :date or event_start >= :date)
            and event_active = true
            $additional_filters
        order by event_start, event_end
        limit $limit
EOSQL;
    $events = rex_sql::factory()->setQuery($event_query, ['date' => $today])->getArray();
} else {
    $event_query = <<<EOSQL
        select
            event_name,
            group_name,
            event_start,
            event_end,
            event_location,
            event_type,
            event_link
        from
            naju_event
            join naju_local_group
            on event_group = group_id
        where
            group_id = :group and
            (event_end >= :date or event_start >= :date)
            and event_active = true
            $additional_filters
        order by event_start, event_end
        limit $limit
EOSQL;
    $events = rex_sql::factory()->setQuery($event_query, ['group' => $local_group, 'date' => $today])->getArray();
}

echo 'REX_VALUE[id=6 ifempty=false]' == 'true' ? 'REX_VALUE[4]' : ''; // intro text

$plain_list = 'REX_VALUE[id=5 ifempty=false]' == 'false'; // REX_VAL 5 is 'format as cards'
?>

<?php if ($events && $plain_list) : ?>
<dl class="events-list">
    <?php foreach ($events as $event) : ?>
    <dt>
        <?php
        $start_date = DateTime::createFromFormat(naju_event_calendar::$DB_DATE_FMT, $event['event_start']);
        $event_end = $event['event_end'];

        echo rex_escape($start_date->format(DATE_FMT));
        if ($event_end) {
            $event_end = DateTime::createFromFormat(naju_event_calendar::$DB_DATE_FMT, $event_end);
            echo ' &dash; ' . rex_escape($event_end->format(DATE_FMT));
        }

        if ($event['event_type'] == 'work_assignment') {
            echo ' Arbeitseinsatz:';
        } elseif ($event['event_type'] == 'group_meeting') {
            echo ' Aktiventreffen:';
        }
        ?>
    </dt>
    <dd class="event-announcement">
        <?php
        if ($event['event_link']) {
            echo '<a href="' . rex_getUrl($event['event_link']) . '" class="event-link">' . rex_escape($event['event_name']) . '</a> ';
        } else {
            echo rex_escape($event['event_name']);

        }
        if ($local_group == -1) {
                echo ' (' . rex_escape($event['group_name']) . ')';
            }
        ?>
    </dd>
    <?php endforeach; ?>
</dl>
<?php elseif ($events) : ?>
<div class="card-deck mt-3">
    <?php foreach ($events as $event) : ?>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                <?php echo rex_escape($event['event_name']); ?>
                </h4>
                <p class="card-text">
                    <?php
                    if ($event['event_type'] == 'work_assignment') {
                        echo ' <span class="badge badge-pill badge-secondary mr-1">Arbeitseinsatz</span>';
                    } elseif ($event['event_type'] == 'group_meeting') {
                        echo ' <span class="badge badge-pill badge-secondary mr-1">Aktiventreffen</span>';
                    }

                    $start_date = DateTime::createFromFormat(naju_event_calendar::$DB_DATE_FMT, $event['event_start']);
                    $event_end = $event['event_end'];

                    echo rex_escape($start_date->format(DATE_FMT));
                    if ($event_end) {
                        $event_end = DateTime::createFromFormat(naju_event_calendar::$DB_DATE_FMT, $event_end);
                        echo ' &dash; ' . rex_escape($event_end->format(DATE_FMT));
                    }

                    if ($event['event_location']) {
                        echo '<br>' . rex_escape($event['event_location']);
                    }
                    ?>
                </p>
                <p class="card-text"><small class="text-muted"><?= rex_escape($event['group_name']); ?></small></p>
                <?php
                if ($event['event_link']) {
                    echo '<a href="' . rex_getUrl($event['event_link']) . '" class="card-link">Mehr erfahren</a>';
                }
                ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php else: ?>
	<p class="ml-1 font-italic">Demnächst stehen keine Veranstaltungen an</p>
<?php endif; ?>
