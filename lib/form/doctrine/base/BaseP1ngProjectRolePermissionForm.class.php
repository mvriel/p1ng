<?php

/**
 * P1ngProjectRolePermission form base class.
 *
 * @method P1ngProjectRolePermission getObject() Returns the current form's model object
 *
 * @package    p1ng
 * @subpackage form
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseP1ngProjectRolePermissionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'p1ng_project_role_id'   => new sfWidgetFormInputHidden(),
      'sf_guard_permission_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardPermission'), 'add_empty' => false)),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'p1ng_project_role_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'p1ng_project_role_id', 'required' => false)),
      'sf_guard_permission_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardPermission'))),
      'created_at'             => new sfValidatorDateTime(),
      'updated_at'             => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('p1ng_project_role_permission[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'P1ngProjectRolePermission';
  }

}
