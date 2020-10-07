
<?php
$full_redactor_profile = 'full';
$reduced_redactor_profile = 'links-bold-italic-lists';
$editor_type = rex::getUser()->isAdmin() ? $full_redactor_profile : $reduced_redactor_profile;
?>

<fieldset class="form-horizontal">
  <div class="form-group">
      <textarea class="form-control redactorEditor2-<?= $editor_type; ?>" name="REX_INPUT_VALUE[1]">REX_VALUE[1]</textarea>
  </div>
</fieldset>
