<?php

/**
 * P1ngIssue form.
 *
 * @package    p1ng
 * @subpackage form
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class P1ngIssueForm extends BaseP1ngIssueForm
{
  public function configure()
  {
    $this->getWidgetSchema()->setLabel('p1ng_project_id', 'Project');

    unset($this['created_at']);
    unset($this['updated_at']);

    $this->embedRelation('custom');
  }

  protected function doBind(array $values)
  {
    if ($this->isNew())
    {
      $workflow = Doctrine::getTable('P1ngWorkflow')->findActiveByP1ngProjectId($values['p1ng_project_id']);
      if (!$workflow)
      {
        throw new Exception('Unable to determine the active workflow');
      }

      $values['p1ng_issue_status_id'] = $workflow->getP1ngIssueStatusId();
    }
    else
    {
      $values['p1ng_issue_status_id'] = $this->getObject()->getP1ngIssueStatusId();
    }

    parent::doBind($values);
  }
}
