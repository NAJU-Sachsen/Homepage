
<!-- mod_social_media -->

<?php
$group_id = 'REX_VALUE[1]';
$group_query = 'select facebook, instagram from naju_contact_info where group_id = :id';
$group = rex_sql::factory()->setQuery($group_query, ['id' => $group_id])->getArray()[0];

$include_heading = 'REX_VALUE[2]' == 'true';
?>

<div class="mt-3">
	<?php if ($include_heading) : ?>
	<h3>Social Media</h3>
	<?php endif; ?>

	<div class="container-fluid">
		<div class="row">
			<?php if ($group['facebook']) : ?>
				<div class="col-sm">
					<a href="<?= $group['facebook']; ?>" target="_blank">
						<img src="/assets/facebook-logo.png" alt="Logo of the Facebook social network" class="social-logo">
					</a>
				</div>
			<?php endif; ?>
			<?php if ($group['instagram']) : ?>
				<div class="col-sm">
					<a href="https://instagram.com/<?= $group['instagram']; ?>" target="_blank">
						<img src="/assets/instagram-logo.png" alt="Logo of the Instagram social network" class="social-logo">
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
