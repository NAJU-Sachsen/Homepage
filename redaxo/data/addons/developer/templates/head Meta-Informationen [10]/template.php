<!-- temp_head_meta -->

<!-- SEO -->
<?php

// first of, extract some general info about the requested page

$article = rex_article::getCurrent();
$title = htmlspecialchars($article->getName());

$params = '?'; // all GET parameters in one string

// if there are any params, we need to add them after a '?' sign
// when the params are appended, they will be suffixed by a '&' sign to
// enable appending the next param
// as the last step, the final character of the url will be deleted
// this may be the redundant '&' from the last parameter
// or the '?' in case there were no parameters at all

foreach ($_GET as $param => $val) {

    // if there are private parameters present, we do not save any of the parameters
    // instead reset the string to default to mimic a 'no parameters' case
    if ($param == 'private' && ($val == 'true' || $val == 1 )) {
        $params = '?';
        break;
    }

    $params .= rex_escape(rex_escape($param, 'url')) . '=' . rex_escape(rex_escape($val, 'url')) . '&';
}
$params = substr($params, 0, -1);

// SEO info

$seo = new rex_yrewrite_seo();

$image = $article->getValue('art_image');
if (!$image) {
    $image = $seo->getImage();
}
$hasCustomImage = $image || false;

$image = $hasCustomImage ? new naju_image($image) : new naju_image('default-social-image.jpg');

$description = $seo->getDescription();
$local_group = naju_article::determineCurrentLocalGroup();

if ($description) {
    echo $seo->getDescriptionTag();
} else {
    $group_specific_description = null;
    if ($local_group !== naju_article::DEFAULT_GROUP) {
        $sql = rex_sql::factory();
        $seo_description_query = "SELECT ci.seo_description
            FROM naju_contact_info ci JOIN naju_local_group g ON ci.group_id = g.group_id
            WHERE g.group_name LIKE CONCAT('%', :group_name)
            LIMIT 1;";
        $sql->setQuery($seo_description_query, ['group_name' => $local_group]);
        foreach ($sql->getArray() as $description) {
            $group_specific_description = $description["seo_description"];
        }
    }

    $description = $group_specific_description ?: naju_kvs::getOrInflate('naju.seo.description',
        'select meta_value from naju_seo where meta_key = :key', ['key' => 'description']);
    echo '<meta name="description" content="' . rex_escape($description) . '">';
}

echo '<!-- General -->';
echo $seo->getRobotsTag();
echo $seo->getHreflangTags();
echo $seo->getCanonicalUrlTag();

?>

<!-- Open graph info (Facebook) -->
<meta property="og:url" content="<?= rex_yrewrite::getFullUrlByArticleId($article->getId()) . $params; ?>">
<meta property="og:site_name" content="NAJU <?= $local_group ?? 'Sachsen' ?>">
<meta property="og:locale" content="de_DE">
<meta property="og:type" content="website">
<meta property="og:title" content="<?= $title; ?>">
<?php if ($description) : ?>
<meta property="og:description" content="<?= rex_escape($description); ?>">
<?php endif; ?>
<meta property="og:image" content="<?= $image->absoluteUrl(); ?>">
<meta property="og:image:secure_url" content="<?= $image->absoluteUrl(); ?>">
<meta property="og:image:width" content="<?= $image->width(); ?>">
<meta property="og:image:height" content="<?= $image->height(); ?>">

<!-- Twitter -->
<meta name="twitter:title" content="<?= $title; ?>">
<?php if ($description) : ?>
<meta name="twitter:description" content="<?= rex_escape($description); ?>">
<?php endif; ?>
<?php if ($hasCustomImage) : ?>
<meta name="twitter:image" content="<?= $image->absoluteUrl(); ?>">
<?php endif; ?>
<meta name="twitter:card" content="summary_large_image">
