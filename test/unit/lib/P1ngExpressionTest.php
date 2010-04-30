<?php
require_once(dirname(__FILE__).'/../../bootstrap/unit.php');

$t = new lime_test();
$f = new P1ngExpression();

try
{
  $f->parse(new stdClass());
  $t->fail('Expected the parse method to throw an exception when passed an object');
} catch(Exception $e)
{
  $t->pass('Expected the parse method to throw an exception when passed an object');
}

$f->parse('"1"="2"');
$t->is($f->getOrigin(), '1', 'Expect the origin to be 1');
$t->is($f->getOperator(), '=', 'Expect the operator to be =');
$t->is($f->getDestination(), '2', 'Expect the destination to be 2');

$f->parse('"1"="2\"3"');
$t->is($f->getOrigin(), '1', 'Expect the origin to be 1');
$t->is($f->getOperator(), '=', 'Expect the operator to be =');
$t->is($f->getDestination(), '2"3', 'Expect the destination to be 2"3');

$f->parse('"1" >= "2"');
$t->is($f->getOrigin(), '1', 'Expect the origin to be 1');
$t->is($f->getOperator(), '>=', 'Expect the operator to be >=');
$t->is($f->getDestination(), '2', 'Expect the destination to be 2');

$f->setData(array(
  'a' => 1,
  'b' => 2
));
$f->parse('{a} >= "0"');
$t->is($f->getOrigin(), '1', 'Expect the origin to be 1');
$t->is($f->getOperator(), '>=', 'Expect the operator to be >=');
$t->is($f->getDestination(), '0', 'Expect the destination to be 0');
$t->is($f->evaluate(), true, 'Expression should evaluate to true');

$f->parse('{a}');
$t->is($f->getOrigin(), '1', 'Expect the origin to be 1');
$t->is($f->getOperator(), null, 'Expect the operator to be >=');
$t->is($f->getDestination(), null, 'Expect the destination to be 0');
$t->is($f->evaluate(), true, 'Just an origin should evaluate to true');

$f->parse('{x}');
$t->is($f->getOrigin(), false, 'Expect the origin to be false');
$t->is($f->getOperator(), null, 'Expect the operator to be >=');
$t->is($f->getDestination(), null, 'Expect the destination to be 0');
$t->is($f->evaluate(), false, 'Just a non-existing origin should evaluate to false');

$f->parse('{x} >= "0"');
$t->is($f->getOrigin(), false, 'A non-existing variable should return false');
$t->is($f->getOperator(), '>=', 'Expect the operator to be >=');
$t->is($f->getDestination(), '0', 'Expect the destination to be 0');
$t->is($f->evaluate(), true, 'Expression should evaluate to false');

$f->parse('{a} >= {b}');
$t->is($f->getOrigin(), '1', 'Expect the origin to be 1');
$t->is($f->getOperator(), '>=', 'Expect the operator to be >=');
$t->is($f->getDestination(), '2', 'Expect the destination to be 2');
$t->is($f->evaluate(), false, 'Expression should evaluate to false');

$f->parse('("1"="2") >= {b}');
$t->isa_ok($f->getOrigin(), 'P1ngExpression', 'Expect the origin to be of type P1ngExpression');
$t->is($f->getOrigin()->getOrigin(), '1', 'Expect the origin of the subexpression to be 1');
$t->is($f->getOrigin()->getOperator(), '=', 'Expect the operator of the subexpression to be =');
$t->is($f->getOrigin()->getDestination(), '2', 'Expect the destination of the subexpression to be 2');
$t->is($f->getOperator(), '>=', 'Expect the operator to be >=');
$t->is($f->getDestination(), '2', 'Expect the destination to be 2');
$t->is($f->evaluate(), false, 'Expression should evaluate to false (result is unpredictable since you are evaluating a bool to a string)');

$expression = '("1" = "2") & ("3" = "4")';
$f->parse($expression);
$t->is((string)$f, $expression, 'toString of expression should equal: '.$expression);
$t->isa_ok($f->getOrigin(), 'P1ngExpression', 'Expect the origin to be of type P1ngExpression');
$t->is($f->getOrigin()->getOrigin(), '1', 'Expect the origin of the subexpression to be 1');
$t->is($f->getOrigin()->getOperator(), '=', 'Expect the operator of the subexpression to be =');
$t->is($f->getOrigin()->getDestination(), '2', 'Expect the destination of the subexpression to be 2');
$t->is($f->getOperator(), '&', 'Expect the operator to be &');
$t->isa_ok($f->getDestination(), 'P1ngExpression', 'Expect the origin to be of type P1ngExpression');
$t->is($f->getDestination()->getOrigin(), '3', 'Expect the origin of the destination subexpression to be 1');
$t->is($f->getDestination()->getOperator(), '=', 'Expect the operator of the destination subexpression to be =');
$t->is($f->getDestination()->getDestination(), '4', 'Expect the destination of the destination subexpression to be 2');
$t->is($f->evaluate(), false, 'Expression should evaluate to false');

$expression = '(("1" = "2") & ("3" = "4")) || ("a" = "a")';
$f->parse($expression);
$t->is((string)$f, $expression, 'toString of expression should equal: '.$expression);
$t->isa_ok($f->getOrigin(), 'P1ngExpression', 'Expect the origin to be of type P1ngExpression');
$t->isa_ok($f->getDestination(), 'P1ngExpression', 'Expect the destination to be of type P1ngExpression');
$t->isa_ok($f->getOrigin()->getOrigin(), 'P1ngExpression', 'Expect the origin of the sub expression to be of type P1ngExpression');
$t->isa_ok($f->getOrigin()->getDestination(), 'P1ngExpression', 'Expect the destination of the subexpression to be of type P1ngExpression');
$t->is($f->evaluate(), true, 'Expression should evaluate to true');
