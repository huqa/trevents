<?php

/**
 * errors actions.
 *
 * @package    trevents
 * @subpackage errors
 * @author     Ville Riikonen § huqa
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class errorsActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request) {
    $this->forward('events', 'index');
  }
  
  public function executeError404(sfWebRequest $request) { }
  
  public function executeError403(sfWebRequest $request) { }
}
