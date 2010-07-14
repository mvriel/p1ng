<h1>P1ng project user permissions List</h1>

<table>
  <thead>
    <tr>
      <th>Sf guard user</th>
      <th>P1ng project</th>
      <th>Sf guard permission</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($p1ng_project_user_permissions as $p1ng_project_user_permission): ?>
    <tr>
      <td><a href="<?php echo url_for('project_permission/edit?sf_guard_user_id='.$p1ng_project_user_permission->getSfGuardUserId().'&p1ng_project_id='.$p1ng_project_user_permission->getP1ngProjectId().'&sf_guard_permission_id='.$p1ng_project_user_permission->getSfGuardPermissionId()) ?>"><?php echo $p1ng_project_user_permission->getSfGuardUserId() ?></a></td>
      <td><a href="<?php echo url_for('project_permission/edit?sf_guard_user_id='.$p1ng_project_user_permission->getSfGuardUserId().'&p1ng_project_id='.$p1ng_project_user_permission->getP1ngProjectId().'&sf_guard_permission_id='.$p1ng_project_user_permission->getSfGuardPermissionId()) ?>"><?php echo $p1ng_project_user_permission->getP1ngProjectId() ?></a></td>
      <td><a href="<?php echo url_for('project_permission/edit?sf_guard_user_id='.$p1ng_project_user_permission->getSfGuardUserId().'&p1ng_project_id='.$p1ng_project_user_permission->getP1ngProjectId().'&sf_guard_permission_id='.$p1ng_project_user_permission->getSfGuardPermissionId()) ?>"><?php echo $p1ng_project_user_permission->getSfGuardPermissionId() ?></a></td>
      <td><?php echo $p1ng_project_user_permission->getCreatedAt() ?></td>
      <td><?php echo $p1ng_project_user_permission->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('project_permission/new') ?>">New</a>

<?php slot('sidebar'); ?>
<div class="section">
  <h1>Generic</h1>
  <table>
    <tr><th>Project</th><td></td></tr>
    <tr><th>User</th><td></td></tr>
  </table>
</div>
<?php end_slot(); ?>
