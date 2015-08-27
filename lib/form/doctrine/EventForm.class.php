<?php

/**
 * Event form.
 *
 * @package    trevents
 * @subpackage form
 * @author     Ville Riikonen § huqa
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EventForm extends BaseEventForm
{
		
  	public function configure()
  	{
  		unset($this['id']);
  		$this->widgetSchema['category_ids'] = new sfWidgetFormDoctrineChoice(array(
  				'model'  => 'Category',
  				'multiple' => true,
  				'expanded' => true,
  				'renderer_options' => array('formatter' => array('EventForm', 'CategoryFormatter'))
  		));
  		$this->validatorSchema['category_ids'] = new sfValidatorDoctrineChoice(array(
  				'model'  => 'Category',
  				'multiple' => true,
  				'min' =>	  1
  				)); 		
  		if(!$this->getObject()->isNew()) {
  			$ids = Doctrine_Core::getTable('EventCategory')->getCategoriesByEventId($this->getObject()->getId());
  			$c_id = array();
  			foreach($ids as $id) {
  				$c_id[] = $id->getCategoryId();
  			}
  			$this->setDefault('category_ids', $c_id);
  		}
  		$this->widgetSchema['start_time'] = new sfWidgetFormInputText();
  		$this->widgetSchema['end_time'] = new sfWidgetFormInputText();
  		$this->widgetSchema['description'] = new sfWidgetFormTextarea();
  		// Format the date for the textfield as the regular finnish format
  		if(!$this->getObject()->isNew()) {
  			$this->widgetSchema['date'] = new sfWidgetFormInputText(array(),array('value' => date('d.m.Y', strtotime($this->getObject()->getDate()))));
  		} else {
  			$this->widgetSchema['date'] = new sfWidgetFormInputText();
  		}
  		$this->widgetSchema['category_ids']->setAttribute('class', 'checkbox');
  		$this->widgetSchema['name']->setAttribute('maxlength', '80');
  		$this->widgetSchema['venue']->setAttribute('maxlength', '80');
  		$this->widgetSchema['date']->setAttribute('data-format', 'dd.MM.yyyy');
  		$this->widgetSchema['date']->setAttribute('class', 'input-small');
  		$this->widgetSchema['price']->setAttribute('class', 'input-mini');
  		$this->widgetSchema['description']->setAttribute('maxlength', '240');
  		$this->widgetSchema['description']->setAttribute('cols', '34');
  		$this->widgetSchema['start_time'] = new sfWidgetFormTime(array('format_without_seconds' => '%hour%:%minute%', 'with_seconds' => false));
  		$this->widgetSchema['end_time'] = new sfWidgetFormTime(array('format_without_seconds' => '%hour%:%minute%', 'with_seconds' => false));
  		$this->widgetSchema['start_time']->setAttribute('class', 'input-small');
  		$this->widgetSchema['end_time']->setAttribute('class', 'input-small');
  		//$this->widgetSchema['start_time']->setAttribute('data-format', 'hh:mm');
  		//$this->widgetSchema['end_time']->setAttribute('data-format', 'hh:mm');
  		$this->validatorSchema['start_time'] = new sfValidatorTime(array(
  				'time_output' => 'H:i'),
  				array(
  						'bad_format'=>'Vääränmuotoinen aika',
  						'invalid' => 'Vääränmuotoinen aika',
  						'required'=>'Pakollinen kenttä'
  				));
  		$this->validatorSchema['end_time'] = new sfValidatorTime(array(
  				'time_output' => 'H:i'),
  				array(
  						'bad_format'=>'Vääränmuotoinen aika',
  						'invalid' => 'Vääränmuotoinen aika',
  						'required'=>'Pakollinen kenttä'
  				));
  		$this->widgetSchema['organizer_id'] = new sfWidgetFormInputHidden();
  		$this->widgetSchema['organizer_id']->setDefault(sfContext::getInstance()->getUser()->getOrganizerId());
  		//$this->widgetSchema['date']->setOption('format', '%day% / %month% / %year%');
  		//$this->getWidget($name)->se
  		//$this->widgetSchema['organizer_id']->setAttribute('style', 'visibility: hidden');
  		$this->useFields(array('category_ids','name','description','venue','price','event_url','start_time','end_time','date','organizer_id'));
  		
  		//$this->widgetSchema['organizer_id']->setDefault($this->getObject()->Organizer->getPrimaryKey());
  	}
  	
  	public static function CategoryFormatter($widget, $inputs) {
  		$result = '';
  		$input_count = count($inputs);
  		$i = 0;
  		foreach ($inputs as $input) {
  			$result .= '<label class="checkbox">'.strip_tags($input['label'])." ".$input['input'].'</label>';
  			$i++;
  		}
  		return $result;  		
  	}
  	
}
