<h1><?php echo $p1ng_issue->getSubject() ?></h1>
<table>
  <tbody>
	<?php foreach ($p1ng_issue->getCustom()->getCustomFields() as $field): ?>
    <tr>
      <th><?php echo $field->getLabel(); ?></th>
      <td><?php echo $p1ng_issue->getCustom()->get($field->getFieldName()); ?></td>
    </tr>
	<?php endforeach;?>
  </tbody>
</table>

<hr />
<?php foreach ($p1ng_issue->getLogs() as $log): ?>
	<?php include_partial('log/show', array('p1ng_issue_log' => $log)); ?>
<hr color="silver" size="1" />
<?php endforeach; ?>

<div id="create_log">
<h2>Create log</h2>
<?php include_partial('log/form', array('form' => $log_form)); ?>
</div>

<?php slot('right-sidebar');?>
<a style="float: right" href="<?php echo url_for('issue/edit?id='.$p1ng_issue->getId()) ?>">Edit</a>
<a href="<?php echo url_for('issue/index') ?>">Return to list</a>
<table>
<tr><th>Issue number</th><td><?php echo $p1ng_issue; ?></td></tr>
<tr><th>Status</th><td><?php echo $p1ng_issue->getP1ngIssueStatus(); ?></td></tr>
<tr><th>Reported at</th><td><?php echo format_date($p1ng_issue->getCreatedAt()); ?></td></tr>
<tr><th>Last modified</th><td><?php echo format_date($p1ng_issue->getUpdatedAt()); ?></td></tr>
</table>

<?php foreach($p1ng_issue->getP1ngIssueStatus()->getFrom() as $transition): ?>
<a href="<?php echo url_for('@transition?id='.$p1ng_issue->getId().'&transition_id='.$transition->getId());?>"><?php echo $transition->getName(); ?></a>
<?php endforeach; ?>
<?php end_slot();?>