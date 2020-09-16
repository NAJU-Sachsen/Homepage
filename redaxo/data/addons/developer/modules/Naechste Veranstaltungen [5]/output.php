
<!-- mod_upcoming_events -->

Die nächsten Camps:

<?php

define('DATE_FMT', 'd.m.');

$limit = 3;
$local_group = 'REX_VALUE[1]';

$today = date(naju_event_calendar::$DB_DATE_FMT);

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
            event_end >= $today
				order by event_start, event_end
        limit $limit
EOSQL;
    $events = rex_sql::factory()->setQuery($event_query)->getArray();
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

        echo htmlspecialchars($start_date->format(DATE_FMT));
        if ($event_end) {
            $event_end = DateTime::createFromFormat(naju_event_calendar::$DB_DATE_FMT, $event_end);
            echo ' &dash; ' . $event_end->format(DATE_FMT);
        }
        ?>
    </dt>
    <dd class="event-announcement">
        <?php
        if ($event['event_link']) {
            echo '<a href="' . rex_getUrl($event['event_link']) . '" class="event-link">' . htmlspecialchars($event['event_name']) . '</a> (' . htmlspecialchars($event['group_name']) . ')';
        } else {
            echo htmlspecialchars($event['event_name']) . ' (' . htmlspecialchars($event['group_name']) . ')';
        }
        ?>
    </dd>
    <?php endforeach; ?>
</dl>
<?php else: ?>
	<p class="ml-1 font-italic">Demnächst stehen keine Veranstaltungen an</p>
<?php endif; ?>
