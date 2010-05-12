<?php

/**
 * P1ngProject form.
 *
 * @package    p1ng
 * @subpackage form
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class P1ngProjectForm extends BaseP1ngProjectForm
{
  public function configure()
  {
    unset($this['created_at']);
    unset($this['updated_at']);
    unset($this['deleted_at']);
  }
}
