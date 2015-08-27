<?php

class myUser extends sfGuardSecurityUser
{
	
	public function setTimestamp($timestamp) {
		if(is_numeric((int)$timestamp) && $timestamp !== null) {
			$this->setAttribute('ts', $timestamp);
		}
	}
	
	public function getTimestamp() {
		return $this->getAttribute('ts', null);
	}
	
	public function removeCategoryFilter($category) {
		if(is_numeric($category)) {
			$filters = $this->getAttribute('filters', null);
			if($filters != null) {
				$new_filters = array();
				foreach ($filters as $f) {
					if ($f !== $category) {
						array_push($new_filters, $f);
					} 
				}
				$this->setAttribute('filters', $new_filters);
			} 
		}		
	} 
	
	public function setCategoryFilter($category) {
		if(is_numeric($category)) { 
			$filters = $this->getAttribute('filters', null);
			if($filters != null) {
				array_push($filters, $category);
				$this->setAttribute('filters', $filters);
			} else {
				$this->setAttribute('filters', array($category));
			}
		}
	}
	
	public function getCategoryFilters() {
		$filters = $this->getAttribute('filters', null);
		if ($filters !== null) {
			return $filters;
		} else {
			return null;
		}
	}
	
	public function clearFilters() {
		$filters = $this->getAttribute('filters', null);
		if ($filters !== null) {
			$this->setAttribute('filters', null);
		} 
	}
	
	public function getOrganizerId() {
		if($this->isAuthenticated()) {
			$oid = $this->getAttribute('oid', null);
			if ($oid == null) {
				$params = $this->getAttributeHolder()->getAll('sfGuardSecurityUser');
				$organizer = Doctrine_Core::getTable('Organizer')->createQuery('b')
					->where('b.sf_guard_id = ?', $params['user_id'])->execute();
				if($organizer) {
					$this->setAttribute('oid',  $organizer[0]->getId());
					return $organizer[0]->getId();
				} else {
					return null;
				}
			} else {
				return $oid; 
			}
		}
	}
	
	public function isOwner($event) {
		if(is_object($event)) {
			if($this->getOrganizerId() == $event->getOrganizerId()) {
				return true;
			} 
		}
		return false;
	}
	
	
}
