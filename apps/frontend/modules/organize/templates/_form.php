<form action="<?php echo url_for('organize/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> class="form-horizontal well">
<?php if(isset($msg)):?>
	<?php if($msg == true):?>
		<div class="alert alert-success">
  			<button type="button" class="close" data-dismiss="alert">&times;</button>
  			<h4 style="color: white">Tallennettu!</h4>
  			Tapahtumasi tallennettiin onnistuneesti!
  			&nbsp;&nbsp;<a class="btn btn-info" href="<?php echo url_for('organize/new') ?>">Luo uusi tapahtuma</a>
		</div>
	<?php endif; ?>
<?php endif;?>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
	<div class="control-group">
		<label for="event_category_id" class="control-label">Genre</label>
		<div class="controls">
			<?php if($form['category_ids']->hasError()):?>
			<div class="alert alert-error">
			<?php echo $form['category_ids']->renderError(); ?>
			<?php echo $form['category_ids']; ?>
			</div>
			<?php else:?>
			<?php echo $form['category_ids']; ?>
			<?php endif;?>
		</div>
	</div>

	<div class="control-group">
		<label for="event_name" class="control-label">Tapahtuman nimi</label>
		<div class="controls">
			<?php if($form['name']->hasError()):?>
			<div class="alert alert-error">
			<?php echo $form['name']->renderError(); ?>
			<?php echo $form['name']; ?>
			</div>
			<?php else:?>
			<?php echo $form['name']; ?>
			<?php endif;?>
		</div>
	</div>
	
	<div class="control-group">
		<label for="event_description" class="control-label">Kuvaus</label>
		<div class="controls">
			<?php if($form['description']->hasError()):?>
			<div class="alert alert-error">
			<?php echo $form['description']->renderError(); ?>
			<?php echo $form['description']; ?>
			</div>
			<?php else:?>
			<?php echo $form['description']; ?>
			<?php endif;?>
		</div>
	</div>
	
	<div class="control-group">
		<label for="event_venue" class="control-label">Paikka</label>
		<div class="controls">

			<?php if($form['venue']->hasError()):?>
			<div class="alert alert-error">
			<?php echo $form['venue']->renderError(); ?>
			<?php echo $form['venue']; ?>
			</div>
			<?php else:?>
			<?php echo $form['venue']; ?>
			<?php endif;?>
		</div>
	</div>
	
	<div class="control-group">
		<label for="event_event_url" class="control-label">Tapahtuman URL</label>
		<div class="controls">

			<?php if($form['event_url']->hasError()):?>
			<div class="alert alert-error">
			<?php echo $form['event_url']->renderError(); ?>
			<?php echo $form['event_url']; ?>
			</div>
			<?php else:?>
			<?php echo $form['event_url']; ?>
			<?php endif;?>
		</div>
	</div>	
	
	<div class="control-group">
		<label for="event_date" class="control-label">Päivämäärä</label>
		<div class="controls">
		<div class="input-append">
		<div id="date-picker" class="date">
			<?php if($form['date']->hasError()):?>
			<div class="alert alert-error">
			<?php echo $form['date']->renderError(); ?>
			<?php echo $form['date']; ?>
				<span class="add-on">
				<i class="icon-time"></i>
				</span>
			</div>
			<?php else:?>
			<?php echo $form['date']; ?>
				<span class="add-on">
				<i class="icon-time"></i>
				</span>
			<?php endif;?>
			
		</div>
		</div>
		</div>
	</div>

	<div class="control-group">
		<label for="event_start_time" class="control-label">Alkamisaika</label>
		<div class="controls">
			<div class="input-append">
			<div id="aa-picker" class="bootstrap-timepicker">
			<?php if($form['start_time']->hasError()):?>
			<div class="alert alert-error">
			<?php echo $form['start_time']->renderError(); ?>
			<?php echo $form['start_time']; ?>
				<span class="add-on">
				<i class="icon-time"></i>
				</span>
			</div>
			<?php else:?>
			<?php echo $form['start_time']; ?>
				<span class="add-on">
				<i class="icon-time"></i>
				</span>
			<?php endif;?>
    		</div>
    		</div>
		</div>
	</div>

	<div class="control-group">
		<label for="event_end_time" class="control-label">Päättymisaika</label>
		<div class="controls">
			<div class="input-append">
			<div id="pa-picker" class="bootstrap-timepicker">
			<?php if($form['end_time']->hasError()):?>
			<div class="alert alert-error">
			<?php echo $form['end_time']->renderError(); ?>
			<?php echo $form['end_time']; ?>
				<span class="add-on">
				<i class="icon-time"></i>
				</span>
			</div>
			<?php else:?>
			<?php echo $form['end_time']; ?>
				<span class="add-on">
				<i class="icon-time"></i>
				</span>
			<?php endif;?>
    		</div>
    		</div>
		</div>
	</div>
	
	<div class="control-group">
		<label for="event_price" class="control-label">Hinta</label>
		<div class="controls">
			<div class="input-append">
			<?php if($form['price']->hasError()):?>
			<div class="alert alert-error">
			<?php echo $form['price']->renderError(); ?>
			<?php echo $form['price']; ?>
				<span class="add-on">
				€
				</span>
			</div>
			<?php else:?>
			<?php echo $form['price']; ?>
				<span class="add-on euro_add_on">
				€
				</span>
			<?php endif;?>
			</div>
		</div>
	</div>
	
	<div class="control-group">
		<?php //echo $form->renderHiddenFields() ?>
		<?php echo $form['_csrf_token'] ?>
		<div class="controls">
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Poista', 'organize/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Oletko varma, että haluat poistaa tapahtuman?', 'class' => 'btn btn-danger')) ?>
          <?php endif; ?>
          <input type="submit" value="Tallenna" class="btn btn-primary"/>
          <?php echo $form['organizer_id'] ?>
		</div>
		<div class="controls"><br />&nbsp;<a class="btn btn-info" href="<?php echo url_for('organize/index') ?>">Palaa tapahtumalistaan</a></div>
	</div>
