
<!-- mod_upcoming_events -->

Die nächsten Camps:

<?php

define('DATE_FMT', 'd.m.');

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

// local group == -1 means no group selected => show all instead
if ($local_group == -1) {
    $event_query = <<<EOSQL
        select
            event_name,
            group_name,
            event_start,
            event_end,
            event_link
        from
            naju_event
            join naju_local_group
            on event_group = group_id
        where
            event_end >= :date
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
            event_link
        from
            naju_event
            join naju_local_group
            on event_group = group_id
        where
            group_id = :group and
            event_end >= :date
            $additional_filters
        order by event_start, event_end
        limit $limit
EOSQL;
    $events = rex_sql::factory()->setQuery($event_query, ['group' => $local_group, 'date' => $today])->getArray();
}
?>

<?php if ($events) : ?>
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
        ?>
    </dt>
    <dd class="event-announcement">
        <?php
        if ($event['event_link']) {
            echo '<a href="' . rex_getUrl($event['event_link']) . '" class="event-link">' . rex_escape($event['event_name']) . '</a> (' . rex_escape($event['group_name']) . ')';
        } else {
            echo rex_escape($event['event_name']) . ' (' . rex_escape($event['group_name']) . ')';
        }
        ?>
    </dd>
    <?php endforeach; ?>
</dl>
<?php else: ?>
	<p class="ml-1 font-italic">Demnächst stehen keine Veranstaltungen an</p>
<?php endif; ?>
