<?php slot('sidebar'); ?>
<div class="section">
  <h1>Actions</h1>
  <a href="<?php echo url_for('@sf_guard_user') ?>">Back to overview</a><br />
  <?php if (!$form->getObject()->isNew()): ?>
    <a href="<?php echo url_for('@project_permission?user='.$form->getObject()->getId()) ?>">Edit project permissions</a><br />
    <?php echo link_to('Delete', '@sf_guard_user_delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
  <?php endif; ?>
</div>
<?php end_slot(); ?>
