
<?php
$img_id = 1;
$link_id = 1;
$width_id = 1;
$height_id = 2;
$integrate_id = 3;
$activate_effects_id = 4;
$effects_kind_id = 5;
$effects_rotate_id = 6;

$effects_kind_select = ['random' => 'zufällig',
    'img-fancy-default' => 'Standard (Dunkelrot)',
    'img-fancy-green' => 'Maigrün (Hellgrün)',
    'img-fancy-green-alternate' => 'Laubgrün (Dunkelgrün)'];
$integrate_select = ['no-integrate' => 'nicht integrieren',
    'integrate-left' => 'links abbilden',
    'integrate-right' => 'rechts abbilden'];

$mform = new MForm();

$mform->addTab('Bild');
$mform->addMediaField($img_id, ['preview' => '1', 'types' => naju_image::ALLOWED_TYPES, 'label' => 'Bild auswählen']);
$mform->addLinkField($link_id, ['label' => 'Verlinkung hinzufügen?']);
$mform->closeTab();

$mform->addTab('Bildeffekte');
$mform->addHiddenField($activate_effects_id, 'false');
$mform->addCheckboxField($activate_effects_id, ['true' => 'tolle Bildeffekte aktivieren'],  ['label' => 'Aktivieren?']);
$mform->addSelectField($effects_kind_id, $effects_kind_select, ['label' => 'Effektfarbe:']);
$mform->addHiddenField($effects_rotate_id, 'true');
$mform->addCheckboxField($effects_rotate_id, ['false' => 'Rotation ausschalten'], ['label' => 'Weiteres']);
$mform->closeTab();

$mform->addTab('Optionen');
$mform->addInputField('number', $width_id, ['label' => 'Breite', 'min' => -1]);
$mform->addInputField('number', $height_id, ['label' => 'Höhe', 'min' => -1]);
$mform->addSelectField(3, $integrate_select, ['label' => 'Bild in den Textfluss integrieren?']);
$mform->closeTab();

echo $mform->show();
