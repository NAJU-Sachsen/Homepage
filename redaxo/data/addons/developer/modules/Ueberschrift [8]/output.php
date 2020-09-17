
<!-- mod_heading -->

<?php $level = rex_var::parse('REX_VALUE[2]'); ?>

<header>
    <h<?= $level ?? 2; ?>>REX_VALUE[1]</h<?= $level ?? 2; ?>>
</header>
