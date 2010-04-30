<?php

/**
 * P1ngIssueStatusTransition form base class.
 *
 * @method P1ngIssueStatusTransition getObject() Returns the current form's model object
 *
 * @package    p1ng
 * @subpackage form
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseP1ngIssueStatusTransitionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'name'             => new sfWidgetFormTextarea(),
      'p1ng_workflow_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('P1ngWorkflow'), 'add_empty' => false)),
      'from_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('From'), 'add_empty' => false)),
      'to_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('To'), 'add_empty' => false)),
      'expression'       => new sfWidgetFormTextarea(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
      'deleted_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'name'             => new sfValidatorString(),
      'p1ng_workflow_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('P1ngWorkflow'))),
      'from_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('From'))),
      'to_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('To'))),
      'expression'       => new sfValidatorString(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
      'deleted_at'       => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('p1ng_issue_status_transition[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'P1ngIssueStatusTransition';
  }

}
