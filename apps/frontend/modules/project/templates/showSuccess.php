<?php
sfPortalHelper::getInstance()
    ->setColumns(2)
    ->addPortlet(0, 'News', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit')
    ->addPortlet(0, 'Assigned to me', get_component('issue', 'report', array('report' => 1)))
    ->addPortlet(1, 'Shopping', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit')
    ->render();
?>
<!--
<div class="column">
  <div class="portlet">
          <div class="portlet-header">Assigned to me</div>
          <div class="portlet-content">
            <?php include_component('issue', 'report', array('report' => 1)) ?>
          </div>
  </div>

  <div class="portlet">
          <div class="portlet-header">News</div>
          <div class="portlet-content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</div>
  </div>
</div>

<div class="column">
	<div class="portlet">
		<div class="portlet-header">Shopping</div>
		<div class="portlet-content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</div>
	</div>
</div>
-->
<div style="clear: both"></div>

<?php slot('sidebar'); ?>
<div class="section">
  <h1>Details</h1>
  <table>
    <tbody>
      <tr><th>Name:</th><td><?php echo $p1ng_project->getName() ?></td></tr>
      <tr><th>Code:</th><td><?php echo $p1ng_project->getCode() ?></td></tr>
    </tbody>
  </table>
</div>

<div class="section">
  <h1>Actions</h1>
  <a href="<?php echo url_for('project/index') ?>">Select another project</a><br />
  <a href="<?php echo url_for('issue/create') ?>">Create a new issue</a><br />
  <a href="<?php echo url_for('project/edit?id='.$p1ng_project->getId()) ?>">Edit project</a><br />
</div>
<?php end_slot(); ?>