
<!-- mod_editor -->
<?php
$block_id = 'REX_VALUE[2]';
$start_tag = '<div %%ID%%>';
$close_tag = '</div>';

if ($block_id) {
    $start_tag = str_replace('%%ID%%', 'id="' . rex_escape($block_id) . '"', $start_tag);
} else {
    $start_tag = str_replace('%%ID%%', '', $start_tag);
}

echo $start_tag;
echo 'REX_VALUE[1 output=html]';
echo $close_tag;
?>
