<?php

/**
 * CategoryTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class CategoryTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object CategoryTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Category');
    }
    
    public function getCategories() {
    	return self::getInstance()->findAll();
    }
    
    public static function getCategoryCount($event_id) {
    	return self::getInstance()
    	->createQuery('cc')
    	->innerJoin('cc.EventCategory AS ec')
    	->innerJoin('ec.Event AS ev')
    	->where('ev.id = '. $event_id)
    	->execute()
    	->count();
    }
    
}