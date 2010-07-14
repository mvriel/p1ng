<?php require_once(sfConfig::get('sf_lib_dir') . '/markdown.php'); ?>

<div id="post-entry">
  <div class="post-meta">
    <table class="post-meta">
      <td class="date">
        <table class="post-date"><tr><td class="month"><?php echo date('M', strtotime($p1ng_issue->getCreatedAt())); ?></td><td class="day"><?php echo date('d', strtotime($p1ng_issue->getCreatedAt())); ?></td></tr></table>
      </td>
      <td><h1><?php echo $p1ng_issue->getSubject() ?></h1></td>
    </table>
    <table>
      <tbody>
      <?php foreach ($p1ng_issue->getCustom()->getCustomFields() as $field): ?>
      <tr>
        <th><?php echo $field->getLabel(); ?></th>
        <td><?php echo include_partial('field/'.$field->getDefinition()->getWidget(), array('field' => $field, 'content' => $p1ng_issue->getCustom()->get($field->getFieldName()))); ?></td>
      </tr>
      <?php endforeach;?>
      </tbody>
    </table>
  </div>
</div>
<div class="post-content">
</div>

<hr />

<div id="comment-temps">
  <?php foreach ($p1ng_issue->getLogs() as $log): ?>
  <?php include_partial('log/show', array('p1ng_issue_log' => $log)); ?>
  <hr color="silver" size="1" />
  <?php endforeach; ?>

  <a class="button" onclick="jQuery('#create_log').slideToggle()">Add a new comment</a>
  <div id="create_log" style="display: none">
  <?php include_partial('log/form', array('form' => $log_form)); ?>
  </div>
</div>

<?php slot('sidebar'); ?>
<div class="section">
  <h1>Details</h1>
  <table>
    <tr>
      <th>Issue number</th>
      <td><?php echo $p1ng_issue; ?></td>
    </tr>
    <tr>
      <th>Status</th>
      <td><?php echo $p1ng_issue->getP1ngIssueStatus(); ?></td>
    </tr>
    <tr>
      <th>Reported at</th>
      <td><?php echo format_date($p1ng_issue->getCreatedAt()); ?></td>
    </tr>
    <tr>
      <th>Last modified</th>
      <td><?php echo format_date($p1ng_issue->getUpdatedAt()); ?></td>
    </tr>
  </table>
</div>

<div class="section">
  <h1>Actions</h1>
  <a href="<?php echo url_for('issue/index') ?>">Return to list</a><br />
  <a href="<?php echo url_for('issue/edit?id=' . $p1ng_issue->getId()) ?>">Edit</a><br />
  <hr style="border-color: #eeeeee" />
<?php foreach ($p1ng_issue->getP1ngIssueStatus()->getTo() as $transition): ?>
  <?php if ($transition->getP1ngWorkflowId() !== Doctrine::getTable('P1ngWorkflow')->findActiveByP1ngProjectId($p1ng_issue->getP1ngProjectId())->getId()) continue; ?>
  <a href="<?php echo url_for('@transit?id=' . $p1ng_issue->getId() . '&transition_id=' . $transition->getId());?>"><?php echo $transition->getName(); ?></a>
<?php endforeach; ?>
</div>
<?php end_slot(); ?>