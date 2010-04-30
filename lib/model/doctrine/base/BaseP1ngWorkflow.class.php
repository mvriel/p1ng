<?php

/**
 * BaseP1ngWorkflow
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $p1ng_project_id
 * @property integer $p1ng_issue_status_id
 * @property string $name
 * @property P1ngProject $P1ngProject
 * @property P1ngIssueStatus $P1ngIssueStatus
 * @property Doctrine_Collection $P1ngIssueStatusTransition
 * 
 * @method integer             getP1ngProjectId()             Returns the current record's "p1ng_project_id" value
 * @method integer             getP1ngIssueStatusId()         Returns the current record's "p1ng_issue_status_id" value
 * @method string              getName()                      Returns the current record's "name" value
 * @method P1ngProject         getP1ngProject()               Returns the current record's "P1ngProject" value
 * @method P1ngIssueStatus     getP1ngIssueStatus()           Returns the current record's "P1ngIssueStatus" value
 * @method Doctrine_Collection getP1ngIssueStatusTransition() Returns the current record's "P1ngIssueStatusTransition" collection
 * @method P1ngWorkflow        setP1ngProjectId()             Sets the current record's "p1ng_project_id" value
 * @method P1ngWorkflow        setP1ngIssueStatusId()         Sets the current record's "p1ng_issue_status_id" value
 * @method P1ngWorkflow        setName()                      Sets the current record's "name" value
 * @method P1ngWorkflow        setP1ngProject()               Sets the current record's "P1ngProject" value
 * @method P1ngWorkflow        setP1ngIssueStatus()           Sets the current record's "P1ngIssueStatus" value
 * @method P1ngWorkflow        setP1ngIssueStatusTransition() Sets the current record's "P1ngIssueStatusTransition" collection
 * 
 * @package    p1ng
 * @subpackage model
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: Builder.php 7021 2010-01-12 20:39:49Z lsmith $
 */
abstract class BaseP1ngWorkflow extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('p1ng_workflow');
        $this->hasColumn('p1ng_project_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('p1ng_issue_status_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('name', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('P1ngProject', array(
             'local' => 'p1ng_project_id',
             'foreign' => 'id'));

        $this->hasOne('P1ngIssueStatus', array(
             'local' => 'p1ng_issue_status_id',
             'foreign' => 'id'));

        $this->hasMany('P1ngIssueStatusTransition', array(
             'local' => 'id',
             'foreign' => 'p1ng_workflow_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $softdelete0 = new Doctrine_Template_SoftDelete();
        $this->actAs($timestampable0);
        $this->actAs($softdelete0);
    }
}