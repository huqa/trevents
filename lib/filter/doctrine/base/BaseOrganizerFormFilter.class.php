<?php

/**
 * Organizer filter form base class.
 *
 * @package    trevents
 * @subpackage filter
 * @author     Ville Riikonen § huqa
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOrganizerFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'sf_guard_id' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'name'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'colour_code' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'sf_guard_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'name'        => new sfValidatorPass(array('required' => false)),
      'colour_code' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('organizer_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Organizer';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'sf_guard_id' => 'Number',
      'name'        => 'Text',
      'colour_code' => 'Text',
    );
  }
}
