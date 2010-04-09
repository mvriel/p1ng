<h1>P1ng customers List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Code</th>
      <th>Name</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Deleted at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($p1ng_customers as $p1ng_customer): ?>
    <tr>
      <td><a href="<?php echo url_for('project/show?id='.$p1ng_customer->getId()) ?>"><?php echo $p1ng_customer->getId() ?></a></td>
      <td><?php echo $p1ng_customer->getCode() ?></td>
      <td><?php echo $p1ng_customer->getName() ?></td>
      <td><?php echo $p1ng_customer->getCreatedAt() ?></td>
      <td><?php echo $p1ng_customer->getUpdatedAt() ?></td>
      <td><?php echo $p1ng_customer->getDeletedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('project/new') ?>">New</a>
