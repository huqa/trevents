<?php

/**
 * Event filter form base class.
 *
 * @package    trevents
 * @subpackage filter
 * @author     Ville Riikonen § huqa
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEventFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'organizer_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Organizer'), 'add_empty' => true)),
      'name'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'venue'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'event_url'    => new sfWidgetFormFilterInput(),
      'start_time'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'end_time'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'price'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'date'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'organizer_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Organizer'), 'column' => 'id')),
      'name'         => new sfValidatorPass(array('required' => false)),
      'description'  => new sfValidatorPass(array('required' => false)),
      'venue'        => new sfValidatorPass(array('required' => false)),
      'event_url'    => new sfValidatorPass(array('required' => false)),
      'start_time'   => new sfValidatorPass(array('required' => false)),
      'end_time'     => new sfValidatorPass(array('required' => false)),
      'price'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'date'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('event_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Event';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'organizer_id' => 'ForeignKey',
      'name'         => 'Text',
      'description'  => 'Text',
      'venue'        => 'Text',
      'event_url'    => 'Text',
      'start_time'   => 'Text',
      'end_time'     => 'Text',
      'price'        => 'Number',
      'date'         => 'Date',
    );
  }
}
