<?php

/**
 * workflow actions.
 *
 * @package    p1ng
 * @subpackage workflow
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class workflowActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->p1ng_workflows = $this->getRoute()->getObjects();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->p1ng_workflow = $this->getRoute()->getObject();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new P1ngWorkflowForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = new P1ngWorkflowForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->form = new P1ngWorkflowForm($this->getRoute()->getObject());
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->form = new P1ngWorkflowForm($this->getRoute()->getObject());

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->getRoute()->getObject()->delete();

    $this->redirect('workflow/index');
  }

  /**
   * Constructs all Edges and nodes outbound of the given node
   *
   * @todo edges containing expressions should have a different line
   * @todo edges and nodes should be clickable for details
   *
   * @param Image_GraphViz $graph
   * @param P1ngWorkflow $workflow
   * @param P1ngIssueStatus $node
   *
   * @return void
   */
  protected function buildEdges(Image_GraphViz $graph, P1ngWorkflow $workflow, P1ngIssueStatus $node)
  {
    static $edges_passed = array();

    /** @var P1ngIssueStatusTransition $transition */
    foreach ($node->getTo() as $transition)
    {
      // this edge was already drawn or does not belong to this workflow
      if (isset($edges_passed[$transition->getId()]) /*|| ($transition->getP1ngWorkflowId() != $workflow->getId())*/)
      {
        continue;
      }

      // keep track which edges are done
      $edges_passed[$transition->getId()] = true;

      $destination = $transition->getTo();

      $graph->addNode(
        $destination->getId(),
        array(
  //        'URL'   => 'http://link1',
          'label' => $destination->getName(),
          'shape' => 'box'
        )
      );

      $graph->addEdge(
        array(
          $node->getId() => $destination->getId()
        ),
        array(
          'label' => $transition->getName(),
          'fontsize' => 2.0
        )
      );

      $this->buildEdges($graph, $workflow, $destination);
    }

  }

  public function executeGraph(sfWebRequest $request)
  {
    /** @var P1ngWorkflow $p1ng_workflow */
    $p1ng_workflow = $this->getRoute()->getObject();

    error_reporting(0);
    require_once(sfConfig::get('sf_lib_dir').'/vendor/Image_Graphviz/GraphViz.php');

    $graph = new Image_GraphViz(true, array('bgcolor' => 'transparent'));

    /** @var P1ngIssueStatus $start */
    $start = $p1ng_workflow->getP1ngIssueStatus();
    $graph->addNode(
      $start->getId(),
      array(
        'label' => $start->getName(),
        'shape' => 'box'
//        'URL'   => 'http://link1',
      )
    );

//    var_export($start->getTo()->count());
    $this->buildEdges($graph, $workflow, $start);

    $graph_svg = $graph->fetch();

    $this->getResponse()->setContentType('image/svg+xml');
    $this->getResponse()->setContent($graph_svg);

    return sfView::NONE;
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $p1ng_workflow = $form->save();

      $this->redirect('workflow/edit?id='.$p1ng_workflow->getId());
    }
  }
}
