<?php

/**
 * Organizer form base class.
 *
 * @method Organizer getObject() Returns the current form's model object
 *
 * @package    trevents
 * @subpackage form
 * @author     Ville Riikonen § huqa
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOrganizerForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'sf_guard_id' => new sfWidgetFormInputText(),
      'name'        => new sfWidgetFormInputText(),
      'colour_code' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'sf_guard_id' => new sfValidatorInteger(),
      'name'        => new sfValidatorString(array('max_length' => 80)),
      'colour_code' => new sfValidatorString(array('max_length' => 6)),
    ));

    $this->widgetSchema->setNameFormat('organizer[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Organizer';
  }

}
