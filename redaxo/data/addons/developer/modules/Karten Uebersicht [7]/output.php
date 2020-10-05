
<!-- mod_overview_cards -->

<?php
$bs_cols = 12;	// the number of columns in a Bootstrap grid
$n_cards = 'REX_VALUE[20]';
$col_lg_width = $bs_cols / $n_cards;
?>

<div class="container-fluid mb-4">
	<div class="row">
		<section class="card-deck">
			<article class="card">
				<?php
				$card1 = naju_rex_var::toArray('REX_VALUE[1]');
				$img1 = new naju_image('REX_MEDIA[id=1 ifempty=default-card-image.jpg]');
				?>

				<img src="/media/<?= $img1->name(); ?>" alt="<?= rex_escape($img1->altText()); ?>" class="card-img-top">
				<div class="card-body">
					<h3 class="card-title"><?= rex_escape($card1['title']); ?></h3>
					<p class="card-text"><?= rex_escape($card1['content']); ?></p>
					<a class="btn btn-primary" href="REX_LINK[id=1 output=url]" role="button"><?= rex_escape($card1['link-text']) ?? ''; ?></a>
				</div>
			</article>

			<article class="card">
				<?php
				$card2 = naju_rex_var::toArray('REX_VALUE[2]');
				$img2 = new naju_image('REX_MEDIA[id=2 ifempty=default-card-image.jpg]');
				?>

				<img src="/media/<?= $img2->name(); ?>" alt="<?= rex_escape($img2->altText()); ?>" class="card-img-top">
				<div class="card-body">
					<h3 class="card-title"><?= rex_escape($card2['title']); ?></h3>
					<p class="card-text"><?= rex_escape($card2['content']); ?></p>
					<a class="btn btn-primary" href="REX_LINK[id=2 output=url]" role="button"><?= rex_escape($card2['link-text']) ?? ''; ?></a>
				</div>
			</article>

			<?php if($n_cards >= 3) : ?>
			<article class="card">
				<?php
				$card3 = naju_rex_var::toArray('REX_VALUE[3]');
				$img3 = new naju_image('REX_MEDIA[id=3 ifempty=default-card-image.jpg]');
				?>

				<img src="/media/<?= $img3->name(); ?>" alt="<?= rex_escape($img3->altText()); ?>" class="card-img-top">
				<div class="card-body">
					<h3 class="card-title"><?= rex_escape($card3['title']); ?></h3>
					<p class="card-text"><?= rex_escape($card3['content']); ?></p>
					<a class="btn btn-primary" href="REX_LINK[id=3 output=url]" role="button"><?= rex_escape($card3['link-text']) ?? ''; ?></a>
				</div>
			</article>
			<?php endif; ?>

			<?php if($n_cards >= 4) : ?>
			<article class="card">
				<?php
				$card4 = naju_rex_var::toArray('REX_VALUE[4]');
				$img4 = new naju_image('REX_MEDIA[id=4 ifempty=default-card-image.jpg]');
				?>

				<img src="/media/<?= $img4->name(); ?>" alt="<?= rex_escape($img4->altText()); ?>" class="card-img-top">
				<div class="card-body">
					<h3 class="card-title"><?= rex_escape($card4['title']); ?></h3>
					<p class="card-text"><?= rex_escape($card4['content']); ?></p>
					<a class="btn btn-primary" href="REX_LINK[id=4 output=url]" role="button"><?= rex_escape($card4['link-text']) ?? ''; ?></a>
				</div>
			</article>
			<?php endif; ?>
		</section>
	</div>
</div>
