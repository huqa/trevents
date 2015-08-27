<?php

/**
 * organize actions.
 *
 * @package    trevents
 * @subpackage organize
 * @author     Ville Riikonen § huqa
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class organizeActions extends sfActions
{
	public function executeIndex(sfWebRequest $request)
	{
		//var_dump($this->getUser());
		$this->events = Doctrine_Core::getTable('Event')
		->createQuery('a')
		->where('organizer_id = ?', $this->getUser()->getOrganizerId())
		->andWhere('a.date > DATE_SUB(NOW(), INTERVAL 14 DAY)')
		->orderBy('a.date ASC')
		->execute();
	}

	public function executeShow(sfWebRequest $request)
	{
		$this->event = Doctrine_Core::getTable('Event')->find(array($request->getParameter('id')));
		$this->forward404Unless($this->event);
		$this->forward404Unless($this->getUser()->isOwner($this->event));
	}

	public function executeNew(sfWebRequest $request)
	{
		$this->form = new EventForm();
		$this->msg = false;
	}

	public function executeCreate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$this->form = new EventForm();

		$this->processForm($request, $this->form);

		$this->setTemplate('new');
	}
	
	public function executeAbout(sfWebRequest $request) {
				
	}

	public function executeEdit(sfWebRequest $request)
	{
		$event = Doctrine_Core::getTable('Event')->find(array($request->getParameter('id')));
		$this->forward404Unless($event, sprintf('Tapahtumaa ei ole olemassa (%s).', $request->getParameter('id')));
		$this->forward404Unless($this->getUser()->isOwner($event));
		$this->msg = false;
		if ($request->getParameter('m') && $this->getUser()->getAttribute('m') == 1) {
			$this->msg = true;
			$this->getUser()->setAttribute('m', null);
		}
		$this->form = new EventForm($event);
	}

	public function executeUpdate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($event = Doctrine_Core::getTable('Event')->find(array($request->getParameter('id'))), sprintf('Tapahtumaa ei ole olemassa (%s).', $request->getParameter('id')));
		$this->form = new EventForm($event);

		$this->processForm($request, $this->form);

		$this->setTemplate('edit');
	}

	public function executeDelete(sfWebRequest $request)
	{
		$request->checkCSRFProtection();

		$this->forward404Unless($event = Doctrine_Core::getTable('Event')->find(array($request->getParameter('id'))), sprintf('Tapahtumaa ei ole olemassa (%s).', $request->getParameter('id')));
		$event->delete();

		$this->redirect('organize/index');
	}

	public function executeRegister(sfWebRequest $request)
	{
		//$this->forward('events','index');
		if(!$this->getUser()->isAuthenticated()) {
			$this->form = new RegisterOrganizerForm();
			if($request->isMethod(sfRequest::POST)) {
				// register new user
				$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
				$this->processOrganizerForm($request, $this->form);
			}
		} else {
			// this user has an account (and is logged in)
			$this->redirect('organize/index');
		}
	}

	protected function processForm(sfWebRequest $request, sfForm $form)
	{
		//var_dump($request->getParameter('event[start_time]'));
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		if ($form->isValid())
		{

			//$event = $form->save();
			$name = $form->getValue('name');
			$venue = $form->getValue('venue');
			$description = $form->getValue('description');
			$price = $form->getValue('price');
			$c_ids = $form->getValue('category_ids');
				
			$event_url = $form->getValue('event_url');
			$start_time = $form->getValue('start_time');
			$end_time = $form->getValue('end_time');
			$date = $form->getValue('date');
			$o_id = $form->getValue('organizer_id');
			
			$event = null;
			if(!$form->getObject()->isNew()) {
				$event = $form->getObject();
				//Delete previous relations to genres
				Doctrine_Core::getTable('EventCategory')
				->createQuery()
				->delete()
				->where('event_id = ?', $event->getId())
				->execute();
			} else {
				$event = new Event();
			}
			
			if($event === null) {
				$event = new Event();
			}
			//$event = new Event();
			//$event->setCategoryId($c_id);
			$event->setName($name);
			$event->setDescription($description);
			$event->setPrice($price);
			$event->setVenue($venue);
			
			$event->setEventUrl($event_url);
			$event->setStartTime($start_time);
			$event->setEndTime($end_time);
			$event->setOrganizerId($o_id);
			$sql_date = date("Y-m-d", strtotime($date));
			$event->setDate($sql_date);
			
			$event->save();
			
			foreach($c_ids as $cid) {
				$ec = new EventCategory();
				$ec->setEventId($event->getId());
				$ec->setCategoryId($cid);
				$ec->save();
			}
			$this->getUser()->setAttribute('m', 1);
			$this->redirect('organize/edit?id='.$event->getId().'&m=1');
		}
	}

	protected function processOrganizerForm(sfWebRequest $request, sfForm $form) {
		//$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		if ($form->isValid())
		{
			//$form->save();
			$name = $form->getValue('name');
			$email = $form->getValue('email');
			//$colour = $form->getValue('colour_code');

			$guard_user = new sfGuardUser();
			$guard_user->setEmailAddress($email);
			$guard_user->setUsername($email);
			$guard_user->setPassword($form->getValue('password'));
			$guard_user->setIsActive(1);
			$guard_user->save();

			$organizer = new Organizer();
			$organizer->setName($name);
			$organizer->setSfGuardId($guard_user->getId());
			//$organizer->setColourCode($colour);
			$organizer->save();

			$this->redirect('organize/new');
		}
	}
}
