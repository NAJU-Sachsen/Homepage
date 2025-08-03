
<?php
$local_groups = rex_sql::factory()->setQuery('select group_id, group_name from naju_local_group')->getArray();

$rex_var_group = "REX_VALUE[id=1 ifempty='']";
$rex_var_heading = "REX_VALUE[id=2 ifempty='']";
?>

<div class="form-group">
    <label for="select-local-group">Ortsgruppe auswählen</label>
    <select class="form-control" name="REX_INPUT_VALUE[1]">
        <?php foreach ($local_groups as $group) : ?>
        <option value="<?= rex_escape($group['group_id']); ?>" <?= $rex_var_group == $group['group_id'] ? 'selected' : '' ?>>
          <?= rex_escape($group['group_name']); ?>
        </option>
        <?php endforeach; ?>
    </select>
</div>
<div class="form-group">
    <div class="checkbox">
        <label>
            <input type="hidden" name="REX_INPUT[2]" value="false">
            <input type="checkbox" name="REX_INPUT_VALUE[2]" value="true" <?= $rex_var_heading == 'true' ? 'checked' : '' ?>>
            Überschrift über den Links anzeigen
        </label>
    </div>
</div>
