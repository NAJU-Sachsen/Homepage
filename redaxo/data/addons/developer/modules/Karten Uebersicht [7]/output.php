
<?php
$bs_cols = 12;	// the number of columns in a Bootstrap grid
$n_cards = 'REX_VALUE[20]';
$col_lg_width = $bs_cols / $n_cards;
?>

<div class="container-fluid mb-4">
	<div class="row">
		<section class="card-deck">
			<article class="card">
				<?php $card1 = rex_var::toArray('REX_VALUE[1]'); ?>
				
				<img src="/media/REX_MEDIA[1]" class="card-img-top">
				<div class="card-body">
					<h3 class="card-title"><?= $card1['title']; ?></h3>
					<p class="card-text"><?= $card1['content']; ?></p>
					<a class="btn btn-primary btn-lg" href="REX_LINK[id=1 output=url]" role="button"><?= $card1['link-text'] ?? ''; ?></a>
				</div>
			</article>

			<article class="card">
				<?php $card2 = rex_var::toArray('REX_VALUE[2]'); ?>
				
				<img src="/media/REX_MEDIA[2]" class="card-img-top">
				<div class="card-body">
					<h3 class="card-title"><?= $card2['title']; ?></h3>
					<p class="card-text"><?= $card2['content']; ?></p>
					<a class="btn btn-primary btn-lg" href="REX_LINK[id=2 output=url]" role="button"><?= $card2['link-text'] ?? ''; ?></a>
				</div>
			</article>

			<?php if($n_cards >= 3) : ?>
			<article class="card">
				<?php $card3 = rex_var::toArray('REX_VALUE[3]'); ?>
				
				<img src="/media/REX_MEDIA[3]" class="card-img-top">
				<div class="card-body">
					<h3 class="card-title"><?= $card3['title']; ?></h3>
					<p class="card-text"><?= $card3['content']; ?></p>
					<a class="btn btn-primary btn-lg" href="REX_LINK[id=3 output=url]" role="button"><?= $card3['link-text'] ?? ''; ?></a>
				</div>
			</article>
			<?php endif; ?>

			<?php if($n_cards >= 4) : ?>
			<article class="card">
				<?php $card4 = rex_var::toArray('REX_VALUE[4]'); ?>
				
				<img src="/media/REX_MEDIA[4]" class="card-img-top">
				<div class="card-body">
					<h3 class="card-title"><?= $card4['title']; ?></h3>
					<p class="card-text"><?= $card4['content']; ?></p>
					<a class="btn btn-primary btn-lg" href="REX_LINK[id=4 output=url]" role="button"><?= $card4['link-text'] ?? ''; ?></a>
				</div>
			</article>
			<?php endif; ?>
		</section>
	</div>
</div>
