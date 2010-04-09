<?php

/**
 * P1ngIssueCustomField form.
 *
 * @package    p1ng
 * @subpackage form
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class P1ngIssueCustomFieldForm extends BaseP1ngIssueCustomFieldForm
{
  public function configure()
  {
  	$this->getWidget('created_at')->setDefault(time());
  	$this->getValidator('created_at')->setOption('required', false);
  	$this->getWidget('updated_at')->setDefault(time());
  	$this->getValidator('updated_at')->setOption('required', false);
  }
}
