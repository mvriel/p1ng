<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('project/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
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
        <th><?php echo $form['code']->renderLabel() ?></th>
        <td>
          <?php echo $form['code']->renderError() ?>
          <?php echo $form['code'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['p1ng_customer_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['p1ng_customer_id']->renderError() ?>
          <?php echo $form['p1ng_customer_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['name']->renderLabel() ?></th>
        <td>
          <?php echo $form['name']->renderError() ?>
          <?php echo $form['name'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>

<?php slot('sidebar'); ?>
<div class="section">
  <h1>Actions</h1>
  <a href="<?php echo url_for('project/index') ?>">Back to overview</a><br />
  <?php if (!$form->getObject()->isNew()): ?>
    <?php echo link_to('Delete', 'project/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
  <?php endif; ?>
</div>
<?php end_slot(); ?>