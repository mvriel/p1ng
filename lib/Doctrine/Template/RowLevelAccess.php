<?php
/**
 * @author    mvriel
 * @copyright
 */

/**
 * Provide a short description for this class.
 *
 * @author     mvriel
 * @package
 * @subpackage
 */
class Doctrine_Template_RowLevelAccess extends Doctrine_Template
{
  protected $_options = array(
    'field'       => 'id',    // defines which field to use as origin value, may reside in a different table (which should be bound)
    'callback'    => array(
      'class'  => 'SF_USER',
      'method' => null
    ), // defines the method to verify against, you can use SF_USER as special variable
    'bindings'    => array()  // defines the route (joins) which must be followed to be able to match
  );

  protected $_listener = null;

  public function setTableDefinition()
  {
    if ($this->_options['callback']['method'] === null)
    {
      throw new Doctrine_Template_Exception_RowLevelAccess('It is mandatory that you define a method name for the callback');
    }

    // get the user object if class equals SF_USER and the context has an instance
    if ($this->_options['callback']['class'] == 'SF_USER')
    {
      // RLA cannot be applied if there is no context, thus we skip it
      if (!sfContext::hasInstance())
      {
        return;
      }
      $this->_options['callback']['class'] = sfContext::getInstance()->getUser();
    }

    // create a true callable
    $this->_options['callback'] = new sfCallable(array($this->_options['callback']['class'], $this->_options['callback']['method']));

    // set up the listener
    $this->_listener = new Doctrine_Template_Listener_RowLevelAccess($this->_options);
    $this->addListener($this->_listener);
  }

}
