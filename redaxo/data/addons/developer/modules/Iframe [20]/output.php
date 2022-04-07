
<!-- mod_iframe -->

<?php
$height = 'REX_VALUE[id=3 ifempty=0]';

if ($height) {
    $height = $height . 'vh';
}
?>

<div class="container-fluid">
    <article class="iframe-container load-on-demand" data-iframe-src="REX_VALUE[1]" data-iframe-height="<?= $height; ?>">
        <p class="iframe-load-description">
            Hier soll Inhalt aus einer externen Quelle angezeigt werden.
            Dabei werden Daten an den jeweiligen Anbieter übertragen.
        </p>
        <button type="button" class="iframe-load-btn">Jetzt laden</button>
        <iframe src="" class="iframe-holder d-none"></iframe>
    </article>
</div>
