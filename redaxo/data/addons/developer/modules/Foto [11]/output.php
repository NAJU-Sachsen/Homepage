
<!-- mod_img -->

<?php
$img_src = 'REX_MEDIA[id=1]';
$img = $img_src ? new naju_image($img_src) : '';
$img_width = 'REX_VALUE[id=1 ifempty=-1]';
$img_height = 'REX_VALUE[id=2 ifempty=-1]';
$img_integrate = 'REX_VALUE[id=3 ifempty=no-integrate]';
$fancy_effects = 'REX_VALUE[id=4 ifempty="false"]' === 'true';

$img_class = 'mt-4 mb-4 ';

if ($fancy_effects) {
    $chosen_class = 'REX_VALUE[id=5 ifempty="random"]';
    $rotate_effect = 'REX_VALUE[id=6 ifempty="true"]' === 'true';
    if ($chosen_class == 'random') {
        $fancy_effect_classes = ['img-fancy-default', 'img-fancy-green', 'img-fancy-green-alternate'];
        $chosen_class = $fancy_effect_classes[array_rand($fancy_effect_classes)];
    }
    $img_class .= ' img-fancy ' . $chosen_class . ' ';

    if ($rotate_effect) {
        $img_class .= ' img-fancy-rotate ';
    }
}

switch($img_integrate) {
    case 'integrate-left':
        $img_class .= ' float-left mr-4 ';
        break;
    case 'integrate-right':
        $img_class .= ' float-right ml-4 ';
        break;
    case 'no-integrate':
        // fall through
    default:
        $img_class .= ' d-block mx-auto ';
        break;
}

$img_dimens = array();
$src_attrs = array();
if ($img_width > 0) {
    $img_dimens['width'] = $img_width;
    if ($img_width > 800) {
        $src_attrs['sizes'] = '75vw';
    }
}

if ($img_height > 0) {
    $img_dimens['height'] = $img_height;
} else {
    $img_class .= 'img-fluid ';
    if (!$img_width) {
        $src_attrs['sizes'] = '75vw';
    }
}

$img_link = 'REX_LINK[id=1]';

if ($img_link) {
    echo '<a href="' . rex_getUrl($img_link) . '" class="img-link">';
}

if ($img_src) {
    echo $img->generatePictureTag([$img_class], '', $img_dimens, $src_attrs);
}

if ($img_link) {
    echo '</a>';
}
