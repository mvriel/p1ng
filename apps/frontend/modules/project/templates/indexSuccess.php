<h1>Projects</h1>

<table>
  <thead>
    <tr>
      <th>Code</th>
      <th>Customer</th>
      <th>Name</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($p1ng_projects as $p1ng_project): ?>
    <tr>
      <td><?php echo $p1ng_project->getCode() ?></td>
      <td><?php echo $p1ng_project->getP1ngCustomer() ?></td>
      <td><a href="<?php echo url_for('project/show?id='.$p1ng_project->getId()) ?>"><?php echo $p1ng_project->getName() ?></a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php slot('right-sidebar'); ?>
<div class="section">
  <h1>Actions</h1>
  <a href="<?php echo url_for('project/new') ?>">New project</a>
</div>
<?php end_slot(); ?>
