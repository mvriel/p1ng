<?php

/**
 * Listener for the Row Level Access behavior which checks whether the user os associated with
 * this object before any action takes place.
 *
 * @package    P1ng
 * @subpackage Listeners
 * @author     mvriel
 */
class Doctrine_Template_Listener_RowLevelAccess extends Doctrine_Record_Listener
{
  /**
   * Provide the means to (temporarily) deactivate RLA
   */
  static protected $is_active = true;

  /**
   * Enable the RLA listener
   *
   * @return void
   */
  public static function enable()
  {
    self::$is_active = true;
  }

  /**
   * Disable the RLA listener.
   *
   * @return void
   */
  public static function disable()
  {
    self::$is_active = false;
  }

  /**
   * Returns whether the RLA is active.
   *
   * @return bool
   */
  public static function isActive()
  {
    return self::$is_active;
  }

  /**
   * Sets the options.
   *
   * @param array $options
   *
   * @return void
   */
  public function __construct($options)
  {
    $this->_options = $this->_options + $options;
  }

  /**
   * Returns the information from the target
   *
   * @return string|mixed
   */
  protected function getTarget()
  {
    // callbacks should not be hindered by the RLA; this also prevents infinite loops
    self::disable();
    $target = $this->getOption('callback')->call();
    self::enable();

    // only accept arrays and scalars
    if (!is_array($target) && !is_scalar($target) && ($target !== null))
    {
      throw new Doctrine_Template_Exception_RowLevelAccess('Row Level Access target appears to be something other than an array or scalar; found: '.gettype($target));
    }

    return $target;
  }

  /**
   * Returns the field used to test against.
   *
   * This method converts the Model name to a tablename
   *
   * @return string
   */
  protected function getField()
  {
    $field = explode('.', $this->getOption('field'));

    // translate model name to table name
    if (count($field) > 1)
    {
      $field[0] = Doctrine::getTable($field[0])->getTableName();
    }
    $field = implode('.', $field);

    return $field;
  }

  /**
   * Appends the necessary clauses to an existing query in order to restrict the query.
   *
   * @param Doctrine_Query $query
   *
   * @return void
   */
  protected function appendQuery(Doctrine_Query $query)
  {
    if (!self::isActive())
    {
      return;
    }

    $target = $this->getTarget();

    // null means unlimited access
    if ($target === null)
    {
      return;
    }

    $field = $this->getField();

    // if we are dealing with an array, generate an IN statement
    if (is_array($target))
    {
      // just kill the query if target is empty
      if (empty($target))
      {
        $query->andWhere('true=false');
        return;
      }

      $query->andWhereIn($field, $target);
      return;
    }

    // otherwise it is a scalar and we generate a normal where AND statement
    $query->andWhere($field.' = ?', $target);
  }

  /**
   * Limits the resultset of a model by adding additional criteria.
   *
   * The criteria are determined by the options provided by the behaviour.
   *
   * @param Doctrine_Event $event
   *
   * @return void
   */
  public function preDqlSelect(Doctrine_Event $event)
  {
    $this->appendQuery($event->getQuery());
  }

  /**
   * Limits the update of a model by adding additional criteria.
   *
   * The criteria are determined by the options provided by the behaviour.
   *
   * @param Doctrine_Event $event
   *
   * @return void
   */
  public function preDqlUpdate(Doctrine_Event $event)
  {
    $this->appendQuery($event->getQuery());
  }

  /**
   * Limits the delete of a model by adding additional criteria.
   *
   * The criteria are determined by the options provided by the behaviour.
   *
   * @param Doctrine_Event $event
   *
   * @return void
   */
  public function preDqlDelete(Doctrine_Event $event)
  {
    $this->appendQuery($event->getQuery());
  }

  /**
   * Scans the current invoker whether it may be inserted.
   *
   * Note: only 'local' fields are currently supported.
   *
   * @throws Doctrine_Template_Exception_RowLevelAccess
   *
   * @param Doctrine_Event $event
   *
   * @return void
   */
  public function preInsert(Doctrine_Event $event)
  {
    if (!self::isActive())
    {
      return;
    }

    $target = $this->getTarget();

    // null means unlimited access
    if ($target === null)
    {
      return;
    }

    $field  = $this->getOption('field');

    // convert to array for easier processing
    if (!is_array($target))
    {
      $target = array($target);
    }

    // there is no dot, thus it is about the current field
    if (strpos($field, '.') === false)
    {
      // check if any of the target value match the field contents
      $found = false;
      foreach($target as $value)
      {
        if ($event->getInvoker()->$field == $value)
        {
          $found = true;
          break;
        }
      }

      // if no match is found we throw an exception
      if (!$found)
      {
        throw new Doctrine_Template_Exception_RowLevelAccess('Permission denied', 503);
      }

      return;
    }

    // there is a dot in the field name, this means that we have to lookup the value in an associated array
    throw new Doctrine_Template_Exception_RowLevelAccess('Not yet implemented', 500);
  }

}
