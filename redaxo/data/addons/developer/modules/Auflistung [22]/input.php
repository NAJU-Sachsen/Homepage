<?php

$mform = new MForm();
$mform->addRadioField(1, ['media-list' => 'Liste', 'grid' => 'Gitter']);
$mform->setLabel('Darstellung');
echo $mform->show();

$mform = new MForm();
$mform->addFieldset('Inhalt');
$rep_id = 2;
$mform->addTextField("$rep_id.0.title", ['label' => 'Titel']);
$mform->addMediaField(1, ['label' => 'Foto']);
$mform->addTextAreaField("$rep_id.0.content", ['label' => 'Inhalt', 'class' => 'redactorEditor2-links-bold-italic-lists']);
$mform->addLinkField(1, ['label' => 'Weiterführender Link']);
$mform->addTextField("$rep_id.0.link_text", ['label' => 'Link Beschriftung']);

echo MBlock::show($rep_id, $mform->show());
