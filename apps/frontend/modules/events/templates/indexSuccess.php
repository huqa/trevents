
<div class="container">
<div class="row">
<div class="span12">
	<div class="main_bar">
		<div class="mainbar_inner">
			<div id="add_event">
				<a href="<?php echo url_for('organize/new')?>">+Lisää tapahtuma</a>
				<?php if($sf_user->isAuthenticated()):?>
				<a class="pull-right" href="<?php echo url_for('@sf_guard_signout')?>">KIRJAUDU ULOS</a>
				<?php endif; ?>
			</div>
			<div class="trevent_banner">
				<h1>TAMPERE EVENTS</h1>
			</div>
		</div>
	</div>
	</div>
	</div>
<div class="row">
<div class="span8">
	<div class="wrapper" id="all_events">
		<?php include_partial('events', array('week_dates' => $week_dates, 'seven_day_events' => $seven_day_events, 'todays_events' => $todays_events, 'date_now' => $date_now))?>
	</div>
</div>
<div class="span4">
	<div id="calendar_picker"></div>
	<?php $selected_filters = $selected_filters->getRawValue(); ?>
	<div id="spacer"><div id="progress" style="display: none"></div></div>
	<div id="category_tags">
	Näytä tapahtumat:
		<ul id="tag_list">
		<?php foreach($categories as $cat): ?>
			<?php if(count($selected_filters) > 0): ?>
				<?php if (in_array($cat->getId(), $selected_filters)): ?> 
					<li class="colour_<?php echo $cat->getId(); ?>"><a href="#" class="active cat_link colour_<?php echo $cat->getId(); ?>" id='<?php echo $cat->getId(); ?>'><?php echo $cat->getCategoryName(); ?></a></li>
				<?php else: ?>
					<li class="colour_<?php echo $cat->getId(); ?>"><a href="#" class="inactive cat_link colour_inactive" id='<?php echo $cat->getId(); ?>'><?php echo $cat->getCategoryName(); ?></a></li>
				<?php endif;?>
			<?php else: ?>
					<li class="colour_<?php echo $cat->getId(); ?>"><a href="#" class="active cat_link colour_<?php echo $cat->getId(); ?>" id='<?php echo $cat->getId(); ?>'><?php echo $cat->getCategoryName(); ?></a></li>
			<?php endif;?>
		<?php endforeach;?>
		</ul>
	</div>
</div>
</div>
<div class="footer"><a id="about_link" href="<?php echo url_for('events/about')?>">Tietoja</a></div>
</div>
<script type="text/javascript">

$(document).ajaxStart(function () {
    $("#progress").show();
});

$(document).ajaxComplete(function () {
    $("#progress").hide();
});

$('.cat_link').click(function() {
	var active_class = "active";
	var inactive_class = "inactive";
	var all_elements = $('.cat_link').length;
	var active_elements = $('.active').length;
	var clicked_element = $(this);
	var pulse_delay = 800;
	$.ajax({
		url: "events/filters",
		data: { filters: clicked_element.attr('id') },
		success: function(response, textStatus, jqXHR) {
			$("#all_events").html(response);
			
			if (all_elements == active_elements) {
				if (clicked_element.hasClass(active_class)) {
					$.each($('.'+active_class).not(clicked_element), function() {
						$(this).removeClass(active_class); $(this).addClass(inactive_class);
					});
				}				
			} else if (active_elements == 1 && clicked_element.hasClass(active_class)) {
				$.each($('.'+inactive_class), function() {
					$(this).removeClass(inactive_class); $(this).addClass(active_class);
				});				
			} else {
				if(clicked_element.hasClass(inactive_class)) {
					clicked_element.removeClass(inactive_class); clicked_element.addClass(active_class);
				} else if (clicked_element.hasClass(active_class)) {
					clicked_element.removeClass(active_class); clicked_element.addClass(inactive_class);
				}
			}
		},
		complete: function() { 
			if(clicked_element.hasClass(active_class)) {
				clicked_element.addClass("pulsuta").delay(pulse_delay).queue(function(next) {
					clicked_element.removeClass("pulsuta");
					next();
				});				
			} 
			$.each($('.'+inactive_class), function() { 
				$(this).removeClass('colour_' + $(this).attr('id')); $(this).addClass('colour_inactive');
			});
			$.each($('.'+active_class), function() { 
				$(this).removeClass('colour_inactive'); $(this).addClass('colour_' + $(this).attr('id'));

			});
			
		}	
	});
	return false;
	
});

var ts_date = <?php if($selected_timestamp) { echo $selected_timestamp; } else { echo "null"; } ?>;
$('#calendar_picker').calendarsPicker({	
			calendar: $.calendars.instance('gregorian', 'fi'),
			dateFormat: '@',
			changeMonth: false,
			setDate: new Date(ts_date*1000),
			prevText: "<",
			nextText: ">",
			minDate: -14,
			maxDate: +730,
			selectDefaultDate: true,
			onSelect: function(dates) {
				// Jeez calendar, gimme a break
				$('#calendar_picker').calendarsPicker('setDate', $('#calendar_picker').calendarsPicker('getDate'));

				$.ajax({
					url: "events/fetch",
					data: { tstamp: dates[0].formatDate('@') },
                	success: function(response, textStatus, jqXHR){
                    	$("#all_events").html(response);
                	},
                	error: function(jqXHR, textStatus, errorThrown){
                    	console.log(
                    		"The following error occured: "+
                        	textStatus, errorThrown
                    	);
                	}
				});
				return false;
			}
		},
		$.calendars.picker.regional['fi']
);
</script>