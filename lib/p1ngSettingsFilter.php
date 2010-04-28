<?php

/*
 * This file is part of the p1ng application.
 * (c) Mike van Riel <mike.vanriel@naenius.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Adds the database settings to the sfConfig registry.
 *
 * This filter should be added to the application filters.yml file **above**
 * the rendering filter:
 *
 *    p1ng_settings:
 *      class: p1ngSettingsFilter
 *
 *    rendering: ~
 *
 * @package    p1ng
 * @subpackage filter
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 */
class p1ngSettingsFilter extends sfFilter
{
  /**
   * Executes the filter chain.
   *
   * @param sfFilterChain $filterChain
   */
  public function execute($filterChain)
  {
    if ($this->isFirstCall())
    {
      $q = Doctrine::getTable('P1ngSettings')->
        createQuery('s')->
        where('s.deleted_at IS NULL');
      $result = $q->fetchArray();

      foreach($result as $item)
      {
        sfConfig::set('p1ng_'.sfInflector::underscore($item['namespace'].'_'.$item['name']), $item['value']);
      }
    }

    $filterChain->execute();
  }
}
