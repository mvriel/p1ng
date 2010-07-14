<?php

/**
 * P1ngWorkflow form.
 *
 * @package    p1ng
 * @subpackage form
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class P1ngWorkflowForm extends BaseP1ngWorkflowForm
{
  public function configure()
  {
    unset($this['created_at']);
    unset($this['updated_at']);
    $this->getWidgetSchema()->setLabel('p1ng_project_id', 'Project');
    $this->getWidgetSchema()->setLabel('p1ng_issue_status_id', 'Select the initial status');
  }
}
