<?php

/**
 * Category form.
 *
 * @package    trevents
 * @subpackage form
 * @author     Ville Riikonen § huqa
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CategoryForm extends BaseCategoryForm
{
  public function configure()
  {
  	unset($this['id']);
  }
}
