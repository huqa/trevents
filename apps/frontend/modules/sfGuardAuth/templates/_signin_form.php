<?php use_helper('I18N') ?>

<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post"
	class="form-horizontal well">
	<div class="control-group">
		<label for="signin_username" class="control-label">Sähköposti</label>
		<div class="controls">

			<?php if($form['username']->hasError()):?>
			<div class="alert alert-error">
				<?php echo $form['username']->renderError() ?>
			<input type="text" name="signin[username]" id="signin_username"
				class="input-medium" placeholder="Sähköposti">
			</div>
			<?php else: ?>
			<input type="text" name="signin[username]" id="signin_username"
				class="input-medium" placeholder="Sähköposti">
			<?php endif; ?>
		</div>
	</div>
	<div class="control-group">
		<label for="signin_password" class="control-label">Salasana</label>
		<div class="controls">
			<?php if($form['password']->hasError()):?>
			<div class="alert alert-error">
				<?php echo $form['password']->renderError() ?>
			<input type="password" name="signin[password]" id="signin_password"
				class="input-medium" placeholder="Salasana">
			</div>
			<?php else: ?>
			<input type="password" name="signin[password]" id="signin_password"
				class="input-medium" placeholder="Salasana">
			<?php endif;?>
		</div>
	</div>
	<?php echo $form->renderHiddenFields(); ?>
	<div class="control-group">
		<div class="controls">
			<input type="submit"
				value="<?php echo __('Kirjaudu', null, 'sf_guard') ?>"
				class="btn btn-primary" />
		</div>
	</div>
	<div class="form-actions">
		<p class="help-block">Eikö ole tunnuksia? Rekisteröidy käyttäjäksi!</p>
		<a class="btn btn-warning"
			href="<?php echo url_for('organize/register')?>">Rekisteröidy</a>
	</div>
</form>
