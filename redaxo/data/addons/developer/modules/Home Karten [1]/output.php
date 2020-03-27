
<?php
$bs_cols = 12;	// the number of columns in a Bootstrap grid
$n_cards = REX_VALUE[20];
$col_lg_width = $bs_cols / $n_cards;
?>

<section id="home-cards" class="container-fluid mb-4">
	<div class="row card-grid">
		<div class="card-grid-item col-lg-<?= $col_lg_width; ?> col-md-6 col-sm-12">
			<article class="card intro-card">
				<div class="card-body-wrapper" style="background-image: url('/media/REX_MEDIA[id=1 ifempty=p1030744.jpg]');">
					<?php $card1 = rex_var::toArray('REX_VALUE[1]'); ?>

					<div class="card-body">
						<h2 class="display-8"><?= $card1['title']; ?></h2>
						<hr class="my-4">
						<p><?= $card1['content']; ?></p>
						<a class="btn btn-primary btn-lg" href="REX_LINK[id=1 output=url]" role="button"><?= $card1['link-text'] ?? ''; ?></a>
					</div>
			</article>
		</div>

		<div class="card-grid-item col-lg-<?= $col_lg_width; ?> col-md-6 col-sm-12">
			<article class="card intro-card">
				<div class="card-body-wrapper" style="background-image: url('/media/REX_MEDIA[id=2 ifempty=p1030744.jpg]');">
					<?php $card2 = rex_var::toArray('REX_VALUE[2]'); ?>

					<div class="card-body">
						<h2 class="display-8"><?= $card2['title']; ?></h2>
						<hr class="my-4">
						<p><?= $card2['content']; ?></p>
						<a class="btn btn-primary btn-lg" href="REX_LINK[id=2 output=url]" role="button"><?= $card2['link-text'] ?? ''; ?></a>
					</div>
			</article>
		</div>

		<?php if($n_cards >= 3) : ?>
		<div class="card-grid-item col-lg-<?= $col_lg_width; ?> col-md-6 col-sm-12">
			<article class="card intro-card">
				<div class="card-body-wrapper" style="background-image: url('/media/REX_MEDIA[id=3 ifempty=p1030744.jpg]');">
					<?php $card3 = rex_var::toArray('REX_VALUE[3]'); ?>

					<div class="card-body">
						<h2 class="display-8"><?= $card3['title']; ?></h2>
						<hr class="my-4">
						<p><?= $card3['content']; ?></p>
						<a class="btn btn-primary btn-lg" href="REX_LINK[id=3 output=url]" role="button"><?= $card3['link-text'] ?? ''; ?></a>
					</div>
			</article>
		</div>
		<?php endif; ?>

		<?php if($n_cards >= 4) : ?>
		<div class="card-grid-item col-lg-<?= $col_lg_width; ?> col-md-6 col-sm-12">
			<article class="card intro-card">
				<div class="card-body-wrapper" style="background-image: url('/media/REX_MEDIA[id=4 ifempty=p1030744.jpg]');">
					<?php $card4 = rex_var::toArray('REX_VALUE[4]'); ?>

					<div class="card-body">
						<h2 class="display-8"><?= $card4['title']; ?></h2>
						<hr class="my-4">
						<p><?= $card4['content']; ?></p>
						<a class="btn btn-primary btn-lg" href="REX_LINK[id=4 output=url]" role="button"><?= $card4['link-text'] ?? ''; ?></a>
					</div>
			</article>
		</div>
		<?php endif; ?>
	</div>
</section>
