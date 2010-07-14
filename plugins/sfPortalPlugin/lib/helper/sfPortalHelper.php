<?php
/*
 * This file is part of the sfPortalHelperPlugin package.
 * (c) 2010-2010 Mike van Riel <mike.vanriel@naenius.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * The portal helper class provides an easy means to generate a AJAX ready portal for your website.
 *
 * To allow for easy operation this class provides a fluent interface.
 *
 * @example sfPortalHelper::getInstance()
 *            ->setColumns(2)
 *            ->addPortlet(0, 'News', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit')
 *            ->addPortlet(1, 'Shopping', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit')
 *            ->render();
 *
 * @package    sfPortalHelperPlugin
 * @subpackage helper
 * @author     Mike van Riel <mike.vanrie@naenius.com>
 */
class sfPortalHelper
{
  /**
   * Stores a list of columns and their portlets as an associative array.
   *
   * The format is:
   * - attributes
   * - portlets
   *   - title
   *   - contents
   *   - attributes
   *
   * @var array
   */
  protected $columns = array();

  /**
   * When capturing this property contains a reference to the contents field of the capturing portlet.
   *
   * @var null|string
   */
  protected $capture = null;

  /**
   * The name of the class used to determine a column
   *
   * @var string
   */
  protected $column_class = 'column';

  /**
   * Returns a new instance of this class.
   *
   * This is a convenience function for use in templates. It is by design that this method
   * does not facilitate a singleton as it may be possible to have multiple portals.
   *
   * @return sfPortalHelper
   */
  public static function getInstance(sfWebresponse $response = null, $column_class = 'column')
  {
    if ($response === null)
    {
      $response = sfContext::getInstance()->getResponse();
    }

    return new self($response, $column_class);
  }

  /**
   * Adds the javascript required for this portal to the header of the page.
   *
   * @param string $column_class
   * @param string $portlet_class
   *
   * @return void
   */
  public function __construct(sfWebresponse $response, $column_class = 'column')
  {
    $this->column_class = $column_class;
  }

  /**
   * Clears all columns and portlets.
   *
   * @return sfPortalHelper
   */
  public function clearColumns()
  {
    $this->columns = array();

    return $this;
  }

  /**
   * Initializes the given amount of columns.
   *
   * Before initialization all columns are cleared.
   *
   * @param integer $amount
   *
   * @return sfPortalHelper
   */
  public function setColumns($amount)
  {
    // clear columns
    $this->clearColumns();

    // add new columns
    for ($i = 0; $i < $amount; $i++)
    {
      $this->addColumn();
    }

    return $this;
  }

  /**
   * Adds a column to the list of columns.
   *
   * @param string $id         The id for this column [optional]
   * @param array  $attributes An array containing additional attributes. [optional]
   *
   * @return sfPortalHelper
   */
  public function addColumn($id = null, $attributes = array())
  {
    // since id is actually just an attribute we add it onto the attributes array
    if ($id !== null)
    {
      $attributes = array('id' => $id) + $attributes;
    }

    // adds the column with attributes
    $this->columns[] = array(
      'attributes' => $attributes,
      'portlets' => array()
    );

    return $this;
  }

  /**
   * Adds a portlet to a column.
   *
   * @param integer $column     The index of the column to add this onto
   * @param string  $title      The text to show in the handlebar
   * @param string  $contents   The contents of the portlet
   * @param string  $id         The id for this portlet [optional]
   * @param array   $attributes An array containing additional attributes. [optional]
   *
   * @return sfPortalHelper
   */
  public function addPortlet($column, $title, $contents, $id = null, $attributes = array())
  {
    if (!isset($this->columns[$column]))
    {
      throw new Exception('Tried to attach portlet "'.$title.'" but the column "'.$column.'" is not initialized');
    }

    // since id is actually just an attribute we add it onto the attributes array
    if ($id !== null)
    {
      $attributes = array('id' => $id) + $attributes;
    }

    // adds the portlet with a title, contents and attributes
    $this->columns[$column]['portlets'][] = array(
      'title'      => $title,
      'contents'   => $contents,
      'attributes' => $attributes
    );

    return $this;
  }

