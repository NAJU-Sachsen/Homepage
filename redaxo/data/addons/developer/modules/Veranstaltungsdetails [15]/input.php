
<?php
$current_year = date('Y') . '-01-01';
$event_query = <<<EOSQL
	select event_id, event_name, group_name, event_start
	from naju_event
	join naju_local_group on event_group = group_id
	where event_start >= :date
	order by event_start
EOSQL;
$events = rex_sql::factory()->setQuery($event_query, ['date' => $current_year])->getArray();
$current_event_year = null;
?>

<div class="form-group">
	<label for="select-event">Veranstaltung auswählen</label>
	<select class="form-control" name="REX_INPUT_VALUE[1]">
			<?php foreach ($events as $event) :
				$event_text = rex_escape($event['event_name']) . ' (' . rex_escape($event['group_name']) . ')';
				$event_year = date_parse($event['event_start'])['year'];

				if ($event_year > $current_event_year) {

					// if the $current_event_year is set, this means that at least one group has already started. That one needs
					// to be closed first
					if ($current_event_year) {
						echo '</optgroup>';
					}

					echo '<optgroup label="' . rex_escape($event_year) . '">';
					$current_event_year = $event_year;
				}
				?>

				<option value="<?= rex_escape($event['event_id']); ?>" <?= "REX_VALUE[id=1 ifempty='']" == $event['event_id'] ? 'selected' : ''; ?>>
					<?= $event_text; /* $event_text has already been escaped */ ?>
				</option>
			<?php endforeach; ?>
			</optgroup>
	</select>
</div>
