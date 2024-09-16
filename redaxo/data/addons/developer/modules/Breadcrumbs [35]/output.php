<?php
$alignment = 'REX_VALUE[id=1 ifempt=align_left]';
$art = rex_article::getCurrent();
?>

<!-- mod_breadcrumbs -->
<div class="<?= $alignment == 'align_left' ? 'float-md-left' : 'float-md-right' ?>">
<nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="background-color: unset;">
        <?php foreach ($art->getParentTree() as $item) : ?>
            <li class="breadcrumb-item <?= $item->getId() == $art->getId() ? 'active' : '' ?>">
                <a href="<?= $item->getUrl() ?>"><?= rex_escape($item->getName()) ?></a>
            </li>
        <?php endforeach; ?>
    </ol>
</nav>
</div>
<div class="clearfix"></div>
