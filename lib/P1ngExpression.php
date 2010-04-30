<?php
/**
 * This class provides the means to parse a P1ng expression.
 *
 * An expression always evaluates to a boolean and may be composed of multiple other expressions.
 * Example: (({issue.id} = "1") && ({customer.id} = "2"))
 * Variables are always encased in braces and literal values are always encased in double quotes.
 * Double quotes may be escaped using a slash
 *
 * @author     Mike van Riel
 * @package    P!ng
 * @subpackage Utils
 */
class P1ngExpression
{
  /** @var P1ngExpression|string $origin */
  protected $origin = null;

  /** @var string $operator */
  protected $operator = null;

  /** @var P1ngExpression|string $destination */
  protected $destination = null;

  /**
   * Returns the origin (first operand).
   *
   * @return P1ngExpression|string
   */
  public function getOrigin()
  {
    return $this->origin;
  }

  /**
   * Returns the destination (2nd operand).
   *
   * @return P1ngExpression|string
   */
  public function getDestination()
  {
    return $this->destination;
  }

  /**
   * Returns a string representing the operator sign.
   *
   * @return string
   */
  public function getOperator()
  {
    return $this->operator;
  }

  /**
   * Parses the given expression and transforms it into a neat object model.
   *
   * @throws Exception if there is a syntax error
   *
   * @param string $expression
   *
   * @return void
   */
  public function parse($expression)
  {
    if (!is_string($expression))
    {
      throw new Exception('Expected the expression to be a string, i.e. {issue.status}="new"');
    }

    // remove all surrounding filth
    $expression = trim($expression);
    $this->origin = null;
    $this->operator = '';
    $this->destination = null;

    $sub_expression = '';
    $openAs = null;
    $level = 0;
    $sub_expressions = array();

    for($i=0;$i<strlen($expression);$i++)
    {
      if (($openAs === null) || ($expression[$i] == '('))
      {
        switch($expression[$i])
        {
          case ' ':
            // ignore spaces
            break;
          case '"':
            $openAs = 'literal';
            break;
          case '(':
            $openAs = 'expression';
            $sub_expression .= $expression[$i];
            $level++; // register which brace matches
            break;
          case '{':
            $openAs = 'variable';
            break;
          case '=':
          case '!':
          case '>':
          case '<':
          case '&':
          case '|':
            if ($this->origin === null)
            {
              throw new Exception('Invalid Expression: the operator may only be present after the origin');
            }
            if ($this->destination !== null)
            {
              throw new Exception('Invalid Expression: the operator may only be present before the destination, destination contains: '.$this->destination);
            }
            $this->operator .= $expression[$i];
            break;
          default:
            throw new Exception('Invalid expression: an argument should always start with ", $ or (, found '.$expression[$i]);
        }
        continue;
      }

      // close a literal
      if (($expression[$i] == '"') && ($expression[$i-1] != '\\') && ($openAs == 'literal'))
      {
        $sub_expression = str_replace('\"', '"', $sub_expression);
        if ($this->origin === null)
        {
          $this->origin = $sub_expression;
        }
        elseif ($this->destination === null)
        {
          $this->destination = $sub_expression;
        }
        else
        {
          throw new Exception('Invalid Expression: a rogue literal ('.$sub_expression.') was detected, origin contains: '.$this->origin.' and destination: '.$this->destination);
        }

        $sub_expression = '';
        $openAs = null;
        continue;
      }


      // close an expression
      if (($expression[$i] == ')') && ($openAs == 'expression'))
      {
        $sub_expression .= $expression[$i];

        // check if the closing brace is actually with this level
        if ($level > 1)
        {
          $level--;
          continue;
        }

        if ($this->origin === null)
        {
          $this->origin = new P1ngExpression();
          $this->origin->setData($this->data);
          $this->origin->parse(substr($sub_expression, 1, -1));
        }
        elseif ($this->destination === null)
        {
          $this->destination = new P1ngExpression();
          $this->destination->setData($this->data);
          $this->destination->parse(substr($sub_expression, 1, -1));
        }
        else
        {
          throw new Exception('Invalid Expression: a rogue expression was detected');
        }

        $sub_expression = '';
        $level--;
        $openAs = null;
        continue;
      }

      // close a variable
      if (($expression[$i] == '}') && ($openAs == 'variable'))
      {
        if ($this->origin === null)
        {
          $this->origin = $this->data;
          foreach (explode('.', $sub_expression) as $key)
          {
            if (!isset($this->origin[$key]))
            {
              $this->origin[$key] = false;
            }
            $this->origin = $this->origin[$key];
          }

          // if we are left with an array (or anything else than a string!) we cannot compare
          if (!is_scalar($this->origin) && ($this->origin !== false))
          {
            throw new Exception('Invalid expression: the variable '.$sub_expression.' does not exist');
          }
        }
        elseif ($this->destination === null)
        {
          $this->destination = $this->data;
          foreach (explode('.', $sub_expression) as $key)
          {
            if (!isset($this->destination[$key]))
            {
              $this->destination[$key] = false;
            }
            $this->destination = $this->destination[$key];
          }

          // if we are left with an array (or anything else than a string!) we cannot compare
          if (!is_scalar($this->destination) && ($this->destination !== false))
          {
            throw new Exception('Invalid expression: the variable '.$sub_expression.' does not exist');
          }
        }
        else
        {
          throw new Exception('Invalid Expression: a rogue literal was detected');
        }

        $sub_expression = '';
        $openAs = null;
        continue;
      }

      $sub_expression .= $expression[$i];
    }
  }

  /**
   * Sets an associative array of the current state against which this expression must compare.
   *
   * @param array $data
   *
   * @return void
   */
  public function setData(array $data)
  {
    $this->data = $data;
  }

  /**
   * Evaluates the expression against the given data set.
   *
   * @return boolean
   */
  public function evaluate()
  {
    $origin = ($this->getOrigin() instanceof P1ngExpression) ? $this->getOrigin()->evaluate() : $this->getOrigin();
    $destination = ($this->getDestination() instanceof P1ngExpression) ? $this->getDestination()->evaluate() : $this->getDestination();

    switch ($this->getOperator())
    {
      case '>':  return ($origin > $destination);
      case '>=': return ($origin >= $destination);
      case '<':  return ($origin < $destination);
      case '<=': return ($origin <= $destination);
      case '!=': return ($origin != $destination);
      case '=':
      case '==': return ($origin == $destination);
      case '&':
      case '&&': return ($origin && $destination);
      case '|':
      case '||': return ($origin || $destination);
      case '':
      case null: return ($origin) ? true : false;
      default:   throw new Exception('Unknown operator encountered: '.$this->getOperator());
    }
  }

  /**
   * Returns the textual representation of an expression.
   *
   * @return string
   */
  public function __toString()
  {
    $origin = ($this->getOrigin() instanceof P1ngExpression) ? '('.(string)$this->getOrigin().')' : '"'.$this->getOrigin().'"';
    $destination = ($this->getDestination() instanceof P1ngExpression) ? '('.(string)$this->getDestination().')' : '"'.$this->getDestination().'"';

    return $origin.' '.$this->getOperator().' '.$destination;
  }

}