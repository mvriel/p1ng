<?php

/**
 * log actions.
 *
 * @package    p1ng
 * @subpackage log
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class logActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->p1ng_issue_logs = $this->getRoute()->getObjects();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->p1ng_issue_log = $this->getRoute()->getObject();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new P1ngIssueLogForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = new P1ngIssueLogForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->form = new P1ngIssueLogForm($this->getRoute()->getObject());
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->form = new P1ngIssueLogForm($this->getRoute()->getObject());

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->getRoute()->getObject()->delete();

    $this->redirect('log/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $p1ng_issue_log = $form->save();

      $this->redirect('issue/show?id='.$p1ng_issue_log->getP1ngIssueId());
    }
  }
}
