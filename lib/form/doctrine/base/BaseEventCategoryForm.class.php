<?php

/**
 * EventCategory form base class.
 *
 * @method EventCategory getObject() Returns the current form's model object
 *
 * @package    trevents
 * @subpackage form
 * @author     Ville Riikonen § huqa
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEventCategoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'event_id'    => new sfWidgetFormInputHidden(),
      'category_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'event_id'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('event_id')), 'empty_value' => $this->getObject()->get('event_id'), 'required' => false)),
      'category_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('category_id')), 'empty_value' => $this->getObject()->get('category_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('event_category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EventCategory';
  }

}
