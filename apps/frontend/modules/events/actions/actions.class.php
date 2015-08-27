<?php

/**
 * events actions.
 *
 * @package    trevents
 * @subpackage events
 * @author     Ville Riikonen § huqa
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class eventsActions extends sfActions
{
 /**
  * The trevents main page index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request) {
  	// -4 hours, so the events change at 04:00
  	$date_now = new Doctrine_Expression('DATE(NOW() - INTERVAL 4 HOUR)');
  	$date_future = new Doctrine_Expression('DATE_ADD(DATE(NOW() - INTERVAL 4 HOUR) , INTERVAL 7 DAY)');
    $this->seven_day_events = Doctrine_Core::getTable('Event')
    								->createQuery('e')
    								->where('e.date > '. $date_now)
    								->andWhere('e.date < '. $date_future)
    								->execute();
    $this->todays_events = Doctrine_Core::getTable('Event')
    								->createQuery('c')
    								->where('c.date = '. $date_now)
    								->execute();
    
    date_default_timezone_set('Europe/Helsinki');
    $date = new DateTime();
    // Timestamp is always minus 4 hours so we get the 'day change' at 04:00
    $stamp = $date->getTimestamp()-14400;
    $this->getUser()->setTimestamp($stamp);
    $todays_name = date('D', $stamp); 
    $date_now = array();
    $date_now[$this->convertToFinnishDay($todays_name)] = date('d.m', $stamp);
    $this->date_now = $date_now;
    $this->week_dates = $this->generateWeekDates($stamp);
	$this->categories = Doctrine_Core::getTable('Category')->getCategories();
	//$this->selected_filters = $this->getUser()->getCategoryFilters();
	//$this->selected_filters = ($this->selected_filters) ? $this->selected_filters : array();
	$this->selected_filters = array();
	$this->getUser()->clearFilters();
	$this->selected_timestamp = $stamp;
	
  }
  
  /**
   * XMLHttp-Action for getting events based on category filters
   * @param sfWebRequest $request
   * @return SfView::NONE or renders partial
   */
  public function executeFilters(sfWebRequest $request) {
  	if($request->isXmlHttpRequest()) {
  		if($request->getParameter('filters')) {
  			$filters = $request->getParameter('filters');
  				$saved_filters = $this->getUser()->getCategoryFilters();
  				if($saved_filters == null) { $saved_filters = array(); }
  				if(in_array($filters, $saved_filters)) {
  					$this->getUser()->removeCategoryFilter($filters);
  				} else {
  					$this->getUser()->setCategoryFilter($filters);
  					// If all the categories are active -> remove them from sfUser 
  					if(count($this->getUser()->getCategoryFilters()) == Doctrine_Core::getTable('Category')->getCategories()->count()) {
  						$this->getUser()->clearFilters();
  					}
  				}
  				$timestamp = $this->getUser()->getTimestamp();
  				if($timestamp == null) {
  					$date = new DateTime();
  					$timestamp = $date->getTimestamp()-14400;  					
  				}
  				$filters = $this->getUser()->getCategoryFilters();
  				if($filters == null) { $filters = array(); }
  				$this->seven_day_events = $this->fetchSevenDayEvents($timestamp, $filters);
  				$this->todays_events = $this->fetchTodaysEvents($timestamp, $filters);
  				date_default_timezone_set('Europe/Helsinki');
  				$todays_name = date('D', $timestamp);
  				$date_now = array();
  				$date_now[$this->convertToFinnishDay($todays_name)] = date('d.m', $timestamp);
  				$this->date_now = $date_now;
  				$dates = $this->generateWeekDates($timestamp);
  				
  				//var_dump($filters);
  				return $this->renderPartial('events/events', array('week_dates' => $dates, 'seven_day_events' => $this->seven_day_events, 'todays_events' => $this->todays_events, 'date_now' => $this->date_now));  				
  		}
  	}
  	return sfView::NONE;
  }
  
  /**
   * XMLHttp-Action for getting events based on a time stamp 
   * @param sfWebRequest $request
   * @return SfView::NONE or renders partial
   */
  public function executeFetch(sfWebRequest $request) {
  	if($request->isXmlHttpRequest()) {
  		if($request->getParameter("tstamp")) {
  			$timestamp = (int)$request->getParameter("tstamp");
  			if(!is_numeric($timestamp)) {
  				//var_dump("OH DOGE WOW");
  				return sfView::NONE;
  			}
  			$this->getUser()->setTimestamp($timestamp);
  			$filters = $this->getUser()->getCategoryFilters();
  			$this->seven_day_events = $this->fetchSevenDayEvents($timestamp, $filters);
  			$this->todays_events = $this->fetchTodaysEvents($timestamp, $filters);
  			date_default_timezone_set('Europe/Helsinki');
  			$todays_name = date('D', $timestamp);
  			$date_now = array();
  			$date_now[$this->convertToFinnishDay($todays_name)] = date('d.m', $timestamp);
  			$this->date_now = $date_now;
  			//+6 dates
  			$dates = $this->generateWeekDates($timestamp);
  			return $this->renderPartial('events/events', array('week_dates' => $dates, 'seven_day_events' => $this->seven_day_events, 'todays_events' => $this->todays_events, 'date_now' => $this->date_now));  			
  		}
  	}
  	return sfView::NONE;
  }
  
  /**
   * The about page
   * @param sfWebRequest $request
   */
  public function executeAbout(sfWebRequest $request) {  }
  
  /**
   * Fetches todays events according to timestamps or categories.
   * This should be in the model but I'm lazy as fuck.
   * @param Unixtime $timestamp
   * @param Array $filters
   * @return Doctrine_Collection The executed Doctrine query
   */
  protected function fetchTodaysEvents($timestamp, $filters) {
  	$date_now = new Doctrine_Expression('DATE(FROM_UNIXTIME('. $timestamp .'))');
  	$this->todays_events = Doctrine_Core::getTable('Event')
  		->createQuery('c')
  		->distinct()
  		->innerJoin('c.EventCategory AS ec')
  		->where('c.date = '. $date_now);
  	// Fucking Doctrine parenthesis -- I'll build my own sql query! With blackjack and hookers!
  	if(count($filters) >= 1) {
  		$i = 1;
  		$query_string = "";
  		foreach ($filters as $f) {
  			if($i == 1) {
  				$i++;
  				$query_string = '((ec.category_id = '.$f.' AND ec.event_id = c.id) ';
  			} else {
  				$query_string .= 'OR (ec.category_id = '.$f.' AND ec.event_id = c.id) ';
  			}
  		}
  		$query_string .= ')';
  		$this->todays_events->andWhere($query_string);
  	}
  	//var_dump($this->todays_events->getSqlQuery());
  	return $this->todays_events->execute();  	
  }
  
  /**
   * Fetches seven(or six) days events according to timestamps or categories.
   * Again this should be in the model, but fuck it. It's easier to debug this when it's here.
   * @param unknown $timestamp
   * @param unknown $filters
   * @return Doctrine_Collection The executed Doctrine query
   */
  protected function fetchSevenDayEvents($timestamp, $filters) {
  	// -4 hours, so the events change at 04:00
  	$date_now = new Doctrine_Expression('DATE(FROM_UNIXTIME('. $timestamp .'))');
  	$date_future = new Doctrine_Expression('DATE_ADD(DATE(FROM_UNIXTIME('. $timestamp .')), INTERVAL 7 DAY)');
  	$this->seven_day_events = Doctrine_Core::getTable('Event')
  		->createQuery('e')
  		->innerJoin('e.EventCategory AS ec')
  		//->innerJoin('ec.Category AS cg')
  		->andwhere('e.date > '. $date_now)
  		->andWhere('e.date < '. $date_future);
  	if(count($filters) >= 1) {
  		$i = 1;
  		$query_string = "";
  		foreach ($filters as $f) {
  			if($i == 1) {
  				$i++;
  				$query_string = '((ec.category_id = '.$f.' AND ec.event_id = e.id) ';
  			} else {
  				$query_string .= 'OR (ec.category_id = '.$f.' AND ec.event_id = e.id) ';
  			}
  		}
  		$query_string .= ')';
  		$this->seven_day_events->andWhere($query_string);
  	}
  	return $this->seven_day_events->execute();  	
  }
  
  /**
   * Converts three-letter day names to finnish uppercase two-letter day names.
   * 
   * @param string $day The day in english from the date('D') function.
   * @return string
   */
  protected function convertToFinnishDay($day) {
	switch ($day) {
		case 'Mon':
			return 'MA';
		case 'Tue':
			return 'TI';
		case 'Wed':
			return 'KE';
		case 'Thu':
			return 'TO';
		case 'Fri':
			return 'PE';
		case 'Sat':
			return 'LA';
		case 'Sun':
			return 'SU';
		default:
			return 'Päivää ei löydy';	
	}
  }
  
  /**
   * Generates an array of dates ranging from timestamp to six days in the future
   * @param int $stamp Unix timestamp
   * @return multitype:string array of dates
   */
  protected function generateWeekDates($stamp = null) {
  	if($stamp === null || !is_numeric($stamp)) {
  		$date = new DateTime();
  		$stamp = $date->getTimestamp();
  	}
  	$dates = array();
  	for($i = 1; $i < 7; $i++) {
  		// Jump ahead 24h * day number
  		$day = $stamp+(86400*$i);
  		$date = date('d.m', $day);
  		$day_name = date('D', $day);
  		$dates[$this->convertToFinnishDay($day_name)] = $date;
  	}
  	return $dates;
  }
}
