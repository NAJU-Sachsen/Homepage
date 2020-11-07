
<!-- mod_ad -->

<?php

$img = 'REX_MEDIA[id=1]';

if ($img) {
    $img = new naju_image($img);
    echo '<a href="/media/' . $img->name() . '">' . $img->generatePictureTag(['img', 'img-fluid']) . '</a>';
}
