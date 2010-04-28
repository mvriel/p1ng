<?php

/**
 * BaseP1ngIssueStatus
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property Doctrine_Collection $from
 * @property Doctrine_Collection $to
 * @property Doctrine_Collection $issues
 * 
 * @method string              getName()   Returns the current record's "name" value
 * @method Doctrine_Collection getFrom()   Returns the current record's "from" collection
 * @method Doctrine_Collection getTo()     Returns the current record's "to" collection
 * @method Doctrine_Collection getIssues() Returns the current record's "issues" collection
 * @method P1ngIssueStatus     setName()   Sets the current record's "name" value
 * @method P1ngIssueStatus     setFrom()   Sets the current record's "from" collection
 * @method P1ngIssueStatus     setTo()     Sets the current record's "to" collection
 * @method P1ngIssueStatus     setIssues() Sets the current record's "issues" collection
 * 
 * @package    p1ng
 * @subpackage model
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: Builder.php 7021 2010-01-12 20:39:49Z lsmith $
 */
abstract class BaseP1ngIssueStatus extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('p1ng_issue_status');
        $this->hasColumn('name', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('P1ngIssueStatusTransition as from', array(
             'local' => 'id',
             'foreign' => 'from_id'));

        $this->hasMany('P1ngIssueStatusTransition as to', array(
             'local' => 'id',
             'foreign' => 'to_id'));

        $this->hasMany('P1ngIssue as issues', array(
             'local' => 'id',
             'foreign' => 'p1ng_issue_status_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $softdelete0 = new Doctrine_Template_SoftDelete();
        $this->actAs($timestampable0);
        $this->actAs($softdelete0);
    }
}