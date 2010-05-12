<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $p1ng_project->getId() ?></td>
    </tr>
    <tr>
      <th>Code:</th>
      <td><?php echo $p1ng_project->getCode() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $p1ng_project->getName() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $p1ng_project->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $p1ng_project->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Deleted at:</th>
      <td><?php echo $p1ng_project->getDeletedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('project/edit?id='.$p1ng_project->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('project/index') ?>">List</a>
