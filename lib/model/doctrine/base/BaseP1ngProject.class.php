<?php

/**
 * BaseP1ngProject
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $p1ng_customer_id
 * @property string $code
 * @property string $name
 * @property P1ngCustomer $P1ngCustomer
 * @property Doctrine_Collection $P1ngProjectUserPermission
 * @property Doctrine_Collection $P1ngProjectGroupPermission
 * @property Doctrine_Collection $P1ngWorkflow
 * @property Doctrine_Collection $issues
 * @property Doctrine_Collection $P1ngProjectRoleUser
 * 
 * @method integer             getP1ngCustomerId()             Returns the current record's "p1ng_customer_id" value
 * @method string              getCode()                       Returns the current record's "code" value
 * @method string              getName()                       Returns the current record's "name" value
 * @method P1ngCustomer        getP1ngCustomer()               Returns the current record's "P1ngCustomer" value
 * @method Doctrine_Collection getP1ngProjectUserPermission()  Returns the current record's "P1ngProjectUserPermission" collection
 * @method Doctrine_Collection getP1ngProjectGroupPermission() Returns the current record's "P1ngProjectGroupPermission" collection
 * @method Doctrine_Collection getP1ngWorkflow()               Returns the current record's "P1ngWorkflow" collection
 * @method Doctrine_Collection getIssues()                     Returns the current record's "issues" collection
 * @method Doctrine_Collection getP1ngProjectRoleUser()        Returns the current record's "P1ngProjectRoleUser" collection
 * @method P1ngProject         setP1ngCustomerId()             Sets the current record's "p1ng_customer_id" value
 * @method P1ngProject         setCode()                       Sets the current record's "code" value
 * @method P1ngProject         setName()                       Sets the current record's "name" value
 * @method P1ngProject         setP1ngCustomer()               Sets the current record's "P1ngCustomer" value
 * @method P1ngProject         setP1ngProjectUserPermission()  Sets the current record's "P1ngProjectUserPermission" collection
 * @method P1ngProject         setP1ngProjectGroupPermission() Sets the current record's "P1ngProjectGroupPermission" collection
 * @method P1ngProject         setP1ngWorkflow()               Sets the current record's "P1ngWorkflow" collection
 * @method P1ngProject         setIssues()                     Sets the current record's "issues" collection
 * @method P1ngProject         setP1ngProjectRoleUser()        Sets the current record's "P1ngProjectRoleUser" collection
 * 
 * @package    p1ng
 * @subpackage model
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: Builder.php 7021 2010-01-12 20:39:49Z lsmith $
 */
abstract class BaseP1ngProject extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('p1ng_project');
        $this->hasColumn('p1ng_customer_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('code', 'string', 20, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => '20',
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('P1ngCustomer', array(
             'local' => 'p1ng_customer_id',
             'foreign' => 'id'));

        $this->hasMany('P1ngProjectUserPermission', array(
             'local' => 'id',
             'foreign' => 'p1ng_project_id'));

        $this->hasMany('P1ngProjectGroupPermission', array(
             'local' => 'id',
             'foreign' => 'p1ng_project_id'));

        $this->hasMany('P1ngWorkflow', array(
             'local' => 'id',
             'foreign' => 'p1ng_project_id'));

        $this->hasMany('P1ngIssue as issues', array(
             'local' => 'id',
             'foreign' => 'p1ng_project_id'));

        $this->hasMany('P1ngProjectRoleUser', array(
             'local' => 'id',
             'foreign' => 'p1ng_project_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $softdelete0 = new Doctrine_Template_SoftDelete();
        $signable0 = new Doctrine_Template_Signable();
        $rowlevelaccess0 = new Doctrine_Template_RowLevelAccess(array(
             'callback' => 
             array(
              'method' => 'getAllowedProjects',
             ),
             ));
        $this->actAs($timestampable0);
        $this->actAs($softdelete0);
        $this->actAs($signable0);
        $this->actAs($rowlevelaccess0);
    }
}