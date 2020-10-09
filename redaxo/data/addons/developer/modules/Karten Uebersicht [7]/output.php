
<!-- mod_overview_cards -->

<?php
$bs_cols = 12;	// the number of columns in a Bootstrap grid
$n_cards = 'REX_VALUE[20]';
$col_lg_width = $bs_cols / $n_cards;

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

foreach ($image_names as $img) {
	$images[] = new naju_image($img);
}
?>

<?php
if (rex::isBackend()) {
	$ratios = array();
	foreach ($images as $img) {
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

<div class="container-fluid mb-4">
	<div class="row">
		<section class="card-deck">
			<article class="card">
				<?php
				$card1 = naju_rex_var::toArray('REX_VALUE[1]');
				$img1 = $images[0];
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
				$img2 = $images[1];
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
				$img3 = $images[2];
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
				$img4 = $images[3];
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
