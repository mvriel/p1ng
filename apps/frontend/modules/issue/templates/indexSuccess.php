<h1>Issues</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Subject</th>
      <th align="right">Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($p1ng_issues as $p1ng_issue): ?>
    <tr>
      <td><a href="<?php echo url_for('issue/show?id='.$p1ng_issue->getId()) ?>"><?php echo $p1ng_issue; ?></a></td>
      <td width="100%"><a href="<?php echo url_for('issue/show?id='.$p1ng_issue->getId()) ?>"><?php echo $p1ng_issue->getSubject() ?></a></td>
      <td style="white-space: nowrap; text-align: right"><?php echo format_datetime($p1ng_issue->getUpdatedAt()) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php slot('right-sidebar');?>
<div class="section">
  <h1>Actions</h1>
  <a href="<?php echo url_for('issue/new') ?>">Create new issue</a>
</div>
<?php end_slot(); ?>