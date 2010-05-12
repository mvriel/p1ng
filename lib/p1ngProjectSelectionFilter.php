<?php

/*
 * This file is part of the p1ng application.
 * (c) Mike van Riel <mike.vanriel@naenius.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Checks whether a project is selected and if not, redirect to the project selection screen
 *
 * This filter should be added to the application filters.yml file **above**
 * the rendering filter:
 *
 *    p1ng_project_selection:
 *      class: p1ngProjectSelectionFilter
 *
 *    rendering: ~
 *
 * @package    p1ng
 * @subpackage filter
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 */
class p1ngProjectSelectionFilter extends sfFilter
{
  /**
   * Executes the filter chain.
   *
   * @param sfFilterChain $filterChain
   */
  public function execute($filterChain)
  {
    if (((sfConfig::get('app_project_select_module') == $this->context->getModuleName()) && (sfConfig::get('app_project_select_action') == $this->context->getActionName())) ||
      ((sfConfig::get('app_project_select_module') == $this->context->getModuleName()) && ('new' == $this->context->getActionName())) ||
      ((sfConfig::get('app_project_select_module') == $this->context->getModuleName()) && ('create' == $this->context->getActionName())) ||
      ((!sfConfig::get('app_project_select_module')) && (!sfConfig::get('app_project_select_action'))) ||
      (!$this->context->getUser()->isAuthenticated()))
    {
      $filterChain->execute();

      return;
    }

    if (!$this->context->getUser()->getProject())
    {
      $this->context->getController()->redirect(sfConfig::get('app_project_select_module'), sfConfig::get('app_project_select_action'));

      throw new sfStopException();
    }

    $filterChain->execute();
  }
}
