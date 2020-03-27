<?php

$local_groups = rex_sql::factory()->setQuery('select group_id, group_name from naju_local_group')->getArray();

?>

<div class="form-group">
    <label for="select-local-group">Ortsgruppe auswählen</label>
    <select class="form-control" name="REX_INPUT_VALUE[1]">
        <?php foreach ($local_groups as $group) : ?>
        <option value="<?= htmlspecialchars($group['group_id']); ?>" <?= REX_VALUE[id=1 ifempty=''] == $group['group_id'] ? 'selected' : '' ?>><?= htmlspecialchars($group['group_name']); ?></option>
        <?php endforeach; ?>

    </select>
</div>
<div class="form-group">
    <div class="checkbox">
        <label>
            <input type="hidden" name="REX_INPUT[2]" value="false">
            <input type="checkbox" name="REX_INPUT_VALUE[2]" value="true" <?= REX_VALUE[id=2 ifempty=''] == 'true' ? 'checked' : '' ?>>
            Überschrift über den Kontakt-Informationen anzeigen
        </label>
    </div>
</div>
