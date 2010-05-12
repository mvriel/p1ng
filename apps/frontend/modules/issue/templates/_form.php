<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('issue/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['p1ng_project_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['p1ng_project_id']->renderError() ?>
          <?php echo $form['p1ng_project_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['subject']->renderLabel() ?></th>
        <td>
          <?php echo $form['subject']->renderError() ?>
          <?php echo $form['subject'] ?>
        </td>
      </tr>
	<?php foreach ($form['custom'] as $custom): ?>
	  <?php if (!$custom->isHidden()) echo $custom->renderRow() ?>
	<?php endforeach; ?>
    </tbody>
  </table>
</form>

<?php slot('right-sidebar'); ?>
<div class="section">
  <h1>Actions</h1>
  <?php if (!$form->getObject()->isNew()): ?>
  <a href="<?php echo url_for('issue/show?id='.$form->getObject()->getId()) ?>">Back</a><br />
  <?php echo link_to('Delete', 'issue/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?><br />
  <?php else: ?>
  <a href="<?php echo url_for('issue/index') ?>">Back to overview</a><br />
  <?php endif; ?>
</div>
<?php end_slot(); ?>