
<?php

$id_newest_count = 1;
$id_manual_select = 2;
$id_show_newest = 3;
$id_blog_select = 4;

$mform = new MForm();

// newest selection
$mform->addTab('Neueste Artikel anzeigen');
$mform->addHiddenField($id_show_newest, 'false');
$mform->addCheckboxField($id_show_newest, ['true' => 'Automatisch die neuesten Artikel anzeigen'], ['label' => '']);
$mform->addSelectField($id_blog_select);
$mform->setLabel('Blog auswählen');
if (rex::getUser()->isAdmin()) {
    $query = 'SELECT CONCAT(blog_title, " (", group_name, ")") as name, blog_id as id
        FROM naju_blog JOIN naju_local_group ON blog_group = group_id ORDER BY blog_title';
} else {
    $user_id = rex::getUser()->getId();
    $query = 'SELECT blog_title as name, blog_id as id FROM naju_blog JOIN naju_group_account ON blog_group = group_id
        WHERE account_id = ' . $user_id . ' ORDER BY blog_title';
}
$mform->addOption('alle', 'all');
$mform->setSqlOptions($query);
$mform->addInputField('number', $id_newest_count, ['label' => 'Anzahl', 'min' => '2']);
$mform->closeTab();

// manual selection
$mform->addTab('Manuell auswählen');
$mblock = new MForm();
$mblock->addFieldset('Artikel');
$mblock->addSelectField("$id_manual_select.0,article_id");
$mblock->setLabel('Auswählen:');

if (rex::getUser()->isAdmin()) {
    $query = 'SELECT
            CONCAT("[", blog_title , "] ", article_title, " (veröffentlicht ", DATE_FORMAT(article_published, "%d.%m.%y") ,")") as name,
            article_id as id
        FROM naju_blog_article JOIN naju_blog ON article_blog = blog_id
        WHERE article_status = "published"
        ORDER BY blog_title, article_published, article_updated, article_title';
} else {
    $user_id = rex::getUser()->getId();
    $query = 'SELECT
            CONCAT("[", blog_title , "] ", article_title, " (veröffentlicht ", DATE_FORMAT(article_published, "%d.%m.%y") ,")") as name,
            article_id as id
        FROM naju_blog_article JOIN naju_blog JOIN naju_group_account ON article_blog = blog_id AND blog_group = group_id
        WHERE article_status = "published" AND account_id = ' . $user_id . '
        ORDER BY blog_title, article_published, article_updated, article_title';
}
$mblock->setSqlOptions($query);
$mblock->setAttributes(['class' => 'selectpicker', 'data-live-search' => 'true']);

$mform->addHtml(MBlock::show($id_manual_select, $mblock->show(), ['min' => '2']));
$mform->closeTab();

echo $mform->show();
