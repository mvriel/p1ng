<?php

class P1ngIssueCustomFieldTable extends Doctrine_Table
{
	/**
	 * Retrieves the active custom fields for this row
	 * 
	 * @param P1ngIssueCustomRow $row
	 * @return array
	 */
	public function findAllActiveForDate($date)
	{
		return $this->createQuery()->
			where('created_at < ?', $date)->
			andWhere('deleted_at > ?', $date)->
			orWhere('deleted_at IS NULL')->
			execute();
	}
}
