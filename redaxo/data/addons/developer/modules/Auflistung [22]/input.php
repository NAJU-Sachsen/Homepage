<?php

// REX_VALUE
$display_type_id = 1;
$item_id = 2;
$image_params_id = 3;
$list_wide_img_cols = 4;

// REX_MEDIA
$item_media_id = 1;

// REX_LINK
$item_link_id = 1;

$mform = new MForm();
$mform->addTab('Allgemeine Einstellung');

$mform->addRadioField($display_type_id, ['media-list' => 'als Liste', 'grid' => 'als Gitter']);
$mform->setLabel('Wie sollen die Einträge angezeigt werden?');
$mform->closeTab();
$mform->addTab('Bilddarstellung');
$mform->addInputField('number', "$image_params_id.width");
$mform->setLabel('Breite der Bilder');
$mform->addInputField('number', "$image_params_id.height");
$mform->setLabel('Höhe der Bilder');
$mform->addCheckboxField("$image_params_id.enable_effects", ['label' => 'aktiviert']);
$mform->setLabel('Tolle Bildeffekte');
$mform->addSelectField("$image_params_id.effect", ['random' => 'zufällig', 'img-fancy-default' => 'Dunkelrot [Standard]',
    'img-fancy-green' => 'Maigrün (Hellgrün)', 'img-fancy-green-alternate' => 'Laubgrün (Dunkelgrün)']);
$mform->setLabel('Effekt auswählen');

$mform->addFieldset('Für die Listendarstellung');
$mform->addCheckboxField($list_wide_img_cols, ['label' => 'breite Bild-Spalte verwenden']);
$mform->closeFieldset();
$mform->closeTab();
echo $mform->show();

$mform = new MForm();
$mform->addFieldset('Eintrag');
$mform->addTextField("$item_id.0.title", ['label' => 'Titel']);
$mform->addMediaField($item_media_id, ['label' => 'Foto', 'types' => naju_image::ALLOWED_TYPES]);
$mform->addTextAreaField("$item_id.0.content", ['label' => 'Inhalt', 'class' => 'redactorEditor2-links-bold-italic-lists']);
$mform->addLinkField($item_link_id, ['label' => 'Weiterführender Link']);
$mform->addTextField("$item_id.0.link_text", ['label' => 'Link Beschriftung']);

echo MBlock::show($item_id, $mform->show());
