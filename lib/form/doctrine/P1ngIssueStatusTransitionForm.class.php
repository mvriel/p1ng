<?php

/**
 * P1ngIssueStatusTransition form.
 *
 * @package    p1ng
 * @subpackage form
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class P1ngIssueStatusTransitionForm extends BaseP1ngIssueStatusTransitionForm
{
  public function configure()
  {
    if ($this->getOption('p1ng_workflow_id'))
    {
      $this->setDefault('p1ng_workflow_id', $this->getOption('p1ng_workflow_id'));
    }
    if ($this->getOption('from_id'))
    {
      $this->setDefault('from_id', $this->getOption('from_id'));
    }
    $this->getWidget('p1ng_workflow_id')->setHidden('true');
    $this->getWidget('p1ng_workflow_id')->setAttribute('style', 'display: none');
    $this->getWidget('from_id')->setHidden('true');
    $this->getWidget('from_id')->setAttribute('style', 'display: none');

    unset($this['created_at']);
    unset($this['updated_at']);
  }
}
