
<!-- mod_pictogram -->

<?php

$img = 'REX_MEDIA[1]';

if ($img) {
    $img = new naju_image($img);
    echo $img->generatePictureTag(['img-fluid', 'd-block', 'mx-auto'], '', ['style' => 'max-height: 200px;']);
}
