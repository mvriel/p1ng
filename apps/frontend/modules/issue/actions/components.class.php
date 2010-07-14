<?php
class issueComponents extends sfComponents
{
  public function executeReport(sfWebRequest $request)
  {
    $report = $request->getParameter('report');
//    if (!$report)
//    {
//      return sfView::NONE;
//    }

    /** @var P1ngIssueTable $table */
    $table = Doctrine::getTable('P1ngIssue');
    $order = $request->getParameter('order', 'id');
    $this->action = 'issue/report?report=1';
    $this->target_action = 'issue/show';
    $this->columns = array(
      'id' => sfInflector::humanize($table->getColumnName('id')),
      'subject' => sfInflector::humanize($table->getColumnName('subject')),
    );

    $this->pager = new sfDoctrinePager('P1ngIssue', 10);
    $this->pager->setQuery(Doctrine::getTable('P1ngIssue')->createQuery('dctrn_find')->addOrderBy($order));
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
  }

}