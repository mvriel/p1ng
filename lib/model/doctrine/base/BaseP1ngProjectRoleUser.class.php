<?php

/**
 * BaseP1ngProjectRoleUser
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $p1ng_project_id
 * @property integer $p1ng_project_role_id
 * @property integer $sf_guard_user_id
 * @property P1ngProject $P1ngProject
 * @property P1ngProjectRole $P1ngProjectRole
 * @property sfGuardUser $sfGuardUser
 * 
 * @method integer             getP1ngProjectId()        Returns the current record's "p1ng_project_id" value
 * @method integer             getP1ngProjectRoleId()    Returns the current record's "p1ng_project_role_id" value
 * @method integer             getSfGuardUserId()        Returns the current record's "sf_guard_user_id" value
 * @method P1ngProject         getP1ngProject()          Returns the current record's "P1ngProject" value
 * @method P1ngProjectRole     getP1ngProjectRole()      Returns the current record's "P1ngProjectRole" value
 * @method sfGuardUser         getSfGuardUser()          Returns the current record's "sfGuardUser" value
 * @method P1ngProjectRoleUser setP1ngProjectId()        Sets the current record's "p1ng_project_id" value
 * @method P1ngProjectRoleUser setP1ngProjectRoleId()    Sets the current record's "p1ng_project_role_id" value
 * @method P1ngProjectRoleUser setSfGuardUserId()        Sets the current record's "sf_guard_user_id" value
 * @method P1ngProjectRoleUser setP1ngProject()          Sets the current record's "P1ngProject" value
 * @method P1ngProjectRoleUser setP1ngProjectRole()      Sets the current record's "P1ngProjectRole" value
 * @method P1ngProjectRoleUser setSfGuardUser()          Sets the current record's "sfGuardUser" value
 * 
 * @package    p1ng
 * @subpackage model
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: Builder.php 7021 2010-01-12 20:39:49Z lsmith $
 */
abstract class BaseP1ngProjectRoleUser extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('p1ng_project_role_user');
        $this->hasColumn('p1ng_project_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('p1ng_project_role_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('sf_guard_user_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => '4',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('P1ngProject', array(
             'local' => 'p1ng_project_id',
             'foreign' => 'id'));

        $this->hasOne('P1ngProjectRole', array(
             'local' => 'p1ng_project_role_id',
             'foreign' => 'id'));

        $this->hasOne('sfGuardUser', array(
             'local' => 'sf_guard_user_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $softdelete0 = new Doctrine_Template_SoftDelete();
        $signable0 = new Doctrine_Template_Signable();
        $this->actAs($timestampable0);
        $this->actAs($softdelete0);
        $this->actAs($signable0);
    }
}