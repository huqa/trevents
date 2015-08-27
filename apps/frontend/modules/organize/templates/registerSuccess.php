<h3>Rekisteröidy organisoijaksi</h3>
<form action="register" method="post" class="form-horizontal well">

	<div class="control-group">
		<label for="organizer_name" class="control-label">Organisoijan nimi</label>
		<div class="controls">
			<?php if($form['name']->hasError()):?>
			<div class="alert alert-error">
			<?php echo $form['name']->renderError(); ?>
				<input type="text" name="organizer[name]" id="organizer_name">
			</div>
			<?php else:?>
				<input type="text" name="organizer[name]" id="organizer_name">
			<?php endif;?>
		</div>
	</div>

	<div class="control-group">
		<label for="organizer_email" class="control-label">Sähköposti</label>
		<div class="controls">
			<?php if($form['email']->hasError()):?>
			<div class="alert alert-error">
			<?php echo $form['email']->renderError(); ?>
				<input type="text" name="organizer[email]" id="organizer_email">
			</div>
			<?php else:?>
				<input type="text" name="organizer[email]" id="organizer_email">
			<?php endif;?>
		</div>
	</div>

	<div class="control-group">
		<label for="organizer_password" class="control-label">Salasana</label>
		<div class="controls">
			<?php if($form['password']->hasError()):?>
			<div class="alert alert-error">
			<?php echo $form['password']->renderError(); ?>
			<input type="password" name="organizer[password]"
				id="organizer_password">
			</div>
			<?php else:?>
			<input type="password" name="organizer[password]"
				id="organizer_password">
			<?php endif;?>
		</div>
	</div>

	<div class="control-group">
		<label for="organizer_password2" class="control-label">Salasana
			uudestaan</label>
		<div class="controls">
			<?php if($form['password']->hasError()):?>
			<div class="alert alert-error">
			<?php echo $form['password']->renderError(); ?>
			<input type="password" name="organizer[password2]"
				id="organizer_password2">
			</div>
			<?php else:?>
			<input type="password" name="organizer[password2]"
				id="organizer_password2">
			<?php endif;?>
		</div>
	</div>

	<div class="control-group">
		<label for="organizer_phone_c" class="control-label">Paljonko on kaksi plus kolme? (Vastaus numerolla)</label>
		<div class="controls">
			<?php if($form['phone_c']->hasError()):?>
			<div class="alert alert-error">
			<?php echo $form['phone_c']->renderError(); ?>
			<input type="text" name="organizer[phone_c]"
				id="organizer_phone_c">
			</div>
			<?php else:?>
			<input type="text" name="organizer[phone_c]"
				id="organizer_phone_c">
			<?php endif;?>
		</div>
	</div>	
	
	<div class="control-group">
		<?php echo $form->renderHiddenFields() ?>
		<div class="controls">
			<input type="submit" value="LÄHETÄ" class="btn btn-primary" />
		</div>
	</div>
</form>
