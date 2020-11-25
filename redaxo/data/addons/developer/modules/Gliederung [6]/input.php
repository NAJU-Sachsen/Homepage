
<div class="form-group">
	<label for="header-level">Stufe der Überschriften, für die die Gliederung erstellt werden soll</label>
	<input type="number" min="2" max="6" name="REX_INPUT_VALUE[1]" id="header-level" value="REX_VALUE[1 ifempty=3]" class="form-control">
</div>
<div class="form-group">
	<div class="checkbox">
		<input type="hidden" name="REX_INPUT_VALUE[2]" value="false">
		<label>
			<input type="checkbox" name="REX_INPUT_VALUE[2]" value="true" <?= 'REX_VALUE[2]' === 'true' ? 'checked' : '' ?>> die Gliederung nur aus dem Modul "Überschrift" erstellen
		</label>
	</div>
</div>