<?php

/**
 * P1ngWorkflow form base class.
 *
 * @method P1ngWorkflow getObject() Returns the current form's model object
 *
 * @package    p1ng
 * @subpackage form
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseP1ngWorkflowForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'p1ng_project_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('P1ngProject'), 'add_empty' => false)),
      'p1ng_issue_status_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('P1ngIssueStatus'), 'add_empty' => false)),
      'name'                 => new sfWidgetFormTextarea(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
      'deleted_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'p1ng_project_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('P1ngProject'))),
      'p1ng_issue_status_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('P1ngIssueStatus'))),
      'name'                 => new sfValidatorString(),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
      'deleted_at'           => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('p1ng_workflow[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'P1ngWorkflow';
  }

}
