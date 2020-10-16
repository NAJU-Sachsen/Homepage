
<!-- mod_iframe -->

<?php
$height = 'REX_VALUE[id=3 ifempty=0]';

if ($height) {
    $height = 'height: ' . $height . 'vh';
}
?>

<div class="container-fluid">
    <iframe src="REX_VALUE[1]" style="width: 100%; border: none;" <?= $height; ?>></iframe>
</div>
