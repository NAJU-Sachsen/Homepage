
<?php
$event_query = <<<EOSQL
    select group_id, group_name
    from naju_local_group
EOSQL;

$local_groups = rex_sql::factory()->setQuery($event_query)->getArray();
?>

<div class="form-group">
    <label for="select-local-group">Ortsgruppe auswählen</label>
    <select class="form-control" name="REX_INPUT_VALUE[1]">
        <option value="-1">alle</option>

        <?php foreach ($local_groups as $group) : ?>
        <option value="<?= htmlspecialchars($group['group_id']); ?>" <?= "REX_VALUE[id=1 ifempty='']" == $group['group_id'] ? 'selected' : '' ?>><?= htmlspecialchars($group['group_name']); ?></option>
        <?php endforeach; ?>

    </select>
</div>
