<?php

/**
 * Event form base class.
 *
 * @method Event getObject() Returns the current form's model object
 *
 * @package    trevents
 * @subpackage form
 * @author     Ville Riikonen § huqa
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEventForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'organizer_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organizer'), 'add_empty' => false)),
      'name'         => new sfWidgetFormInputText(),
      'description'  => new sfWidgetFormInputText(),
      'venue'        => new sfWidgetFormInputText(),
      'event_url'    => new sfWidgetFormInputText(),
      'start_time'   => new sfWidgetFormTime(),
      'end_time'     => new sfWidgetFormTime(),
      'price'        => new sfWidgetFormInputText(),
      'date'         => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'organizer_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Organizer'))),
      'name'         => new sfValidatorString(array('max_length' => 80)),
      'description'  => new sfValidatorString(array('max_length' => 240)),
      'venue'        => new sfValidatorString(array('max_length' => 80)),
      'event_url'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'start_time'   => new sfValidatorTime(),
      'end_time'     => new sfValidatorTime(),
      'price'        => new sfValidatorNumber(),
      'date'         => new sfValidatorDate(),
    ));

    $this->widgetSchema->setNameFormat('event[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Event';
  }

}
