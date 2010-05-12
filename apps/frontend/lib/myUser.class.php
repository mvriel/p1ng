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

  /**
   * Scans the Project roles to see which projects the user has access to.
   *
   * @return array
   */
  public function getAllowedProjects()
  {
    // super admins may see and know all
    if ($this->getGuardUser()->getIsSuperAdmin())
    {
      return null;
    }

    // iterate through all the user's roles and collect which projects he has access to
    $result = array();
    foreach ($this->getGuardUser()->getP1ngProjectRoleUser() as $role)
    {
      $result[] = $role->getP1ngProjectId();
    }

    return $result;
  }

}
