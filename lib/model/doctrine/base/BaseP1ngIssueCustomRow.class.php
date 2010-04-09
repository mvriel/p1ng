<?php

/**
 * BaseP1ngIssueCustomRow
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $p1ng_issue_id
 * @property P1ngIssue $P1ngIssue
 * 
 * @method integer            getP1ngIssueId()   Returns the current record's "p1ng_issue_id" value
 * @method P1ngIssue          getP1ngIssue()     Returns the current record's "P1ngIssue" value
 * @method P1ngIssueCustomRow setP1ngIssueId()   Sets the current record's "p1ng_issue_id" value
 * @method P1ngIssueCustomRow setP1ngIssue()     Sets the current record's "P1ngIssue" value
 * 
 * @package    p1ng
 * @subpackage model
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: Builder.php 7021 2010-01-12 20:39:49Z lsmith $
 */
abstract class BaseP1ngIssueCustomRow extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('p1ng_issue_custom_row');
        $this->hasColumn('p1ng_issue_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('P1ngIssue', array(
             'local' => 'p1ng_issue_id',
             'foreign' => 'id'));
    }
}