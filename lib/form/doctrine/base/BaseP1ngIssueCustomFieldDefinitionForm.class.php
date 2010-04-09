<?php

/**
 * P1ngIssueCustomFieldDefinition form base class.
 *
 * @method P1ngIssueCustomFieldDefinition getObject() Returns the current form's model object
 *
 * @package    p1ng
 * @subpackage form
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseP1ngIssueCustomFieldDefinitionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'name'             => new sfWidgetFormTextarea(),
      'label'            => new sfWidgetFormTextarea(),
      'description'      => new sfWidgetFormTextarea(),
      'field_type'       => new sfWidgetFormTextarea(),
      'widget'           => new sfWidgetFormChoice(array('choices' => array('input_text' => 'input_text', 'textarea' => 'textarea', 'number' => 'number', 'enum' => 'enum'))),
      'validator'        => new sfWidgetFormChoice(array('choices' => array('string' => 'string'))),
      'field_options'    => new sfWidgetFormInputText(),
      'field_attributes' => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
      'deleted_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'name'             => new sfValidatorString(array('required' => false)),
      'label'            => new sfValidatorString(array('required' => false)),
      'description'      => new sfValidatorString(array('required' => false)),
      'field_type'       => new sfValidatorString(array('required' => false)),
      'widget'           => new sfValidatorChoice(array('choices' => array('input_text' => 'input_text', 'textarea' => 'textarea', 'number' => 'number', 'enum' => 'enum'), 'required' => false)),
      'validator'        => new sfValidatorChoice(array('choices' => array('string' => 'string'), 'required' => false)),
      'field_options'    => new sfValidatorPass(array('required' => false)),
      'field_attributes' => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
      'deleted_at'       => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('p1ng_issue_custom_field_definition[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'P1ngIssueCustomFieldDefinition';
  }

}
