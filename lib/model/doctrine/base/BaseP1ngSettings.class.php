<?php

/**
 * BaseP1ngSettings
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $namespace
 * @property string $name
 * @property string $value
 * 
 * @method string       getNamespace() Returns the current record's "namespace" value
 * @method string       getName()      Returns the current record's "name" value
 * @method string       getValue()     Returns the current record's "value" value
 * @method P1ngSettings setNamespace() Sets the current record's "namespace" value
 * @method P1ngSettings setName()      Sets the current record's "name" value
 * @method P1ngSettings setValue()     Sets the current record's "value" value
 * 
 * @package    p1ng
 * @subpackage model
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: Builder.php 7021 2010-01-12 20:39:49Z lsmith $
 */
abstract class BaseP1ngSettings extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('p1ng_settings');
        $this->hasColumn('namespace', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('name', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('value', 'string', null, array(
             'type' => 'string',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $timestampable0 = new Doctrine_Template_Timestampable();
        $softdelete0 = new Doctrine_Template_SoftDelete();
        $signable0 = new Doctrine_Template_Signable();
        $this->actAs($timestampable0);
        $this->actAs($softdelete0);
        $this->actAs($signable0);
    }
}