  /**
   * Starts capturing of a new portlet to a given column.
   *
   * if a capturing session is already ongoing then this method does not do anything.
   *
   * @param integer $column     The index of the column to add this onto
   * @param string  $title      The text to show in the handlebar
   * @param string  $id         The id for this portlet [optional]
   * @param array   $attributes An array containing additional attributes. [optional]
   *
   * @return void
   */
  public function startPortlet($column, $title, $id = null, $attributes = array())
  {
    if ($this->capture !== null)
    {
      return;
    }

    // add the portlet
    $this->addPortlet($column, $title, '', $id, $attributes);

    // start capturing of the new portlet's contents field
    $this->capture = &$this->columns[$column]['portlets'][count($this->columns[$column]['portlets'])-1]['contents'];
    ob_start();
  }

  /**
   * Ends capturing of a new portlet.
   *
   * If there is no capturing active then the function will return without doing anything.
   *
   * @return sfPortalHelper
   */
  public function endPortlet()
  {
    if ($this->capture === null)
    {
      return $this;
    }

    // add the contents
    $this->capture = ob_get_clean();

    // reset the capturing
    unset($this->capture);
    $this->capture = null;

    return $this;
  }

  /**
   * Converts an associative array to HTML formatted attributes.
   *
   * @param  array $attributes
   *
   * @return string
   */
  protected function convertAttributes($attributes)
  {
    $result = '';
    foreach($attributes as $key => $value)
    {
      $result .= $key.'="'.htmlentities($value, ENT_QUOTES).'" ';
    }

    return $result;
  }

  /**
   * Generates the HTML to display this portal.
   *
   * @return sfPortalHelper
   */
  public function render()
  {
    $column_class = $this->column_class;

    $js = <<<JAVASCRIPT
jQuery(function() {
  jQuery(".$column_class").sortable({
    connectWith: '.$column_class',
  });

  jQuery(".$column_class .portlet").addClass("ui-widget ui-widget-content ui-helper-clearfix ui-corner-all")
    .find(".header")
      .addClass("ui-widget-header ui-corner-all")
      .prepend('<span class="ui-icon ui-icon-triangle-1-n" style="cursor: pointer;"></span>')
      .end()
    .find(".content");

  jQuery(".$column_class .portlet .header .ui-icon").click(function() {
    jQuery(this).toggleClass("ui-icon-triangle-1-n").toggleClass("ui-icon-triangle-1-s");
    jQuery(this).parents(".portlet:first").find(".content").toggle();
  });

  jQuery(".$column_class").disableSelection();
});
JAVASCRIPT;

    // enclose javascript in XHTML compliant CDATA block
    $js = <<<CDATA
//<![CDATA[
$js
//]]>
CDATA;

    // output the required javascript
    echo content_tag('script', $js, array('type' => 'text/javascript'));

    foreach($this->columns as $column)
    {
      // collect class and attributes and convert them to HTML format
      $column['attributes']['class'] = (isset($column['attributes']['class']) ?
        $column['attributes']['class'].' ' : '').$column_class;
      $attributes = $this->convertAttributes($column['attributes']);

      // output the opening statement
      echo '<div '.$attributes.'>';

      // process portlets
      foreach($column['portlets'] as $key => $portlet)
      {
        // collect class and attributes
        $portlet['attributes']['class'] = (isset($portlet['attributes']['class']) ?
          $portlet['attributes']['class'].' ' : '').'portlet';
        $attributes = $this->convertAttributes($portlet['attributes']);

        echo '  <div '.$attributes.'>';
        echo '    <div class="header">'.$portlet['title'].'</div>';
        echo '    <div class="content">'.$portlet['contents'].'</div>';
        echo '  </div>';
      }

      // output the closing statement
      echo '</div>';
    }

    return $this;
  }
}