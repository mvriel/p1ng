<?php

/**
 * P1ngIssueCustomRow form.
 *
 * @package    p1ng
 * @subpackage form
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class P1ngIssueCustomRowForm extends BaseP1ngIssueCustomRowForm
{
  public function configure()
  {
  	unset($this['p1ng_issue_id']);
	
  	foreach($this->getObject()->getCustomFields() as $field)
	{
		$widget_class = $field->getWidgetClassName();
		$validator_class = $field->getValidatorClassName();
		$widget = new $widget_class($field->getWidgetOptions(), $field->getWidgetAttributes());
		$validator = new $validator_class();
		
		$widget->setLabel($field->getWidgetLabel());
		$widget->setDefault($field->getDefaultValue());
		
		if ($widget instanceof sfWidgetFormSelect)
		{
			$widget->setOption('choices', explode(',', $field->getFieldValues()));
			$validator->setOption('choices', explode(',', $field->getFieldValues()));
		}
		
		$this->setWidget($field->getFieldName(), $widget);
		$this->setValidator($field->getFieldName(), $validator);
	}
  }
}
