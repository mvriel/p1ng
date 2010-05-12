<?php

/**
 * P1ngProjectRoleUser form base class.
 *
 * @method P1ngProjectRoleUser getObject() Returns the current form's model object
 *
 * @package    p1ng
 * @subpackage form
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseP1ngProjectRoleUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'p1ng_project_id'      => new sfWidgetFormInputHidden(),
      'p1ng_project_role_id' => new sfWidgetFormInputHidden(),
      'sf_guard_user_id'     => new sfWidgetFormInputHidden(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
      'deleted_at'           => new sfWidgetFormDateTime(),
      'created_by'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('created_by'), 'add_empty' => true)),
      'updated_by'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('updated_by'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'p1ng_project_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'p1ng_project_id', 'required' => false)),
      'p1ng_project_role_id' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'p1ng_project_role_id', 'required' => false)),
      'sf_guard_user_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'sf_guard_user_id', 'required' => false)),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
      'deleted_at'           => new sfValidatorDateTime(array('required' => false)),
      'created_by'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('created_by'), 'required' => false)),
      'updated_by'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('updated_by'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('p1ng_project_role_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'P1ngProjectRoleUser';
  }

}
