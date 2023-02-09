
<!-- mod_ad -->

<?php

$img = 'REX_MEDIA[id=1]';

if ($img) {
    $img = new naju_image($img);
    // 17vw roughly correspondends to 1/6 of the viewport width which is equal to the width of the glance section
    echo '<a href="/media/' . $img->name() . '">' . $img->generatePictureTag(['img', 'img-fluid'], '', [], ["sizes" => "17vw"], false) . '</a>';
}
