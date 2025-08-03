<?php

use FriendsOfRedaxo\MForm;

$id_blog_select = 1;
$id_image_display = 2;

$mform = MForm::factory();

$mform->addSelectField($id_blog_select);
$mform->setLabel('Blog auswählen:');
$mform->setOption('all', 'Beiträge aus allen Blogs');

if (rex::getUser()->isAdmin()) {
    $query = 'SELECT blog_id AS id, CONCAT(blog_title, " (", group_name, ")") AS name
              FROM naju_blog JOIN naju_local_group
              ON blog_group = group_id
              ORDER BY name';
    $mform->setSqlOptions($query);
} else {
    $user_id = rex::getUser()->getId();
    $query = 'SELECT b.blog_id AS id, CONCAT(b.blog_title, " (", g.group_name, ")") AS name
              FROM naju_blog b JOIN naju_group_account a JOIN naju_local_group g
              ON b.blog_group = a.group_id AND g.group_id = a.group_id
              WHERE a.account_id = ' . $user_id .'
              ORDER BY name';
    $mform->setSqlOptions($query);
}

$mform->addRadioField($id_image_display, ['focus' => 'Fokus', 'column' => 'Extra Spalte']);
$mform->setLabel('Bilder anzeigen');
$mform->setDefaultValue('focus');

echo $mform->show();
