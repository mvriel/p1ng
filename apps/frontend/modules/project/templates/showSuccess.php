<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $p1ng_customer->getId() ?></td>
    </tr>
    <tr>
      <th>Code:</th>
      <td><?php echo $p1ng_customer->getCode() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $p1ng_customer->getName() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $p1ng_customer->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $p1ng_customer->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Deleted at:</th>
      <td><?php echo $p1ng_customer->getDeletedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('project/edit?id='.$p1ng_customer->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('project/index') ?>">List</a>
