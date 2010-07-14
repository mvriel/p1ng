<?php

/**
 * project_permission actions.
 *
 * @package    p1ng
 * @subpackage project_permission
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class project_permissionActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $query = Doctrine::getTable('P1ngProjectUserPermission')->createQuery('dctrn_find');
    if ($p1ng_project_id = $request->getParameter('p1ng_project_id'))
    {
      $query->addWhere('p1ng_project_id = ?', $p1ng_project_id);
    }
    if ($user_id = $request->getParameter('user_id'))
    {
      $query->addWhere('sf_guard_user_id = ?', $user_id);
    }

    $this->getRoute()->setListQuery($query);
    $this->p1ng_project_user_permissions = $this->getRoute()->getObjects();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new P1ngProjectUserPermissionForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = new P1ngProjectUserPermissionForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->form = new P1ngProjectUserPermissionForm($this->getRoute()->getObject());
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->form = new P1ngProjectUserPermissionForm($this->getRoute()->getObject());

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->getRoute()->getObject()->delete();

    $this->redirect('project_permission/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $p1ng_project_user_permission = $form->save();

      $this->redirect('project_permission/edit?sf_guard_user_id='.$p1ng_project_user_permission->getSfGuardUserId().'&p1ng_project_id='.$p1ng_project_user_permission->getP1ngProjectId().'&sf_guard_permission_id='.$p1ng_project_user_permission->getSfGuardPermissionId());
    }
  }
}
