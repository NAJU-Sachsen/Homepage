
<!-- mod_home_cards -->

<?php
$bs_cols = 12;	// the number of columns in a Bootstrap grid
$n_cards = 'REX_VALUE[20]';
$col_lg_width = $bs_cols / $n_cards;
?>

<?php

if (rex::isBackend()) {
	$image_names = array();
	$images = array();

	$image_names[] = 'REX_MEDIA[id=1 ifempty=default-card-image.jpg]';
	$image_names[] = 'REX_MEDIA[id=2 ifempty=default-card-image.jpg]';

	if ($n_cards >= 3) {
		$image_names[] = 'REX_MEDIA[id=3 ifempty=default-card-image.jpg]';
	}

	if ($n_cards >= 4) {
		$image_names[] = 'REX_MEDIA[id=4 ifempty=default-card-image.jpg]';
	}

	$ratios = array();
	foreach ($image_names as $img) {
		$img = new naju_image($img);
		$images[] = $img;
		if (!in_array($img->aspectRatio(), $ratios)) {
			$ratios[] = $img->aspectRatio();
		}
	}

	if (sizeof($ratios) > 1) {
		$ratio_details = '<ul class="list-group">';
		foreach ($images as $img) {
			$name = $img->name();
			$ratio = naju_image::aspectRatioName($img);
			$ratio_details .= "<li class=\"list-group-item list-group-item-warning\" style=\"color:white;\">$name: $ratio</li>";
		}
		$ratio_details .= '</ul>';

		echo "
			<p class=\"alert alert-warning\">
				Die Bilder haben verschiedene Seitenverhältnisse. Die Karten werden damit unterschiedliche Größen
				aufweisen. <strong>Es wird dringend empfohlen, die Bilder entsprechend anzupassen.</strong><br>
			</p><p class=\"alert alert-warning\">Folgende Seitenverhältnisse wurden gefunden:</p>$ratio_details";
	}

}

?>

<div id="home-cards" class="container-fluid mb-1">
	<div class="row card-grid">
		<div class="card-grid-item col-lg-<?= $col_lg_width; ?> col-md-6 col-sm-12">
			<article class="card intro-card">
				<?php
				$card1 = naju_rex_var::toArray('REX_VALUE[1]');
				$img1 = new naju_image('REX_MEDIA[id=1 ifempty=default-card-image.jpg]');
				?>
				<div class="card-body-wrapper webp-fallback" style="background-image: url('<?= $img1->optimizedUrl(false, 800); ?>');" aria-label="<?= rex_escape($img1->altText()); ?>" data-webp-fallback="<?= $img1->url(); ?>">
					<div class="card-body">
						<h2 class="display-8"><?= rex_escape($card1['title']); ?></h2>
						<hr class="my-4">
						<p><?= rex_escape($card1['content']); ?></p>
						<a class="btn btn-primary btn-lg intro-card-btn" href="REX_LINK[id=1 output=url]" role="button"><?= rex_escape($card1['link-text']) ?? ''; ?></a>
					</div>
				</div>
			</article>
		</div>

		<div class="card-grid-item col-lg-<?= $col_lg_width; ?> col-md-6 col-sm-12">
			<article class="card intro-card">
				<?php
				$card2 = naju_rex_var::toArray('REX_VALUE[2]');
				$img2 = new naju_image('REX_MEDIA[id=2 ifempty=default-card-image.jpg]');
				?>
				<div class="card-body-wrapper webp-fallback" style="background-image: url('<?= $img2->optimizedUrl(false, 800); ?>');" aria-label="<?= rex_escape($img2->altText()); ?>" data-webp-fallback="<?= $img2->url(); ?>">
					<div class="card-body">
						<h2 class="display-8"><?= rex_escape($card2['title']); ?></h2>
						<hr class="my-4">
						<p><?= rex_escape($card2['content']); ?></p>
						<a class="btn btn-primary btn-lg intro-card-btn" href="REX_LINK[id=2 output=url]" role="button"><?= rex_escape($card2['link-text']) ?? ''; ?></a>
					</div>
				</div>
			</article>
		</div>

		<?php if($n_cards >= 3) : ?>
		<div class="card-grid-item col-lg-<?= $col_lg_width; ?> col-md-6 col-sm-12">
			<article class="card intro-card">
				<?php
				$card3 = naju_rex_var::toArray('REX_VALUE[3]');
				$img3 = new naju_image('REX_MEDIA[id=3 ifempty=default-card-image.jpg]');
				?>
				<div class="card-body-wrapper webp-fallback" style="background-image: url('<?= $img3->optimizedUrl(false, 800); ?>');" aria-label="<?= rex_escape($img3->altText()); ?>" data-webp-fallback="<?= $img3->url(); ?>">
					<div class="card-body">
						<h2 class="display-8"><?= rex_escape($card3['title']); ?></h2>
						<hr class="my-4">
						<p><?= rex_escape($card3['content']); ?></p>
						<a class="btn btn-primary btn-lg intro-card-btn" href="REX_LINK[id=3 output=url]" role="button"><?= rex_escape($card3['link-text']) ?? ''; ?></a>
					</div>
				</div>
			</article>
		</div>
		<?php endif; ?>

		<?php if($n_cards >= 4) : ?>
		<div class="card-grid-item col-lg-<?= $col_lg_width; ?> col-md-6 col-sm-12">
			<article class="card intro-card">
				<?php
				$card4 = naju_rex_var::toArray('REX_VALUE[4]');
				$img4 = new naju_image('REX_MEDIA[id=4 ifempty=default-card-image.jpg]');
				?>
				<div class="card-body-wrapper webp-fallback" style="background-image: url('<?= $img4->optimizedUrl(false, 800); ?>');" aria-label="<?= rex_escape($img4->altText()); ?>" data-webp-fallback="<?= $img4->url(); ?>">
					<div class="card-body">
						<h2 class="display-8"><?= rex_escape($card4['title']); ?></h2>
						<hr class="my-4">
						<p><?= rex_escape($card4['content']); ?></p>
						<a class="btn btn-primary btn-lg intro-card-btn" href="REX_LINK[id=4 output=url]" role="button"><?= rex_escape($card4['link-text']) ?? ''; ?></a>
					</div>
				</div>
			</article>
		</div>
		<?php endif; ?>
	</div>
</div>
