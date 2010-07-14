<?php

/**
 * P1ngProjectUserPermission form.
 *
 * @package    p1ng
 * @subpackage form
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class P1ngProjectUserPermissionForm extends BaseP1ngProjectUserPermissionForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'p1ng_project_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('P1ngProject'), 'add_empty' => false)),
      'sf_guard_user_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => false)),
      'sf_guard_permission_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardPermission'), 'add_empty' => false))
    ));
  }
}
