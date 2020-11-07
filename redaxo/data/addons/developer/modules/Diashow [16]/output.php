
<?php
$images = explode(',', 'REX_MEDIALIST[1]');
$slice_id = 'REX_VALUE[1]';
$max_height = 'REX_VALUE[2]';
$show_id = 'diashow-' . $slice_id;
?>

<div id="<?= $show_id; ?>" class="diashow carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <?php foreach ($images as $idx => $img) : ?>
			<li data-target="#<?= $show_id; ?>" data-slide-to="<?= $idx; ?>" class="<?= $idx == 0 ? 'active' : ''; ?>"></li>
		<?php endforeach; ?>
  </ol>
  <div class="carousel-inner">
		<?php foreach ($images as $idx => $img) : ?>
			<div class="carousel-item <?= $idx == 0 ? 'active' : ''; ?>">
        <?php
          if (!$img) {
            continue;
          }
          $img = new naju_image($img);
          if ($max_height) {
            $style = "height: 500px; background-image: url('" . $img->optimizedUrl() . "'); background-size: contain; ";
            $style .= " background-repeat: no-repeat; background-position: center;";
            echo '<div class="webp-fallback" style="' . $style . '" aria-label="' . rex_escape($img->altText()) . '" data-webp-fallback="' . $img->url() . '"></div>';
          } else {
            echo $img->generatePictureTag(['d-block', 'w-100']);
          }
        ?>
			</div>
	<?php endforeach; ?>
  </div>
  <a class="carousel-control-prev" href="#<?= $show_id; ?>" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#<?= $show_id; ?>" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
