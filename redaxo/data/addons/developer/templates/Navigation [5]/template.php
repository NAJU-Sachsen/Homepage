<!-- temp_navigation -->

<?php
$active_ids = naju_navigation::collect_active_category_ids();
?>

<nav id="main-nav" class="col-md-2 col-sm-12">
	<ul class="nav nav-primary flex-column">
		<?php foreach(rex_category::getRootCategories(true) as $cat) : ?>
			<li class="nav-item">
				<?php $is_active = in_array($cat->getId(), $active_ids) ? 'active' : ''; ?>
				<a href="<?= $cat->getUrl(); ?>" class="nav-link <?= $is_active; ?>">
					<?= rex_escape($cat->getValue('catname')) ?>
				</a>
				<?= naju_navigation::inflate_subnav($cat, $active_ids); ?>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>
