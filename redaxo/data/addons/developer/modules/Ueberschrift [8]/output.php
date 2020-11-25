
<!-- mod_heading -->

<?php
$content = 'REX_VALUE[id=1]';
$raw_level = 'REX_VALUE[id=2 ifempty=2]';
$level = 'h' . $raw_level;
$subtitle = 'REX_VALUE[id=3]';

if ($subtitle) {
    $subtitle = '<small class="d-block text-muted">' . $subtitle . '</small>';
}

$classes = ' content-heading ';
if ($this->getValue('art_custom_title') === '|true|' && $raw_level <= 2) {
    $classes .= ' page-title ';
}

echo "<header><$level class='$classes'>" . $content . $subtitle . "</$level></header>";

?>
