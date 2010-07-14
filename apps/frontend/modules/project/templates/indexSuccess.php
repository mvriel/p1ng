<h1>Projects</h1>


<?php foreach ($p1ng_projects as $p1ng_project): ?>
<div class="admin_group">
  <a href="<?php echo url_for('project/show?id='.$p1ng_project->getId()) ?>" style="color: black">
    <h1><?php echo $p1ng_project->getName() ?></h1>
    <div align="center" style="padding: 10px 0px;">
      <img src="<?php echo image_path('icons/project64x64.png');?>" border="0" />
    </div>
    <table>
    <tr><th>Code: </th><td><?php echo $p1ng_project->getCode() ?></td></tr>
    <tr><th>Customer:</th><td><?php echo $p1ng_project->getP1ngCustomer() ?></td></tr>
    </table>
  </a>
</div>
<?php endforeach; ?>

<div style="clear: both"></div>

<?php slot('sidebar'); ?>
<div class="section">
  <h1>Actions</h1>
  <a href="<?php echo url_for('project/new') ?>">New project</a>
</div>
<?php end_slot(); ?>
