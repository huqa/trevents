<?php 
function addhttp($url) {
	if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
		$url = "http://" . $url;
	}
	return $url;
}
?>

		<div id="today_container">
			<div id="today_banner">
				<?php foreach($date_now as $d => $p):?>
					<?php echo $d . " " . $p; ?>
				<?php endforeach;?>
			</div>
			<div id="today_events">
				<?php if ($todays_events->count() === 0): ?>
					<?php echo "Ei tapahtumia tälle päivälle.";?>
				<?php endif; ?>
				<?php foreach ($todays_events as $t_event): ?>
				<div class="today_event">
				<?php if(Doctrine_Core::getTable('Category')->getCategoryCount($t_event->getId()) > 1): ?>
					<div class="event_name colour_multi">
				<?php else: ?>
					<?php $e_c = $t_event->EventCategory[0]; ?>
					<div class="event_name colour_<?php echo $e_c->getCategoryId(); ?>">
				<?php endif; ?>
						<?php echo $t_event->getName(); ?>
					</div>
					<div class="event_info">
							<?php $e_u = $t_event->getEventUrl(); ?>
							<?php if(empty($e_u)): ?> 
							<?php echo $t_event->getVenue() ." / ". date('H:i', strtotime($t_event->getStartTime())) ."-". date('H:i', strtotime($t_event->getEndTime())) ." / ".$t_event->getPrice(). "€"; ?>
							<?php else: ?>
							<?php echo $t_event->getVenue() ." / ". date('H:i', strtotime($t_event->getStartTime())) ."-". date('H:i', strtotime($t_event->getEndTime()))." / " .$t_event->getPrice(). "€ / ".'<a target="_blank" href="'.addhttp($e_u).'"><i class="icon-globe icon-white"></i></a>'; ?>
							<?php endif; ?>
					</div>
					<div class="event_description">
						<?php echo $t_event->getDescription(); ?>
					</div>
					</div>
					<div class="separator"></div>
				<?php endforeach; ?>
			</div>
		</div>

		<div id="week_container">
			<?php $date_has_events = array(); ?>
			<?php foreach($week_dates as $d => $p):?>
				<?php foreach($seven_day_events as $sd_event):?>
					<?php if(date('d.m', strtotime($sd_event->getDate())) === $p):?>
						<?php $date_has_events[$p] = 1; ?>
					<?php endif; ?>
				<?php endforeach; ?>
				<?php if(isset($date_has_events[$p])):?>
					<?php if($date_has_events[$p] === 1): ?>
					<div class="weekday_banner">
						<?php echo $d . " " . $p?>
					</div>
					<?php endif; ?>
				<?php endif; ?>
				<?php foreach($seven_day_events as $sd_event):?>
					<?php if(date('d.m', strtotime($sd_event->getDate())) === $p):?>
					<div class="weekday_event">
						<?php if(Doctrine_Core::getTable('Category')->getCategoryCount($sd_event->getId()) > 1): ?>
							<div class="week_event_name colour_multi">
						<?php else: ?>
							<?php $e_c = $sd_event->EventCategory[0]; ?>
							<div class="week_event_name colour_<?php echo $e_c->getCategoryId(); ?>">
						<?php endif; ?>
							<?php echo $sd_event->getName(); ?>
						</div>
						<div class="week_event_info">
							<?php $e_u = $sd_event->getEventUrl(); ?>
							<?php if(empty($e_u)): ?> 
							<?php echo $sd_event->getVenue() ." / ". date('H:i', strtotime($sd_event->getStartTime())) ."-". date('H:i', strtotime($sd_event->getEndTime())) ." / ".$sd_event->getPrice(). "€"; ?>
							<?php else: ?>
							<?php echo $sd_event->getVenue() ." / ". date('H:i', strtotime($sd_event->getStartTime())) ."-". date('H:i', strtotime($sd_event->getEndTime()))." / " .$sd_event->getPrice(). "€ / ". '<a target="_blank" href="'.addhttp($e_u).'"><i class="icon-globe icon-white"></i></a>'; ?>
							<?php endif; ?>
						</div>
						<div class="week_event_description">
							<?php echo $sd_event->getDescription(); ?>
						</div>
						</div>	
						<div class="separator"></div>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</div>