<!-- SEO -->
<?php

// first of, extract some general info about the requested page

$article = rex_article::getCurrent();
$title = htmlspecialchars($article->getName());

$image = $article->getValue('art_image');
$hasCustomImage = $image || false;

$image = $hasCustomImage ? new naju_image($image) : new naju_image('default-social-image.jpg');

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
    
    $params .= htmlspecialchars(urlencode($param)) . '=' . htmlspecialchars(urlencode($val)) . '&';
}
$params = substr($params, 0, -1);

// SEO info

$seo = new rex_yrewrite_seo();

if ($seo->getDescription()) {
    echo $seo->getDescriptionTag();
}

echo $seo->getRobotsTag();
echo $seo->getHreflangTags();
echo $seo->getCanonicalUrlTag();

?>

<!-- Open graph info (Facebook) -->
<meta property="og:url" content="<?= rex_yrewrite::getFullUrlByArticleId($article->getId()) . $params; ?>">
<meta property="og:type" content="article">
<meta property="og:title" content="<?= $title; ?>">
<?php if ($seo->getDescription()) : ?>
<meta property="og:description" content="<?= htmlspecialchars($seo->getDescription()); ?>">
<?php endif; ?>
<meta property="og:image" content="<?= $image->absoluteUrl(); ?>">
<meta property="og:image:width" content="<?= $image->width(); ?>">
<meta property="og:image:height" content="<?= $image->height(); ?>">

<!-- Twitter -->
<meta name="twitter:title" content="<?= $title; ?>">
<?php if ($seo->getDescription()) : ?>
<meta name="twitter:description" content="">
<?php endif; ?>
<?php if ($hasCustomImage) : ?>
<meta name="twitter:image" content="<?= $image->absoluteUrl(); ?>">
<?php endif; ?>
<meta name="twitter:card" content="summary_large_image">
