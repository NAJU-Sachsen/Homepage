
<!-- mod_img -->

<?php
$img = new naju_image('REX_MEDIA[id=1]');
$img_width = 'REX_VALUE[id=1 ifempty=-1]';
$img_height = 'REX_VALUE[id=2 ifempty=-1]';
$img_integrate = 'REX_VALUE[id=3 ifempty=no-integrate]';
$fancy_effects = 'REX_VALUE[id=4 ifempty="false"]' === 'true';

$img_class = 'img-fluid mt-4 mb-4 ';

if ($fancy_effects) {
    $chosen_class = 'REX_VALUE[id=5 ifempty="random"]';
    if ($chosen_class == 'random') {
        $fancy_effect_classes = ['img-fancy-default', 'img-fancy-green', 'img-fancy-green-alternate'];
        $chosen_class = $fancy_effect_classes[array_rand($fancy_effect_classes)];
    }
    $img_class .= ' img-fancy ' . $chosen_class . ' ';
}

switch($img_integrate) {
    case 'integrate-left':
        $img_class .= ' float-left mr-2 ';
        break;
    case 'integrate-right':
        $img_class .= ' float-right ml-2 ';
        break;
    case 'no-integrate':
        // fall through
    default:
        $img_class .= ' d-block mx-auto ';
        break;
}

$img_dimens = '';
if ($img_width > 0) {
    $img_dimens .= ' width="' . rex_escape($img_width) . '" ';
}

if ($img_height > 0) {
    $img_dimens .= ' height="' . rex_escape($img_heigth) . '" ';
}

?>


<img src="/media/<?= $img->name(); ?>" alt="<?= rex_escape($img->altText()); ?>" class="<?= rex_escape($img_class); ?>" <?= $img_dimens; ?>>
