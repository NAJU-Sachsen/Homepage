
<div class="form-inline">
    <div class="form-group">
        <label for="image-width">Breite</label>
        <div class="input-group">
            <input type="number" min="-1" id="image-width" name="REX_INPUT_VALUE[1]" value="REX_VALUE[id=1]" class="form-control">
            <span class="input-group-addon">px</span>
        </div>
    </div>
    <div class="form-group" style="margin-left: 20px;">
        <label for="image-height">Höhe</label>
        <div class="input-group">
            <input type="number" min="-1" id="image-height" name="REX_INPUT_VALUE[2]" value="REX_VALUE[id=2]" class="form-control">
            <span class="input-group-addon">px</span>
        </div>
    </div>
</div>

<div class="form-group">
    <label>Bild auswählen</label>
    REX_MEDIA[id=1 widget=1 types=jpg,jpeg,png]
</div>

<div class="form-group">
    <label for="image-align">Bild in den Textfluss integrieren?</label>
    <select name="REX_INPUT_VALUE[3]" id="image-align" class="form-control">
        <?php $img_integrate = 'REX_VALUE[id=3 ifempty=no-integrate]'; ?>
        <option value="no-integrate" <?= $img_integrate == 'no-integrate' ? 'selected' : '' ?>>nicht integrieren</option>
        <option value="integrate-left" <?= $img_integrate == 'integrate-left' ? 'selected' : '' ?>>links abbilden</option>
        <option value="integrate-right" <?= $img_integrate == 'integrate-right' ? 'selected' : '' ?>>rechts abbilden</option>
    </select>
</div>
