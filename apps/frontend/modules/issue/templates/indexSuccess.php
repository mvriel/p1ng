<h1>P1ng issues List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Subject</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($p1ng_issues as $p1ng_issue): ?>
    <tr>
      <td><a href="<?php echo url_for('issue/show?id='.$p1ng_issue->getId()) ?>"><?php echo $p1ng_issue; ?></a></td>
      <td><a href="<?php echo url_for('issue/show?id='.$p1ng_issue->getId()) ?>"><?php echo $p1ng_issue->getSubject() ?></a></td>
      <td><?php echo $p1ng_issue->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('issue/new') ?>">New</a>
