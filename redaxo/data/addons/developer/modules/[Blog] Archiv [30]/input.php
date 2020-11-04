<?php

$id_blog = 1;

$mform = new MForm();

$mform->addSelectField($id_blog);
$mform->setLabel('Blog auswählen');

if (rex::getUser()->isAdmin()) {
    $query = 'SELECT blog_title as name, blog_id as id FROM naju_blog ORDER BY blog_title';
} else {
    $user_id = rex::getUser()->getId();
    $query = 'SELECT blog_title as name, blog_id as id
        FROM naju_blog JOIN naju_group_account ON blog_group = group_id
        WHERE account_id = ' . $user_id;
}

$mform->setSqlOptions($query);

echo $mform->show();
