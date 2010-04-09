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
	
}
