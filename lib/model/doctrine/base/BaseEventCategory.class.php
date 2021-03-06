<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('EventCategory', 'doctrine');

/**
 * BaseEventCategory
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $event_id
 * @property integer $category_id
 * @property Event $Event
 * @property Category $Category
 * 
 * @method integer       getEventId()     Returns the current record's "event_id" value
 * @method integer       getCategoryId()  Returns the current record's "category_id" value
 * @method Event         getEvent()       Returns the current record's "Event" value
 * @method Category      getCategory()    Returns the current record's "Category" value
 * @method EventCategory setEventId()     Sets the current record's "event_id" value
 * @method EventCategory setCategoryId()  Sets the current record's "category_id" value
 * @method EventCategory setEvent()       Sets the current record's "Event" value
 * @method EventCategory setCategory()    Sets the current record's "Category" value
 * 
 * @package    trevents
 * @subpackage model
 * @author     Ville Riikonen § huqa
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEventCategory extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('event_category');
        $this->hasColumn('event_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('category_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Event', array(
             'local' => 'event_id',
             'foreign' => 'id'));

        $this->hasOne('Category', array(
             'local' => 'category_id',
             'foreign' => 'id'));
    }
}