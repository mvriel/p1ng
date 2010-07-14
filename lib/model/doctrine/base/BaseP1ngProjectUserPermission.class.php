<?php

/**
 * BaseP1ngProjectUserPermission
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $sf_guard_user_id
 * @property integer $p1ng_project_id
 * @property integer $sf_guard_permission_id
 * @property sfGuardUser $sfGuardUser
 * @property P1ngProject $P1ngProject
 * @property sfGuardPermission $sfGuardPermission
 * 
 * @method integer                   getSfGuardUserId()          Returns the current record's "sf_guard_user_id" value
 * @method integer                   getP1ngProjectId()          Returns the current record's "p1ng_project_id" value
 * @method integer                   getSfGuardPermissionId()    Returns the current record's "sf_guard_permission_id" value
 * @method sfGuardUser               getSfGuardUser()            Returns the current record's "sfGuardUser" value
 * @method P1ngProject               getP1ngProject()            Returns the current record's "P1ngProject" value
 * @method sfGuardPermission         getSfGuardPermission()      Returns the current record's "sfGuardPermission" value
 * @method P1ngProjectUserPermission setSfGuardUserId()          Sets the current record's "sf_guard_user_id" value
 * @method P1ngProjectUserPermission setP1ngProjectId()          Sets the current record's "p1ng_project_id" value
 * @method P1ngProjectUserPermission setSfGuardPermissionId()    Sets the current record's "sf_guard_permission_id" value
 * @method P1ngProjectUserPermission setSfGuardUser()            Sets the current record's "sfGuardUser" value
 * @method P1ngProjectUserPermission setP1ngProject()            Sets the current record's "P1ngProject" value
 * @method P1ngProjectUserPermission setSfGuardPermission()      Sets the current record's "sfGuardPermission" value
 * 
 * @package    p1ng
 * @subpackage model
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: Builder.php 7021 2010-01-12 20:39:49Z lsmith $
 */
abstract class BaseP1ngProjectUserPermission extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('p1ng_project_user_permission');
        $this->hasColumn('sf_guard_user_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => '4',
             ));
        $this->hasColumn('p1ng_project_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('sf_guard_permission_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => '4',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser', array(
             'local' => 'sf_guard_user_id',
             'foreign' => 'id'));

        $this->hasOne('P1ngProject', array(
             'local' => 'p1ng_project_id',
             'foreign' => 'id'));

        $this->hasOne('sfGuardPermission', array(
             'local' => 'sf_guard_permission_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}