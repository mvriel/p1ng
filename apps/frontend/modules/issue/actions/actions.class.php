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

  public function executeNew(sfWebRequest $request)
  {
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

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $p1ng_issue = $form->save();

      $this->redirect('issue/show?id='.$p1ng_issue->getId());
    }
  }
}
