
<?php

$mform = new MForm();

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

$mform->addTab('Basiseinstellungen');
$mform->addSelectField($id_group);
$mform->addOption('alle', '-1');
$mform->setSqlOptions('SELECT group_id AS id, group_name AS name FROM naju_local_group ORDER BY group_name');
$mform->setAttributes(['label' => 'Ortsgruppe auswählen']);
$mform->closeTab();

$mform->addTab('Zeitraum');
$mform->addInputField('number', $id_event_year, ['label' => 'Jahr auswählen']);
$mform->addHiddenField($id_include_future_years, 'false');
$mform->addCheckboxField($id_include_future_years, ['true' => 'Veranstaltungen der nächsten Jahre auch anzeigen'], ['label' => '']);
$mform->addDescription('Falls oben ein Jahr ebenfalls ausgewählt wurde, wird dieses als "Startjahr" verwendet.');
$mform->addHiddenField($id_exlude_past, 'false');
$mform->addCheckboxField($id_exlude_past, ['true' => 'vergangene Veranstaltungen ausblenden'], ['label' => '']);
$mform->closeTab();

$mform->addTab('Kalender anpassen');
$target_groups = ['children' => 'Kinder', 'teens' => 'Jugendliche', 'families' => 'Familien', 'young_adults' => 'junge Erwachsene'];
$mform->addSelectField($id_target_group, $target_groups, ['label' => 'Zielgruppe', 'multiple' => 'multiple', 'class' => 'selectpicker']);
$event_types = ['camp' => 'Camp', 'workshop' => 'Workshop', 'work_assignment' => 'Arbeitseinsatz',
    'group_meeting' => 'Aktiventreffen', 'excursion' => 'Exkursion', 'other' => 'sonstige Veranstaltungen'];
$mform->addSelectField($id_event_type, $event_types, ['label' => 'Veranstaltungsart', 'multiple' => 'multiple', 'class' => 'selectpicker']);
$mform->closeTab();

$mform->addTab('Filter anzeigen');
$mform->addHiddenField($id_show_group_filter, 'false');
$mform->addCheckboxField($id_show_group_filter, ['true' => 'Ortsgruppen-Filter anzeigen'], ['label' => '']);
$mform->addHiddenField($id_show_month_filter, 'false');
$mform->addCheckboxField($id_show_month_filter, ['true' => 'Monats-Filter anzeigen'], ['label' => '']);
$mform->closeTab();

echo $mform->show();
?>
