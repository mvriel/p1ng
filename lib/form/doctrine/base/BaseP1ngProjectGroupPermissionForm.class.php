<?php

/**
 * P1ngProjectGroupPermission form base class.
 *
 * @method P1ngProjectGroupPermission getObject() Returns the current form's model object
 *
 * @package    p1ng
 * @subpackage form
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseP1ngProjectGroupPermissionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'sf_guard_group_id'      => new sfWidgetFormInputHidden(),
      'p1ng_project_id'        => new sfWidgetFormInputHidden(),
      'sf_guard_permission_id' => new sfWidgetFormInputHidden(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'sf_guard_group_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'sf_guard_group_id', 'required' => false)),
      'p1ng_project_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'p1ng_project_id', 'required' => false)),
      'sf_guard_permission_id' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'sf_guard_permission_id', 'required' => false)),
      'created_at'             => new sfValidatorDateTime(),
      'updated_at'             => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('p1ng_project_group_permission[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'P1ngProjectGroupPermission';
  }

}
