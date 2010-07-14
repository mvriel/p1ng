<style>
  table.report
  {
    margin-top: -10px;
    border-collapse: collapse;
  }

  table.report th
  {
    background: #eeeeee;
    border-bottom: 1px solid silver;
  }

  table.report a
  {
    display: block;
  }

  table.report th a:HOVER
  {
    background: #dddddd;
  }

  table.report tbody tr:HOVER
  {
    background: #f3f3f3;
  }

</style>

<table class="report">
  <thead>
  <tr>
      <?php foreach($columns as $key => $column): ?>
        <th><a href="#" onclick="jQuery(this).parents('div.portlet-content').load('<?php echo url_for($action.'&order='.$key); ?>')"><?php echo $column; ?></a></th>
      <?php endforeach; ?>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pager->getResults() as $item): ?>
    <tr>
      <?php foreach($columns as $key => $column): ?>
        <td><a href="<?php echo url_for($target_action.'?id='.$item->getId()) ?>"><?php echo $item->$key; ?></a></td>
      <?php endforeach; ?>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php if ($pager->haveToPaginate()): ?>
  <div class="pagination">
    <a href="<?php echo url_for('issue/index') ?>?page=1">
      <img src="<?php echo image_path('first.png'); ?>" alt="First page" title="First page" />
    </a>

    <a href="<?php echo url_for('issue/index') ?>?page=<?php echo $pager->getPreviousPage() ?>">
      <img src="<?php echo image_path('previous.png'); ?>" alt="Previous page" title="Previous page" />
    </a>

    <?php foreach ($pager->getLinks() as $page): ?>
      <?php if ($page == $pager->getPage()): ?>
        <?php echo $page; ?>
      <?php else: ?>
        <a href="<?php echo url_for('issue/index'); ?>?page=<?php echo $page ?>"><?php echo $page ?></a>
      <?php endif; ?>
    <?php endforeach; ?>

    <a href="<?php echo url_for('issue/index') ?>?page=<?php echo $pager->getNextPage() ?>">
      <img src="<?php echo image_path('next.png'); ?>" alt="Next page" title="Next page" />
    </a>

    <a href="<?php echo url_for('issue/index') ?>?page=<?php echo $pager->getLastPage() ?>">
      <img src="<?php echo image_path('last.png'); ?>" alt="Last page" title="Last page" />
    </a>
  </div>
<?php endif; ?>
