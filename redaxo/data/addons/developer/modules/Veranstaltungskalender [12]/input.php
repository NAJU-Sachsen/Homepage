
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
    <select class="form-control" name="REX_INPUT_VALUE[4]" id="select-local-group">
        <option value="-1">alle</option>

        <?php foreach ($local_groups as $group) : ?>
        <option value="<?= rex_escape($group['group_id']); ?>" <?= "REX_VALUE[id=4 ifempty='']" == $group['group_id'] ? 'selected' : '' ?>>
					<?= rex_escape($group['group_name']); ?>
				</option>
        <?php endforeach; ?>

    </select>
</div>
<div class="form-group">
    <label for="select-event-target-group">Nur Veranstaltungen mit folgender Zielgruppe anzeigen:</label>
    <select class="form-control" name="REX_INPUT_VALUE[5]" id="select-event-target-group">
        <option value="" <?= 'REX_VALUE[5]' == '' ? 'selected' : ''; ?>>deaktiviert</option>
        <option value="children" <?= 'REX_VALUE[5]' == 'children' ? 'selected' : ''; ?>>Kinder</option>
        <option value="teens" <?= 'REX_VALUE[5]' == 'teens' ? 'selected' : ''; ?>>Jugendliche</option>
        <option value="families" <?= 'REX_VALUE[5]' == 'families' ? 'selected' : ''; ?>>Familien</option>
        <option value="young_adults" <?= 'REX_VALUE[5]' == 'young_adults' ? 'selected' : ''; ?>>junge Erwachsene</option>
    </select>
</div>
<div class="form-group">
    <label for="select-event-type">Nur folgende Veranstaltungsarten einbinden:</label>
    <select class="form-control" name="REX_INPUT_VALUE[6]" id="select-event-type">
        <option value="" <?= 'REX_VALUE[6]' == '' ? 'selected' : ''; ?>>deaktiviert</option>
        <option value="camp" <?= 'REX_VALUE[6]' == 'camp' ? 'selected' : ''; ?>>Camp</option>
        <option value="workshop" <?= 'REX_VALUE[6]' == 'workshop' ? 'selected' : ''; ?>>Workshop</option>
        <option value="work_assignment" <?= 'REX_VALUE[6]' == 'work_assignment' ? 'selected' : ''; ?>>Arbeitseinsatz</option>
    </select>
</div>
