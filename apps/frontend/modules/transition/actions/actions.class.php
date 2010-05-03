<?php

/**
 * transition actions.
 *
 * @package    p1ng
 * @subpackage transition
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class transitionActions extends sfActions
{
  public function executeNew(sfWebRequest $request)
  {
    $p1ng_workflow_id = $request->getParameter('p1ng_workflow_id');
    $from_id = $request->getParameter('from_id');
    $this->forward404Unless($p1ng_workflow_id && $from_id);

    $this->form = new P1ngIssueStatusTransitionForm(null, array(
      'p1ng_workflow_id' => $p1ng_workflow_id,
      'from_id' => $from_id
    ));
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = new P1ngIssueStatusTransitionForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->form = new P1ngIssueStatusTransitionForm($this->getRoute()->getObject());
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->form = new P1ngIssueStatusTransitionForm($this->getRoute()->getObject());

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    $p1ng_issue_status_transition = $this->getRoute()->getObject();

    try
    {
      $p1ng_issue_status_transition->delete();
    }
    catch(Exception $e)
    {
      $this->getUser()->setFlash('error', $e->getMessage());
    }

    $this->redirect('workflow/show?id='.$p1ng_issue_status_transition->getP1ngWorkflowId());
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $p1ng_issue_status_transition = $form->save();

      $this->redirect('workflow/show?id='.$p1ng_issue_status_transition->getP1ngWorkflowId());
    }
  }
}
