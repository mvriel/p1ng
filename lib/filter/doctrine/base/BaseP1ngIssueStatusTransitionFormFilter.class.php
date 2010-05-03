<?php

/**
 * P1ngIssueStatusTransition filter form base class.
 *
 * @package    p1ng
 * @subpackage filter
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseP1ngIssueStatusTransitionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'p1ng_workflow_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('P1ngWorkflow'), 'add_empty' => true)),
      'from_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('From'), 'add_empty' => true)),
      'to_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('To'), 'add_empty' => true)),
      'expression'       => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'             => new sfValidatorPass(array('required' => false)),
      'p1ng_workflow_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('P1ngWorkflow'), 'column' => 'id')),
      'from_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('From'), 'column' => 'id')),
      'to_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('To'), 'column' => 'id')),
      'expression'       => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('p1ng_issue_status_transition_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'P1ngIssueStatusTransition';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'name'             => 'Text',
      'p1ng_workflow_id' => 'ForeignKey',
      'from_id'          => 'ForeignKey',
      'to_id'            => 'ForeignKey',
      'expression'       => 'Text',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}
