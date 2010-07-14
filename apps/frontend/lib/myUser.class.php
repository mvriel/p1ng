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
  public function hasCredential($credential, $useAnd = true)
  {
    // check global space whether the user has the credential
    $result = parent::hasCredential($credential, $useAnd);

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

  /**
   * Scans the Project roles to see which projects the user has access to.
   *
   * @return array
   */
  public function getAllowedProjects()
  {
    // not logged in? Don't get to see anything
    if (!$this->getGuardUser())
    {
      return array();
    }

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

  public function signOut()
  {
    parent::signOut();
    $this->setAttribute('project_id', null);
  }

}
