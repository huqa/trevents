<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Organizer', 'doctrine');

/**
 * BaseOrganizer
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $sf_guard_id
 * @property string $name
 * @property string $colour_code
 * @property Doctrine_Collection $Event
 * 
 * @method integer             getId()          Returns the current record's "id" value
 * @method integer             getSfGuardId()   Returns the current record's "sf_guard_id" value
 * @method string              getName()        Returns the current record's "name" value
 * @method string              getColourCode()  Returns the current record's "colour_code" value
 * @method Doctrine_Collection getEvent()       Returns the current record's "Event" collection
 * @method Organizer           setId()          Sets the current record's "id" value
 * @method Organizer           setSfGuardId()   Sets the current record's "sf_guard_id" value
 * @method Organizer           setName()        Sets the current record's "name" value
 * @method Organizer           setColourCode()  Sets the current record's "colour_code" value
 * @method Organizer           setEvent()       Sets the current record's "Event" collection
 * 
 * @package    trevents
 * @subpackage model
 * @author     Ville Riikonen § huqa
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseOrganizer extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('organizer');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('sf_guard_id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('name', 'string', 80, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 80,
             ));
        $this->hasColumn('colour_code', 'string', 6, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 6,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Event', array(
             'local' => 'id',
             'foreign' => 'organizer_id'));
    }
}