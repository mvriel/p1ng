<?php

/**
 * P1ngIssueCustomFieldDefinition filter form base class.
 *
 * @package    p1ng
 * @subpackage filter
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseP1ngIssueCustomFieldDefinitionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'             => new sfWidgetFormFilterInput(),
      'label'            => new sfWidgetFormFilterInput(),
      'description'      => new sfWidgetFormFilterInput(),
      'field_type'       => new sfWidgetFormFilterInput(),
      'widget'           => new sfWidgetFormChoice(array('choices' => array('' => '', 'input_text' => 'input_text', 'textarea' => 'textarea', 'number' => 'number', 'enum' => 'enum', 'markdown' => 'markdown'))),
      'validator'        => new sfWidgetFormChoice(array('choices' => array('' => '', 'string' => 'string'))),
      'field_options'    => new sfWidgetFormFilterInput(),
      'field_attributes' => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'name'             => new sfValidatorPass(array('required' => false)),
      'label'            => new sfValidatorPass(array('required' => false)),
      'description'      => new sfValidatorPass(array('required' => false)),
      'field_type'       => new sfValidatorPass(array('required' => false)),
      'widget'           => new sfValidatorChoice(array('required' => false, 'choices' => array('input_text' => 'input_text', 'textarea' => 'textarea', 'number' => 'number', 'enum' => 'enum', 'markdown' => 'markdown'))),
      'validator'        => new sfValidatorChoice(array('required' => false, 'choices' => array('string' => 'string'))),
      'field_options'    => new sfValidatorPass(array('required' => false)),
      'field_attributes' => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'deleted_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('p1ng_issue_custom_field_definition_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'P1ngIssueCustomFieldDefinition';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'name'             => 'Text',
      'label'            => 'Text',
      'description'      => 'Text',
      'field_type'       => 'Text',
      'widget'           => 'Enum',
      'validator'        => 'Enum',
      'field_options'    => 'Text',
      'field_attributes' => 'Text',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
      'deleted_at'       => 'Date',
    );
  }
}
