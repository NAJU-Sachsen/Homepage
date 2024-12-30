<?php

// REX_VALUE
$display_type_id = 1;
$item_id = 2;
$image_params_id = 3;
$list_wide_img_cols = 4;
$generate_authors_id = 5;

// REX_MEDIA
$item_media_id = 1;

// REX_LINK
$item_link_id = 1;

$mform = MForm::factory();

$mform_tab = MForm::factory();
$mform_tab->addRadioField($display_type_id, ['media-list' => 'als Liste', 'grid' => 'als Gitter']);
$mform_tab->setLabel('Wie sollen die Einträge angezeigt werden?');
$mform_tab->addCheckboxField($generate_authors_id, ['label' => 'aktiviert']);
$mform_tab->setLabel('Urheber-Infos anzeigen');
$mform->addTabElement('Allgemeine Einstellung', $mform_tab, true);

$mform_tab = MForm::factory();
$mform_tab->addInputField('number', "$image_params_id.width");
$mform_tab->setLabel('Breite der Bilder');
$mform_tab->addInputField('number', "$image_params_id.height");
$mform_tab->setLabel('Höhe der Bilder');
$mform_tab->addCheckboxField("$image_params_id.enable_effects", ['label' => 'aktiviert']);
$mform_tab->setLabel('Tolle Bildeffekte');
$mform_tab->addSelectField("$image_params_id.effect", ['random' => 'zufällig', 'img-fancy-default' => 'Dunkelrot [Standard]',
    'img-fancy-green' => 'Maigrün (Hellgrün)', 'img-fancy-green-alternate' => 'Laubgrün (Dunkelgrün)']);
$mform_tab->setLabel('Effekt auswählen');
$mform_tab->addCheckboxField("$image_params_id.no_rotate_img", ['label' => 'Rotation ausschalten']);


$mform_fieldset = MForm::factory();
$mform_fieldset->addCheckboxField($list_wide_img_cols, ['label' => 'breite Bild-Spalte verwenden']);
$mform_tab->addFieldsetArea('Für die Listendarstellung', $mform_fieldset);
$mform->addTabElement('Bilddarstellung', $mform_tab);

echo $mform->show();

$mform = MForm::factory();
$mform_fieldset = MForm::factory();
$mform_fieldset->addTextField("$item_id.0.title", ['label' => 'Titel']);
$mform_fieldset->addMediaField($item_media_id, ['label' => 'Foto', 'types' => naju_image::ALLOWED_TYPES]);
$mform_fieldset->addTextAreaField("$item_id.0.content", ['label' => 'Inhalt', 'class' => 'redactorEditor2-links-bold-italic-lists']);
$mform_fieldset->addLinkField($item_link_id, ['label' => 'Weiterführender Link']);
$mform_fieldset->addTextField("$item_id.0.link_text", ['label' => 'Link Beschriftung']);
$mform->addFieldsetArea('Eintrag', $mform_fieldset);

echo MBlock::show($item_id, $mform->show());
