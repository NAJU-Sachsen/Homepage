
<!-- mod_table -->

<?php
// Redactor does not enable the specification of custom CSS classes on the table.
// Therefore we've got to add them by ourselves.

$table_content = 'REX_VALUE[id=1 output=html]';
$table_tag = '<table class="table">';

$table_content = preg_replace('/(\<table>).*/', $table_tag, $table_content, $count = 1);
?>

<div class="table-fluid">
    <?= $table_content; ?>
</div>
