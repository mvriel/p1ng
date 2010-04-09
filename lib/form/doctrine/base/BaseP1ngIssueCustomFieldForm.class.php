<?php

/**
 * P1ngIssueCustomField form base class.
 *
 * @method P1ngIssueCustomField getObject() Returns the current form's model object
 *
 * @package    p1ng
 * @subpackage form
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseP1ngIssueCustomFieldForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                                    => new sfWidgetFormInputHidden(),
      'p1ng_issue_custom_field_definition_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('definition'), 'add_empty' => true)),
      'field_name'                            => new sfWidgetFormInputText(),
      'label'                                 => new sfWidgetFormTextarea(),
      'field_values'                          => new sfWidgetFormTextarea(),
      'default_value'                         => new sfWidgetFormTextarea(),
      'required'                              => new sfWidgetFormInputCheckbox(),
      'related_to_model'                      => new sfWidgetFormTextarea(),
      'related_to_field'                      => new sfWidgetFormTextarea(),
      'field_options'                         => new sfWidgetFormInputText(),
      'field_attributes'                      => new sfWidgetFormInputText(),
      'created_at'                            => new sfWidgetFormDateTime(),
      'updated_at'                            => new sfWidgetFormDateTime(),
      'deleted_at'                            => new sfWidgetFormDateTime(),
      'created_by'                            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('created_by'), 'add_empty' => true)),
      'updated_by'                            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('updated_by'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                                    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'p1ng_issue_custom_field_definition_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('definition'), 'required' => false)),
      'field_name'                            => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'label'                                 => new sfValidatorString(array('required' => false)),
      'field_values'                          => new sfValidatorString(array('required' => false)),
      'default_value'                         => new sfValidatorString(array('required' => false)),
      'required'                              => new sfValidatorBoolean(array('required' => false)),
      'related_to_model'                      => new sfValidatorString(array('required' => false)),
      'related_to_field'                      => new sfValidatorString(array('required' => false)),
      'field_options'                         => new sfValidatorPass(array('required' => false)),
      'field_attributes'                      => new sfValidatorPass(array('required' => false)),
      'created_at'                            => new sfValidatorDateTime(),
      'updated_at'                            => new sfValidatorDateTime(),
      'deleted_at'                            => new sfValidatorDateTime(array('required' => false)),
      'created_by'                            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('created_by'), 'required' => false)),
      'updated_by'                            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('updated_by'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('p1ng_issue_custom_field[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'P1ngIssueCustomField';
  }

}
