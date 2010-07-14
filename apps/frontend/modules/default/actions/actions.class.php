<?php

/**
 * default actions.
 *
 * @package    p1ng
 * @subpackage default
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class defaultActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeHome(sfWebRequest $request)
  {
    $this->redirect('project/show?id='.$this->getUser()->getProjectId());
  }

  public function executeAdmin()
  {

  }

}
