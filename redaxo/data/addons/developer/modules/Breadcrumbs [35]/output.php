<?php
$alignment = 'REX_VALUE[id=1 ifempt=align_left]';
$art = rex_article::getCurrent();
?>

<!-- mod_breadcrumbs -->
<div class="<?= $alignment == 'align_left' ? 'float-md-left' : 'float-md-right' ?>">
<nav aria-label="breadcrumb">
    <ol class="breadcrumb naju-breadcrumb">
        <li class="breadcrumb-item">
            <a href="https://naju-sachsen.de/">Home</a>
        </li>
        <?php foreach ($art->getParentTree() as $item) : ?>
            <li class="breadcrumb-item">
                <a href="<?= $item->getUrl() ?>"><?= rex_escape($item->getName()) ?></a>
            </li>
        <?php endforeach; ?>
        <li class="breadcrumb-item active">
            <a href="#"><?= rex_escape($art->getName()) ?></a>
        </li>
    </ol>
</nav>
</div>
<div class="clearfix"></div>
