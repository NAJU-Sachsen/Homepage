
<?php
$group_query = <<<EOSQL
    select group_id, group_name
    from naju_local_group
EOSQL;

$local_groups = rex_sql::factory()->setQuery($group_query)->getArray();
?>

<div class="form-group">
    <label for="select-local-group">Ortsgruppe auswählen</label>
    <select class="form-control" name="REX_INPUT_VALUE[1]">
        <option value="-1">alle</option>

        <?php foreach ($local_groups as $group) : ?>
        <option value="<?= rex_escape($group['group_id']); ?>" <?= "REX_VALUE[id=1 ifempty='']" == $group['group_id'] ? 'selected' : '' ?>>
					<?= rex_escape($group['group_name']); ?>
				</option>
        <?php endforeach; ?>

    </select>
</div>

<div class="form-group">
    <label for="select-event-target-group">Nur Veranstaltungen mit folgender Zielgruppe anzeigen:</label>
    <select class="form-control" name="REX_INPUT_VALUE[2]" id="select-event-target-group">
        <option value="" <?= 'REX_VALUE[2]' == '' ? 'selected' : ''; ?>>deaktiviert</option>
        <option value="children" <?= 'REX_VALUE[2]' == 'children' ? 'selected' : ''; ?>>Kinder</option>
        <option value="teens" <?= 'REX_VALUE[2]' == 'teens' ? 'selected' : ''; ?>>Jugendliche</option>
        <option value="families" <?= 'REX_VALUE[2]' == 'families' ? 'selected' : ''; ?>>Familien</option>
        <option value="young_adults" <?= 'REX_VALUE[2]' == 'young_adults' ? 'selected' : ''; ?>>junge Erwachsene</option>
    </select>
</div>
<div class="form-group">
    <label for="select-event-type">Nur folgende Veranstaltungsarten einbinden:</label>
    <select class="form-control" name="REX_INPUT_VALUE[3]" id="select-event-type">
        <option value="" <?= 'REX_VALUE[3]' == '' ? 'selected' : ''; ?>>deaktiviert</option>
        <option value="camp" <?= 'REX_VALUE[3]' == 'camp' ? 'selected' : ''; ?>>Camp</option>
        <option value="workshop" <?= 'REX_VALUE[3]' == 'workshop' ? 'selected' : ''; ?>>Workshop</option>
        <option value="work_assignment" <?= 'REX_VALUE[3]' == 'work_assignment' ? 'selected' : ''; ?>>Arbeitseinsatz</option>
        <option value="group_meeting" <?= 'REX_VALUE[3]' == 'group_meeting' ? 'selected' : ''; ?>>Aktiventreffen</option>
    </select>
</div>
<div class="form-group">
    <label>
        <input type="hidden" name="REX_INPUT_VALUE[6]" value="false">
        <input type="checkbox" name="REX_INPUT_VALUE[6]"
            value="true" <?= 'REX_VALUE[6]' == 'true' ? 'checked' : ''; ?>> Text über den Veranstaltungen:
    </label>
    <input type="text" id="custom-title" class="form-control" name="REX_INPUT_VALUE[4]"
        value="REX_VALUE[id=4 ifempty='Die nächsten Camps']" autocomplete="off">
</div>

<div class="form-group">
    <label>Anzeige:</label>
    <div class="checkbox">
        <label>
            <input type="hidden" name="REX_INPUT_VALUE[5]" value="false">
            <input type="checkbox" name="REX_INPUT_VALUE[5]" value="true" <?= 'REX_VALUE[5]' == 'true' ? 'checked' : ''; ?>>
            als Karten formatieren
        </label>
    </div>
</div>
