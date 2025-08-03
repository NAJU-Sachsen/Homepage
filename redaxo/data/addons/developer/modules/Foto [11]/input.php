<?php

use FriendsOfRedaxo\MForm;

$img_id = 1;    // MEDIA type --> separate media ID
$link_id = 1;   // LINK type --> separate link ID
$width_id = 1;  // normal type --> true IDs start here
$height_id = 2;
$integrate_id = 3;
$activate_effects_id = 4;
$effects_kind_id = 5;
$effects_rotate_id = 6;
$hide_author_id = 7;

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
$mform_tab->addCheckboxField($hide_author_id, ['false' => 'Fotograf*in ausblenden'], ['label' => 'Fotograf*in']);
$mform_tab->addDescription("Zu jedem Bild _muss_ der*die Fotograf*in angegeben werden! Wenn nicht direkt am Bild, dann im Begleittext!");
$mform->addTabElement('Bild', $mform_tab, true);

$mform_tab = MForm::factory();
$mform_tab->addHiddenField($activate_effects_id, 'false');
$mform_tab->addCheckboxField($activate_effects_id, ['true' => 'tolle Bildeffekte aktivieren'],  ['label' => 'Aktivieren?']);
$mform_tab->addSelectField($effects_kind_id, $effects_kind_select, ['label' => 'Effektfarbe:']);
$mform_tab->addHiddenField($effects_rotate_id, 'true');
$mform_tab->addCheckboxField($effects_rotate_id, ['false' => 'Rotation ausschalten'], ['label' => 'Weiteres']);
$mform->addTabElement('Bildeffekte', $mform_tab);

$mform_tab = MForm::factory();
$ctl_width = $mform_tab->addInputField('number', $width_id, ['label' => 'Breite', 'min' => -1]);
$ctl_width->setDefaultValue(750);
$mform_tab->addInputField('number', $height_id, ['label' => 'Höhe', 'min' => -1]);
$mform_tab->addSelectField(3, $integrate_select, ['label' => 'Bild in den Textfluss integrieren?']);
$mform->addTabElement('Optionen', $mform_tab);

echo $mform->show();
