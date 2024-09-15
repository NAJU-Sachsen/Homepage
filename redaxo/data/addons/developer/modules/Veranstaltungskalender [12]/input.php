<?php

$mform = MForm::factory();

$mform->addAlertInfo(<<<EOTXT
Der Veranstaltungskalender zeigt standardmäßig alle Veranstaltungen des aktuellen Jahres an. Dieses Verhalten lässt
sich anpassen, sodass der Kalender nur zukünftige Veranstaltungen anzeigt und alle vergangenen Veranstaltungen
ignoriert. Außerdem kann der Kalender optional auch Veranstaltungen der nächsten Jahre in die Anzeige einbeziehen.
Wenn die Filteroptionen genutzt werden, bekommen Besucher*innen der Webseite die Möglichkeit, nur Veranstaltungen
in einem bestimmten Monat oder für eine bestimmte Ortsgruppe anzuzeigen.
EOTXT
);

$id_show_group_filter = 1;
$id_show_month_filter = 2;
$id_include_future_years = 3;
$id_group = 4;
$id_target_group = 5;
$id_event_type = 6;
$id_exlude_past = 7;
$id_event_year = 8;

$mform_tab = MForm::factory();
$mform_tab->addSelectField($id_group);
$mform_tab->setOption('-1', 'alle');
$mform_tab->setSqlOptions('SELECT group_id AS id, group_name AS name FROM naju_local_group ORDER BY group_name');
$mform_tab->setAttributes(['label' => 'Ortsgruppe auswählen']);
$mform->addTabElement('Basiseinstellungen', $mform_tab, true);

$mform_tab = MForm::factory();
$mform_tab->addInputField('number', $id_event_year, ['label' => 'Jahr auswählen']);
$mform_tab->addHiddenField($id_include_future_years, 'false');
$mform_tab->addCheckboxField($id_include_future_years, ['true' => 'Veranstaltungen der nächsten Jahre auch anzeigen'], ['label' => '']);
$mform_tab->addDescription('Falls oben ein Jahr ebenfalls ausgewählt wurde, wird dieses als "Startjahr" verwendet.');
$mform_tab->addHiddenField($id_exlude_past, 'false');
$mform_tab->addCheckboxField($id_exlude_past, ['true' => 'vergangene Veranstaltungen ausblenden'], ['label' => '']);
$mform->addTabElement('Zeitraum', $mform_tab);

$mform_tab = MForm::factory();
$target_groups = [
    'children' => 'Kinder',
    'teens' => 'Jugendliche',
    'families' => 'Familien',
    'young_adults' => 'junge Erwachsene'
];
$mform_tab->addSelectField($id_target_group, $target_groups, ['label' => 'Zielgruppe', 'multiple' => 'multiple', 'class' => 'selectpicker']);
$event_types = [
    'camp' => 'Camp',
    'workshop' => 'Workshop',
    'work_assignment' => 'Arbeitseinsatz',
    'group_meeting' => 'Aktiventreffen',
    'excursion' => 'Exkursion',
    'holiday_event' => 'Ferienveranstaltung',
    'other' => 'sonstige Veranstaltungen'
];
$mform_tab->addSelectField($id_event_type, $event_types, ['label' => 'Veranstaltungsart', 'multiple' => 'multiple', 'class' => 'selectpicker']);
$mform->addTabElement('Kalender anpassen', $mform_tab);

$mform_tab = MForm::factory();
$mform_tab->addHiddenField($id_show_group_filter, 'false');
$mform_tab->addCheckboxField($id_show_group_filter, ['true' => 'Ortsgruppen-Filter anzeigen'], ['label' => '']);
$mform_tab->addHiddenField($id_show_month_filter, 'false');
$mform_tab->addCheckboxField($id_show_month_filter, ['true' => 'Monats-Filter anzeigen'], ['label' => '']);
$mform->addTabElement('Filter anzeigen', $mform_tab);

echo $mform->show();
?>
