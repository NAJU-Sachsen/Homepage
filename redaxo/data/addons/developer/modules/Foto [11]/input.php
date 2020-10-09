
<div class="form-inline" style="margin-bottom: 20px;">
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
    <div class="form-group" style="margin-left: 20px;">
        <label>
            <input type="hidden" name="REX_INPUT_VALUE[4]" value="false">
            <input type="checkbox" name="REX_INPUT_VALUE[4]" value="true" <?= "REX_VALUE[id=4 ifempty='']" == 'true' ? 'checked' : '' ?>>
            tolle Bildeffekte aktivieren?
        </label>
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

<div class="form-group">
    <label for="fancy-color">Effektfarbe für die tollen Bildeffekte</label>
    <select name="REX_INPUT_VALUE[5]" class="form-control" id="fancy-color">
        <option value="random">zufällig</option>
        <option value="img-fancy-default">Standard (Dunkelrot)</option>
        <option value="img-fancy-green">Maigrün (Hellgrün)</option>
        <option value="img-fancy-green-alternate">Laubgrün (Dunkelgrün)</option>
    </select>
</div>

<div class="form-group">
        <label>Eine Verlinkung einfügen?</label>
        REX_LINK[id=1 widget=1]
</div>