</form>

<script type="text/javascript">
  $(function() {
    
	$.fn.datetimepicker.dates['fi-FI'] = {
			days: ["Sunnuntai", "Maanantai", "Tiistai", "Keskiviikko", "Torstai", "Perjantai", "Lauantai", "Sunnuntai"],
			daysShort: ["Su", "Ma", "Ti", "Ke", "To", "Pe", "La", "Su"],
			daysMin: ["Su", "Ma", "Ti", "Ke", "To", "Pe", "La", "Su"],
			months: ["Tammikuu", "Helmikuu", "Maaliskuu", "Huhtikuu", "Toukokuu", "Kesäkuu", "Heinäkuu", "Elokuu", "Syyskuu", "Lokakuu", "Marraskuu", "Joulukuu"],
			monthsShort: ["Tammi", "Helmi", "Maalis", "Huhti", "Touko", "Kesä", "Heinä", "Elo", "Syys", "Loka", "Marras", "Joulu"],
			today: "Tänään"
	};
    $('#date-picker').datetimepicker({
        pickTime: false,
        language: "fi-FI",
        maskInput: true,
        weekStart: 1
     });
    $('#event_date').focus(function() {
		$('.icon-calendar').click();
    });
   $('#event_description').maxlength({
	   alwaysShow: true,
	   placement: "bottom-right",
	   postText: " merkkiä jäljellä.",
	   ignoreBreaks: false
 	});
   $('#event_name').maxlength({
	   alwaysShow: true,
	   placement: "bottom-right",
	   postText: " merkkiä jäljellä."
 	});
   $('#event_venue').maxlength({
	   alwaysShow: true,
	   placement: "bottom-right",
	   postText: " merkkiä jäljellä."
 	});
  });
</script>
