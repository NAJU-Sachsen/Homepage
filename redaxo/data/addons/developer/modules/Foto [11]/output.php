
<!-- mod_img -->

<?php
$img_width = 'REX_VALUE[id=1 ifempty=-1]';
$img_height = 'REX_VALUE[id=2 ifempty=-1]';
$img_integrate = 'REX_VALUE[id=3 ifempty=no-integrate]';
$fancy_effects = 'REX_VALUE[id=4 ifempty="false"]' === 'true';

$img_class = 'img-fluid mt-4 mb-4 ';

if ($fancy_effects) {
    $img_class .= ' img-fancy ';
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


<img src="/media/REX_MEDIA[1]" class="<?= rex_escape($img_class); ?>" <?= $img_dimens; ?>>
