<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Event', 'doctrine');

/**
 * BaseEvent
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $organizer_id
 * @property string $name
 * @property string $description
 * @property string $venue
 * @property string $event_url
 * @property time $start_time
 * @property time $end_time
 * @property decimal $price
 * @property date $date
 * @property Organizer $Organizer
 * @property Doctrine_Collection $EventCategory
 * 
 * @method integer             getId()            Returns the current record's "id" value
 * @method integer             getOrganizerId()   Returns the current record's "organizer_id" value
 * @method string              getName()          Returns the current record's "name" value
 * @method string              getDescription()   Returns the current record's "description" value
 * @method string              getVenue()         Returns the current record's "venue" value
 * @method string              getEventUrl()      Returns the current record's "event_url" value
 * @method time                getStartTime()     Returns the current record's "start_time" value
 * @method time                getEndTime()       Returns the current record's "end_time" value
 * @method decimal             getPrice()         Returns the current record's "price" value
 * @method date                getDate()          Returns the current record's "date" value
 * @method Organizer           getOrganizer()     Returns the current record's "Organizer" value
 * @method Doctrine_Collection getEventCategory() Returns the current record's "EventCategory" collection
 * @method Event               setId()            Sets the current record's "id" value
 * @method Event               setOrganizerId()   Sets the current record's "organizer_id" value
 * @method Event               setName()          Sets the current record's "name" value
 * @method Event               setDescription()   Sets the current record's "description" value
 * @method Event               setVenue()         Sets the current record's "venue" value
 * @method Event               setEventUrl()      Sets the current record's "event_url" value
 * @method Event               setStartTime()     Sets the current record's "start_time" value
 * @method Event               setEndTime()       Sets the current record's "end_time" value
 * @method Event               setPrice()         Sets the current record's "price" value
 * @method Event               setDate()          Sets the current record's "date" value
 * @method Event               setOrganizer()     Sets the current record's "Organizer" value
 * @method Event               setEventCategory() Sets the current record's "EventCategory" collection
 * 
 * @package    trevents
 * @subpackage model
 * @author     Ville Riikonen § huqa
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEvent extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('event');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('organizer_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
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
        $this->hasColumn('description', 'string', 240, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 240,
             ));
        $this->hasColumn('venue', 'string', 80, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 80,
             ));
        $this->hasColumn('event_url', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('start_time', 'time', 25, array(
             'type' => 'time',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('end_time', 'time', 25, array(
             'type' => 'time',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('price', 'decimal', 10, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 10,
             ));
        $this->hasColumn('date', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Organizer', array(
             'local' => 'organizer_id',
             'foreign' => 'id'));

        $this->hasMany('EventCategory', array(
             'local' => 'id',
             'foreign' => 'event_id'));
    }
}