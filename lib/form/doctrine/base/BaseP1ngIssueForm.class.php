<?php

/**
 * P1ngIssue form base class.
 *
 * @method P1ngIssue getObject() Returns the current form's model object
 *
 * @package    p1ng
 * @subpackage form
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseP1ngIssueForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'p1ng_project_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('P1ngProject'), 'add_empty' => false)),
      'subject'              => new sfWidgetFormInputText(),
      'p1ng_issue_status_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('P1ngIssueStatus'), 'add_empty' => false)),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
      'deleted_at'           => new sfWidgetFormDateTime(),
      'created_by'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('created_by'), 'add_empty' => true)),
      'updated_by'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('updated_by'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'p1ng_project_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('P1ngProject'))),
      'subject'              => new sfValidatorString(array('max_length' => 255)),
      'p1ng_issue_status_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('P1ngIssueStatus'))),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
      'deleted_at'           => new sfValidatorDateTime(array('required' => false)),
      'created_by'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('created_by'), 'required' => false)),
      'updated_by'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('updated_by'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('p1ng_issue[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'P1ngIssue';
  }

}
