


<div class="form-group">
	<label for="cards-count">Anzahl der aktiven Karten</label>
	<input type="number" name="REX_INPUT_VALUE[20]" id="cards-count" min="2" max="4" value="3" class="form-control" />
</div>

<div class="container-fluid">

	<div class="row">

		<div class="col-md-6">
			<?php $card1 = naju_rex_var::toArray('REX_VALUE[1]'); ?>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Karte 1</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="panel-1-title">Titel</label>
						<input type="text" name="REX_INPUT_VALUE[1][title]" id="panel-1-title" class="form-control" value="<?= rex_escape($card1['title']) ?? ''; ?>" />
					</div>
					<div class="form-group">
						<label for="panel-1-content">Inhalt</label>
						<textarea name="REX_INPUT_VALUE[1][content]" rows="3" id="panel-1-content" class="form-control"><?= rex_escape($card1['content']) ?? ''; ?></textarea>
					</div>
					<div class="form-group">
						<label>Bild</label>
						REX_MEDIA[id=1 widget=1 types=jpg,jpeg,png preview=1]
					</div>
					<div class="form-group">
						<label for="panel-1-link-text">Link Text</label>
						<input type="text" name="REX_INPUT_VALUE[1][link-text]" id="panel-1-link-text" class="form-control" value="<?= rex_escape($card1['link-text']) ?? ''; ?>"/>
					</div>
					<div class="form-group">
						<label>Link Ziel</label>
						REX_LINK[id=1 widget=1]
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<?php $card2 = naju_rex_var::toArray('REX_VALUE[2]'); ?>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Karte 2</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="panel-2-title">Titel</label>
						<input type="text" name="REX_INPUT_VALUE[2][title]" id="panel-2-title" class="form-control" value="<?= rex_escape($card2['title']) ?? ''; ?>" />
					</div>
					<div class="form-group">
						<label for="panel-2-content">Inhalt</label>
						<textarea name="REX_INPUT_VALUE[2][content]" rows="3" id="panel-2-content" class="form-control"><?= rex_escape($card2['content']) ?? ''; ?></textarea>
					</div>
					<div class="form-group">
						<label>Bild</label>
						REX_MEDIA[id=2 widget=1 types=jpg,jpeg,png preview=1]
					</div>
					<div class="form-group">
						<label for="panel-2-link-text">Link Text</label>
						<input type="text" name="REX_INPUT_VALUE[2][link-text]" id="panel-2-link-text" class="form-control" value="<?= rex_escape($card2['link-text']) ?? ''; ?>"/>
					</div>
					<div class="form-group">
						<label>Link Ziel</label>
						REX_LINK[id=2 widget=1]
					</div>
				</div>
			</div>
		</div>

	</div>
	<div class="row">

	<div class="col-md-6">
			<?php $card3 = naju_rex_var::toArray('REX_VALUE[3]'); ?>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Karte 3</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="panel-3-title">Titel</label>
						<input type="text" name="REX_INPUT_VALUE[3][title]" id="panel-3-title" class="form-control" value="<?= rex_escape($card3['title']) ?? ''; ?>" />
					</div>
					<div class="form-group">
						<label for="panel-3-content">Inhalt</label>
						<textarea name="REX_INPUT_VALUE[3][content]" rows="3" id="panel-3-content" class="form-control"><?= rex_escape($card3['content']) ?? ''; ?></textarea>
					</div>
					<div class="form-group">
						<label>Bild</label>
						REX_MEDIA[id=3 widget=1 types=jpg,jpeg,png preview=1]
					</div>
					<div class="form-group">
						<label for="panel-3-link-text">Link Text</label>
						<input type="text" name="REX_INPUT_VALUE[3][link-text]" id="panel-3-link-text" class="form-control" value="<?= rex_escape($card3['link-text']) ?? ''; ?>"/>
					</div>
					<div class="form-group">
						<label>Link Ziel</label>
						REX_LINK[id=3 widget=1]
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<?php $card = naju_rex_var::toArray('REX_VALUE[4]'); ?>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Karte 4</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="panel-4-title">Titel</label>
						<input type="text" name="REX_INPUT_VALUE[4][title]" id="panel-4-title" class="form-control" value="<?= rex_escape($card4['title']) ?? ''; ?>" />
					</div>
					<div class="form-group">
						<label for="panel-4-content">Inhalt</label>
						<textarea name="REX_INPUT_VALUE[4][content]" rows="3" id="panel-4-content" class="form-control"><?= rex_escape($card4['content']) ?? ''; ?></textarea>
					</div>
					<div class="form-group">
						<label>Bild</label>
						REX_MEDIA[id=4 widget=1 types=jpg,jpeg,png preview=1]
					</div>
					<div class="form-group">
						<label for="panel-4-link-text">Link Text</label>
						<input type="text" name="REX_INPUT_VALUE[4][link-text]" id="panel-4-link-text" class="form-control" value="<?= rex_escape($card4['link-text']) ?? ''; ?>"/>
					</div>
					<div class="form-group">
						<label>Link Ziel</label>
						REX_LINK[id=4 widget=1]
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
