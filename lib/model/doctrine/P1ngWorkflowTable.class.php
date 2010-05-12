<?php

class P1ngWorkflowTable extends Doctrine_Table
{

  public function findActiveByP1ngProjectId($project_id)
  {
    // make it work
    return $this->findByP1ngProjectId($project_id)->getFirst();
  }

}
