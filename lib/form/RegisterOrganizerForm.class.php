<?php
/**
 * Form for registering new organizers
 * Essentially ties together organizer and sf_guard
 */

class RegisterOrganizerForm extends BaseForm {

	public function configure() {
		
		$this->setWidgets(array(
				'name'  		=> new sfWidgetFormInputText(),
				'email'   		=> new sfWidgetFormInputText(),
				'password'   	=> new sfWidgetFormInputPassword(),
				'password2'		=> new sfWidgetFormInputPassword(),
				'phone_c'		=> new sfWidgetFormInputText()
		));
		$this->widgetSchema->setLabels(array(
				'name'  		=> 'Organisoijan nimi',
				'email'   		=> 'Sähköposti',
				'password'  	=> 'Salasana',
				'password2'		=> 'Salasana uudestaan',
				'phone_c'		=> 'Paljonko on kaksi plus kolme?'
		));
		$this->setValidators(array(
				'name'			=> new sfValidatorString(array('max_length' => 80, 'required' => true)),
				'email'   		=> new sfValidatorEmail(array('max_length' => 255, 'required' => true), 
						array('invalid' => 'Sähköposti on virheellinen.')),
				'password'   	=> new sfValidatorString(array('max_length' => 255, 'required' => true)),
				'password2'   	=> new sfValidatorString(array('max_length' => 255, 'required' => true)),
				'phone_c'   	=> new sfValidatorInteger(array('required' => true, 'max' => 5, 'min' => 5), array('invalid' => 'Turvakysymys virheellinen.',
																													'max' => 'Turvakysymys virheellinen.', 'min' => 'Turvakysymys virheellinen.'))
				/*'colour_code'   => new sfValidatorAnd(array(new sfValidatorString(array('max_length' => 6, 'required' => true)), 
						new sfValidatorRegex(array('pattern' => "^(?:[0-9a-fA-F]{3}){1,2}$^"), array('invalid' => 'Tämä ei ole väri')))))*/
				)
		);
		$this->validatorSchema->setPostValidator(new sfValidatorSchemaCompare('password', '==', 'password2', 
				array(),
			    array('invalid' => 'Salasanat eivät täsmää')));	
		$this->widgetSchema->setNameFormat('organizer[%s]');
		//$this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
		
	}

}