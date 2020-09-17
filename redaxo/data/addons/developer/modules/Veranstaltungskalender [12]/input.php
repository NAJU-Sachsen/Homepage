
<?php

$group_query = <<<EOSQL
    select group_id, group_name
    from naju_local_group
EOSQL;
$local_groups = rex_sql::factory()->setQuery($group_query)->getArray();

?>

<div class="form-group">
    <div class="checkbox">
        <label>
            <input type="hidden" name="REX_INPUT[1]" value="false">
            <input type="checkbox" name="REX_INPUT_VALUE[1]" value="true" <?= "REX_VALUE[id=1 ifempty='']" == 'true' ? 'checked' : '' ?>>
            Ortsgruppen-Filter anzeigen
        </label>
    </div>
</div>
<div class="form-group">
    <div class="checkbox">
        <label>
            <input type="hidden" name="REX_INPUT[2]" value="false">
            <input type="checkbox" name="REX_INPUT_VALUE[2]" value="true" <?= "REX_VALUE[id=2 ifempty='']" == 'true' ? 'checked' : '' ?>>
            Monats-Filter anzeigen
        </label>
    </div>
</div>
<div class="form-group">
    <div class="checkbox">
        <label>
            <input type="hidden" name="REX_INPUT[3]" value="false">
            <input type="checkbox" name="REX_INPUT_VALUE[3]" value="true" <?= "REX_VALUE[id=3 ifempty='']" == 'true' ? 'checked' : ''?>>
            alle zukünftigen Veranstaltungen anzeigen (nicht nur des aktuellen Jahres)
        </label>
    </div>
</div>
<div class="form-group">
    <label for="select-local-group">Ortsgruppe auswählen</label>
    <select class="form-control" name="REX_INPUT_VALUE[4]">
        <option value="-1">alle</option>

        <?php foreach ($local_groups as $group) : ?>
        <option value="<?= rex_escape($group['group_id']); ?>" <?= "REX_VALUE[id=4 ifempty='']" == $group['group_id'] ? 'selected' : '' ?>>
					<?= rex_escape($group['group_name']); ?>
				</option>
        <?php endforeach; ?>

    </select>
</div>
