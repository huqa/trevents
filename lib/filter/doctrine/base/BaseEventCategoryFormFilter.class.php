<?php

/**
 * EventCategory filter form base class.
 *
 * @package    trevents
 * @subpackage filter
 * @author     Ville Riikonen § huqa
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEventCategoryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('event_category_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EventCategory';
  }

  public function getFields()
  {
    return array(
      'event_id'    => 'Number',
      'category_id' => 'Number',
    );
  }
}
