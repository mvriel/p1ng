<?php

/**
 * P1ngIssueCustomField filter form base class.
 *
 * @package    p1ng
 * @subpackage filter
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseP1ngIssueCustomFieldFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'p1ng_issue_custom_field_definition_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('definition'), 'add_empty' => true)),
      'field_name'                            => new sfWidgetFormFilterInput(),
      'label'                                 => new sfWidgetFormFilterInput(),
      'field_values'                          => new sfWidgetFormFilterInput(),
      'default_value'                         => new sfWidgetFormFilterInput(),
      'required'                              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'related_to_model'                      => new sfWidgetFormFilterInput(),
      'related_to_field'                      => new sfWidgetFormFilterInput(),
      'field_options'                         => new sfWidgetFormFilterInput(),
      'field_attributes'                      => new sfWidgetFormFilterInput(),
      'created_at'                            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at'                            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'created_by'                            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('created_by'), 'add_empty' => true)),
      'updated_by'                            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('updated_by'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'p1ng_issue_custom_field_definition_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('definition'), 'column' => 'id')),
      'field_name'                            => new sfValidatorPass(array('required' => false)),
      'label'                                 => new sfValidatorPass(array('required' => false)),
      'field_values'                          => new sfValidatorPass(array('required' => false)),
      'default_value'                         => new sfValidatorPass(array('required' => false)),
      'required'                              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'related_to_model'                      => new sfValidatorPass(array('required' => false)),
      'related_to_field'                      => new sfValidatorPass(array('required' => false)),
      'field_options'                         => new sfValidatorPass(array('required' => false)),
      'field_attributes'                      => new sfValidatorPass(array('required' => false)),
      'created_at'                            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'deleted_at'                            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'                            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('created_by'), 'column' => 'id')),
      'updated_by'                            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('updated_by'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('p1ng_issue_custom_field_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'P1ngIssueCustomField';
  }

  public function getFields()
  {
    return array(
      'id'                                    => 'Number',
      'p1ng_issue_custom_field_definition_id' => 'ForeignKey',
      'field_name'                            => 'Text',
      'label'                                 => 'Text',
      'field_values'                          => 'Text',
      'default_value'                         => 'Text',
      'required'                              => 'Boolean',
      'related_to_model'                      => 'Text',
      'related_to_field'                      => 'Text',
      'field_options'                         => 'Text',
      'field_attributes'                      => 'Text',
      'created_at'                            => 'Date',
      'updated_at'                            => 'Date',
      'deleted_at'                            => 'Date',
      'created_by'                            => 'ForeignKey',
      'updated_by'                            => 'ForeignKey',
    );
  }
}
