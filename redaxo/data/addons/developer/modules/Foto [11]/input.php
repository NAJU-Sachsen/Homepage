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

$mform = MForm::factory();

$mform_tab = MForm::factory();
$mform_tab->addMediaField($img_id, ['preview' => '1', 'types' => naju_image::ALLOWED_TYPES, 'label' => 'Bild auswählen']);
$mform_tab->addLinkField($link_id, ['label' => 'Verlinkung hinzufügen?']);
$mform->addTabElement('Bild', $mform_tab, true);

$mform_tab = MForm::factory();
$mform_tab->addHiddenField($activate_effects_id, 'false');
$mform_tab->addCheckboxField($activate_effects_id, ['true' => 'tolle Bildeffekte aktivieren'],  ['label' => 'Aktivieren?']);
$mform_tab->addSelectField($effects_kind_id, $effects_kind_select, ['label' => 'Effektfarbe:']);
$mform_tab->addHiddenField($effects_rotate_id, 'true');
$mform_tab->addCheckboxField($effects_rotate_id, ['false' => 'Rotation ausschalten'], ['label' => 'Weiteres']);
$mform->addTabElement('Bildeffekte', $mform_tab);

$mform_tab = MForm::factory();
$mform_tab->addInputField('number', $width_id, ['label' => 'Breite', 'min' => -1]);
$mform_tab->addInputField('number', $height_id, ['label' => 'Höhe', 'min' => -1]);
$mform_tab->addSelectField(3, $integrate_select, ['label' => 'Bild in den Textfluss integrieren?']);
$mform->addTabElement('Optionen', $mform_tab);

echo $mform->show();
