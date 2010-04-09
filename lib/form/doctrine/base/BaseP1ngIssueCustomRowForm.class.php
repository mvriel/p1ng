<?php

/**
 * P1ngIssueCustomRow form base class.
 *
 * @method P1ngIssueCustomRow getObject() Returns the current form's model object
 *
 * @package    p1ng
 * @subpackage form
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseP1ngIssueCustomRowForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'p1ng_issue_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'p1ng_issue_id' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'p1ng_issue_id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('p1ng_issue_custom_row[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'P1ngIssueCustomRow';
  }

}
