
<!-- mod_separator -->

<?php
$margin_top = 'REX_VALUE[id=1 ifempty=0]';
$margin_btm = 'REX_VALUE[id=2 ifempty=0]';
$show_hr = 'REX_VALUE[3]' == 'true';

$style = '';
if ($margin_top > 0) {
    $style .= ' margin-top: ' . rex_escape($margin_top) . 'px; ';
}
if ($margin_btm > 0) {
    $style .= ' margin-bottom: ' . rex_escape($margin_btm) . 'px; ';
}

if ($show_hr) {
    echo '<hr style="' . $style . '">';
} else {
    echo '<div style="' . $style . '"></div>';
}

?>
