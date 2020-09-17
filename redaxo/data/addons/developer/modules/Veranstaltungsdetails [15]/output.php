
<!-- mod_event_details -->

<?php
	$event_id = 'REX_VALUE[1]';
	$event_query = <<<EOSQL
		select
			event_location,
			event_group, group_name,
			event_target_group,
			event_price, event_price_reduced,
			event_registration
		from naju_event
		left join naju_local_group
		on event_group = group_id
		where event_id = :event
EOSQL;
	$event = rex_sql::factory()->setQuery($event_query, ['event' => $event_id])->getArray()[0];
?>

<div class="container">
	<table class="table table-sm">
		<tbody>
			<?php if ($event['event_location']) : ?>
			<tr class="row">
				<th class="col-lg-2">Wo?</th>
				<td class="col-lg-10"><?= rex_escape($event['event_location']); ?></td>
			</tr>
			<?php endif; ?>
			<?php if ($event['event_group']) : ?>
			<tr class="row">
				<th class="col-lg-2">Wer?</th>
				<td class="col-lg-10">
					<!-- TODO link to local group -->
					<?= rex_escape($event['group_name']); ?>
				</td>
			</tr>
			<?php endif; ?>
			<?php if ($event['event_target_group']) : ?>
			<tr class="row">
				<th class="col-lg-2">Für wen?</th>
				<td class="col-lg-10"><?= rex_escape($event['event_target_group']); ?></td>
			</tr>
			<?php endif; ?>
			<?php if ($event['event_price'] || $event['event_price_reduced']) : ?>
			<tr class="row">
				<th class="col-lg-2">Kosten?</th>
				<td class="col-lg-10">
					<?php
						$normal_price = $event['event_price'];
						$reduced_price = $event['event_price_reduced'];

						if ($normal_price) {
							echo rex_escape($normal_price);
						}

						if ($normal_price && $reduced_price) {
							echo ' bzw. ';
						}

						if ($reduced_price) {
							echo rex_escape($reduced_price) . ' ermäßigt';
						}
					?>
				</td>
			</tr>
			<?php endif; ?>
			<?php if ($event['event_registration']) : ?>
			<tr class="row">
				<th class="col-lg-2">Anmeldung?</th>
				<td class="col-lg-10"><?= naju_article::make_emails_anchors(htmlspecialchars($event['event_registration'])); ?></td>
			</tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>
