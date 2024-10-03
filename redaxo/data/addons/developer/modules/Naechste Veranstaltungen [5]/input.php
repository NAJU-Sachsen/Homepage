
<?php

$id_local_group = 1;
$id_target_group = 2;
$id_event_type = 3;
$id_header_content = 4;
$id_show_cards = 5;
$id_header_enabled = 6;
$id_filter_tags = 7;

$mform = MForm::factory();

$local_groups = rex_sql::factory()->getArray('SELECT group_id, group_name FROM naju_local_group WHERE not group_internal ORDER BY group_name');
$local_group_options = ['-1' => 'alle'];
foreach ($local_groups as $group) {
    $local_group_options[$group['group_id']] = $group['group_name'];
}
$mform->addSelectField($id_local_group, $local_group_options, ['label' => 'Ortsgruppe']);

$target_group_options = [
    '' => 'alle',
    'children' => 'Kinder',
    'teens' => 'Jugendliche',
    'young_adults' => 'junge Erwachsene',
    'families' => 'Familien'
];
$mform->addSelectField($id_target_group, $target_group_options, ['label' => 'Zielgruppe']);

$event_type_options = [
    '' => 'alle',
    'camp' => 'Camp',
    'workshop' => 'Workshop',
    'work_assignment' => 'Arbeitseinsatz',
    'group_meeting' => 'Aktiventreffen',
    'excursion' => 'Exkursion',
    'holiday_event' => 'Ferienveranstaltung',
    'other' => 'Sonstige Veranstaltungen'
];
$mform->addSelectField($id_event_type, $event_type_options, ['label' => 'Veranstaltungsart']);

$tags = rex_sql::factory()->getArray('SELECT tag_name FROM naju_event_tags ORDER BY tag_name');
$event_tag_options = ['##inactive##' => '[deaktiviert]'];
foreach ($tags as $tag) {
    $tag_name = $tag['tag_name'];
    $event_tag_options[$tag_name] = $tag_name;
}
$mform->addSelectField($id_filter_tags, $event_tag_options, ['label' => 'Tags', 'multiple' => 'multiple', 'class' => 'selectpicker', 'data-live-search' => 'true'], 1, '##inactive##');

$mform->addCheckboxField($id_header_enabled, ['true' => 'Text über den Veranstaltungen einblenden'], ['label' => 'Überschrift'], 'true');
$mform->addTextField($id_header_content, [], 'Die nächsten Camps');

$mform->addCheckboxField($id_show_cards, ['true' => 'als Karten formatieren'], ['label' => 'Anzeige']);

$mform->addHtml('<hr>');
$mform->addDescription('Wenn Tags ausgewählt werden, müssen Veranstaltungen alle Tags besitzen.');
echo $mform->show();
?>
