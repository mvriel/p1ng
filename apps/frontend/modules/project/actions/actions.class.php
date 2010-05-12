<?php

/**
 * project actions.
 *
 * @package    p1ng
 * @subpackage project
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class projectActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    if ($request->getParameter('select'))
    {
      try
      {
        $this->getUser()->setProjectId($request->getParameter('select'));
        $this->redirect('@homepage');
      }
      catch(StopException $e)
      {
        throw $e;
      } catch(Exception $e)
      {
        $this->getUser()->setFlash('error', $e->getMessage());
      }
    }

    $this->p1ng_projects = $this->getRoute()->getObjects();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->p1ng_project = $this->getRoute()->getObject();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new P1ngProjectForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = new P1ngProjectForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->form = new P1ngProjectForm($this->getRoute()->getObject());
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->form = new P1ngProjectForm($this->getRoute()->getObject());

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->getRoute()->getObject()->delete();

    $this->redirect('project/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if (!$form->isValid())
    {
      return;
    }

    $p1ng_project = $form->save();
    $this->getUser()->setProjectId($p1ng_project->getId());
    $this->redirect('@homepage');
  }
}
