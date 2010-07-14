<h1>Workflows</h1>

<table>
  <thead>
    <tr>
      <th>Project</th>
      <th>Starting Status</th>
      <th>Name</th>
      <th>Created at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($p1ng_workflows as $p1ng_workflow): ?>
    <tr>
      <td><?php echo $p1ng_workflow->getP1ngProject() ?></td>
      <td><?php echo $p1ng_workflow->getP1ngIssueStatus() ?></td>
      <td><a href="<?php echo url_for('workflow/show?id='.$p1ng_workflow->getId()) ?>"><?php echo $p1ng_workflow->getName() ?></a></td>
      <td><?php echo $p1ng_workflow->getCreatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php slot('sidebar'); ?>
<div class="section">
  <h1>Actions</h1>
  <a href="<?php echo url_for('workflow/new') ?>">Create a new workflow</a>
</div>
<?php end_slot(); ?>
