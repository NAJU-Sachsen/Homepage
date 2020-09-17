
<input type="hidden" name="REX_INPUT_VALUE[1]" value="<?= rex_escape(rex_get('slice_id')); ?>">

<div class="form-group">
	<label>Maximale Höhe (px):</label>
	<div class="input-group">
		<input type="number" name="REX_INPUT_VALUE[2]" value="REX_VALUE[id=2 ifempty=0]" min="0" class="form-control">
		<div class="input-group-addon">
			<span class="input-group-text">0 zum deaktivieren</span>
		</div>
	</div>
</div>

<div class="form-group">
	<label>Bilder auswählen:</label>
	REX_MEDIALIST[id=1 widget=1 types=jpg,jpeg,png]
</div>
