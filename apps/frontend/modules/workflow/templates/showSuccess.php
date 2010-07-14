<div class="notice-box">Click on one of the statusses to add a transition, or click on a transition to edit or remove it.</div>
<object data="<?php echo url_for('@workflow_graph?id='.$p1ng_workflow->getId()); ?>"
  width="690"
  height="900"
  type="image/svg+xml" />

<hr />

<?php slot('sidebar'); ?>
<div class="section">
  <h1>Details</h1>
  <table>
    <tbody>
      <tr><th>Name:</th><td><?php echo $p1ng_workflow->getName() ?></td></tr>
      <tr><th>Project:</th><td><?php echo $p1ng_workflow->getP1ngProject() ?></td></tr>
      <tr><th>Starts at:</th><td><?php echo $p1ng_workflow->getP1ngIssueStatus() ?></td></tr>
      <tr><th>Created at:</th><td><?php echo format_date($p1ng_workflow->getCreatedAt()) ?></td></tr>
      <tr><th>Updated at:</th><td><?php echo format_date($p1ng_workflow->getUpdatedAt()) ?></td></tr>
      <?php if ($p1ng_workflow->getDeletedAt()): ?>
      <tr><th>Deleted at:</th><td><?php echo format_date($p1ng_workflow->getDeletedAt()) ?></td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
<div class="section">
  <h1>Actions</h1>
  <a href="<?php echo url_for('workflow/index') ?>">Return to overview</a><br />
  <a href="<?php echo url_for('workflow/edit?id='.$p1ng_workflow->getId()) ?>">Edit the details</a><br />
</div>
<?php end_slot(); ?>