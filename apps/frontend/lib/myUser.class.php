<?php

class myUser extends sfGuardSecurityUser
{
  /**
   * Returns the id for this User.
   *
   * This is used by the signable doctrine behavior to determine which user is logged on
   *
   * @return integer|null
   */
  public function getId()
  {
    return $this->getGuardUser() ? $this->getGuardUser()->getId() : null;
  }

  public function addCredentials()
  {
//    $added = false;
//    $rla = Doctrine::getTable('P1ngRowLevelAccess')->findByUserId($this->getId());
//
//    /** @var P1ngRowLevelAccess $item */
//    foreach($rla as $item)
//    {
//      $added = true;
//      $permission = Doctrine::getTable('sfGuardPermission')->find($item->getPermissionId());
//      $name = $item->getNamespace().'.'.$item->getValue().'.'.$permission->getName();
//      $this->credentials[] = $name;
//    }
//
//    if ($added)
//    {
//      $this->storage->regenerate(false);
//    }
//
    $credentials = (is_array(func_get_arg(0))) ? func_get_arg(0) : func_get_args();
    parent::addCredentials($credentials);
  }

  /**
   * Extend method to automatically look in several other namespaces if it is allowed
   *
   * @param string $credential
   * @param bool $useAnd
   * @param array $namespace
   * @return bool
   */
  public function hasCredential($credential, $useAnd = true, $namespace = array())
  {
    // check global space whether the user has the credential
    $result = parent::hasCredential($credential, $useAnd);
    if (!$result)
    {
      foreach($namespace as $name => $key)
      {
        // allow the use of objects and convert them
        if (is_object($key) && ($key instanceof sfDoctrineRecord))
        {
          $name = get_class($key);
          $key = $key->getId();
        }

        // check namespace whether the user has the credential
        $result = parent::hasCredential($name.'.'.$key.'.'.$credential, $useAnd);
      }
    }

    return $result;
  }

  public function getProject()
  {
    static $project = null;

    if (!$project && $this->getProjectId())
    {
      $project = Doctrine::getTable('P1ngProject')->find($this->getProjectId());
    }

    return $project;
  }

  public function getProjectId()
  {
    return $this->getAttribute('project_id');
  }

  public function setProjectId($project_id)
  {
    // set the project id already as it is used with the hasCredential method
    $this->setAttribute('project_id', $project_id);

    // check if we are allowed to use this project
    if (!$this->hasCredential('project.read'))
    {
      $this->setAttribute('project_id', null);
      throw new Exception('You are not allowed to view this project');
    }
  }

  public function getAllowedProjects()
  {
    // super admins may see and know all
    if ($this->getGuardUser()->getIsSuperAdmin())
    {
      return null;
    }

    return 0;
  }

  public function signOut()
  {
    parent::signOut();
    $this->setAttribute('project_id', null);
  }

}
