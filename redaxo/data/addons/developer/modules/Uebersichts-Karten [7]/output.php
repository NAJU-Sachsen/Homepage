
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
		<div class="card-deck overview-cards">
			<article class="card">
				<?php
				$card1 = naju_rex_var::toArray('REX_VALUE[1]');
				$img1 = $images[0];
				echo $img1->generatePictureTag(['card-img-top']);
				?>

				<div class="card-body">
					<h3 class="card-title"><?= naju::escape($card1['title']); ?></h3>
					<p class="card-text"><?= naju::escape($card1['content']); ?></p>
				</div>
				<footer class="card-footer">
					<a class="btn btn-primary" href="REX_LINK[id=1 output=url]" role="button"><?= rex_escape($card1['link-text']) ?? ''; ?></a>
				</footer>
			</article>

			<article class="card">
				<?php
				$card2 = naju_rex_var::toArray('REX_VALUE[2]');
				$img2 = $images[1];
				echo $img2->generatePictureTag(['card-img-top']);
				?>

				<div class="card-body">
					<h3 class="card-title"><?= naju::escape($card2['title']); ?></h3>
					<p class="card-text"><?= naju::escape($card2['content']); ?></p>
				</div>
				<footer class="card-footer">
					<a class="btn btn-primary" href="REX_LINK[id=2 output=url]" role="button"><?= rex_escape($card2['link-text']) ?? ''; ?></a>
				</footer>
			</article>

			<?php if($n_cards >= 3) : ?>
			<article class="card">
				<?php
				$card3 = naju_rex_var::toArray('REX_VALUE[3]');
				$img3 = $images[2];
				echo $img3->generatePictureTag(['card-img-top']);
				?>

				<div class="card-body">
					<h3 class="card-title"><?= naju::escape($card3['title']); ?></h3>
					<p class="card-text"><?= naju::escape($card3['content']); ?></p>
				</div>
				<footer class="card-footer">
					<a class="btn btn-primary" href="REX_LINK[id=3 output=url]" role="button"><?= rex_escape($card3['link-text']) ?? ''; ?></a>
				</footer>
			</article>
			<?php endif; ?>

			<?php if($n_cards >= 4) : ?>
			<article class="card">
				<?php
				$card4 = naju_rex_var::toArray('REX_VALUE[4]');
				$img4 = $images[3];
				echo $img4->generatePictureTag(['card-img-top']);
				?>

				<div class="card-body">
					<h3 class="card-title"><?= naju::escape($card4['title']); ?></h3>
					<p class="card-text"><?= naju::escape($card4['content']); ?></p>
				</div>
				<footer class="card-footer">
					<a class="btn btn-primary" href="REX_LINK[id=4 output=url]" role="button"><?= rex_escape($card4['link-text']) ?? ''; ?></a>
				</footer>
			</article>
			<?php endif; ?>
			</div>
	</div>
</div>
