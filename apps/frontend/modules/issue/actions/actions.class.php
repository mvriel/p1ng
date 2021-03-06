<?php

/**
 * issue actions.
 *
 * @package    p1ng
 * @subpackage issue
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class issueActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->p1ng_issues = $this->getRoute()->getObjects();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->p1ng_issue = $this->getRoute()->getObject();
    $this->log_form = new P1ngIssueLogForm();
    $this->log_form->setDefault('p1ng_issue_id', $this->p1ng_issue->getId());
    $this->log_form->getWidget('p1ng_issue_id')->setHidden(true);
    $this->log_form->getWidget('p1ng_issue_id')->setAttribute('style', 'display: none');
  }

  public function executeTransition(sfWebRequest $request)
  {
    $this->p1ng_issue = $this->getRoute()->getObject();
    $transition = Doctrine::getTable('P1ngIssueStatusTransition')->find($request->getParameter('transition_id'));
    $this->forward404Unless($transition);

    $this->p1ng_issue->setP1ngIssueStatusId($transition->getToId());
    $this->p1ng_issue->save();

    $this->redirect('issue/show?id='.$this->p1ng_issue->getId());
  }

  public function executeNew(sfWebRequest $request)
  {
    $workflow = Doctrine::getTable('P1ngWorkflow')->findActiveByP1ngProjectId($this->getUser()->getProjectId());
    if (!$workflow)
    {
      $this->getUser()->setFlash('error', 'There is no active workflow for this project, please contact your system administrator');
      $this->redirect('issue/index');
    }

    $this->form = new P1ngIssueForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = new P1ngIssueForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->form = new P1ngIssueForm($this->getRoute()->getObject());
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->form = new P1ngIssueForm($this->getRoute()->getObject());

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->getRoute()->getObject()->delete();

    $this->redirect('issue/index');
  }

  public function executeSearch(sfWebRequest $request)
  {
    $this->forwardUnless($query = $request->getParameter('query'), 'issue', 'index');

    $this->p1ng_issues = Doctrine_Core::getTable('P1ngIssue') ->getForLuceneQuery($query);
    $this->setTemplate('index');
  }

  public function executeReport(sfWebRequest $request)
  {

  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $parameters = $request->getParameter($form->getName());
    $parameters['p1ng_project_id'] = $this->getUser()->getProjectId();
    $form->bind($parameters, $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $p1ng_issue = $form->save();

      $this->redirect('issue/show?id='.$p1ng_issue->getId());
    }
  }
}
