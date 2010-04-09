<h1>P1ng issue logs List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>P1ng issue</th>
      <th>Text</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Deleted at</th>
      <th>Created by</th>
      <th>Updated by</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($p1ng_issue_logs as $p1ng_issue_log): ?>
    <tr>
      <td><a href="<?php echo url_for('log/show?id='.$p1ng_issue_log->getId()) ?>"><?php echo $p1ng_issue_log->getId() ?></a></td>
      <td><?php echo $p1ng_issue_log->getP1ngIssueId() ?></td>
      <td><?php echo $p1ng_issue_log->getText() ?></td>
      <td><?php echo $p1ng_issue_log->getCreatedAt() ?></td>
      <td><?php echo $p1ng_issue_log->getUpdatedAt() ?></td>
      <td><?php echo $p1ng_issue_log->getDeletedAt() ?></td>
      <td><?php echo $p1ng_issue_log->getCreatedBy() ?></td>
      <td><?php echo $p1ng_issue_log->getUpdatedBy() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('log/new') ?>">New</a>
