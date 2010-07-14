<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('project_permission/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?sf_guard_user_id='.$form->getObject()->getSfGuardUserId().'&p1ng_project_id='.$form->getObject()->getP1ngProjectId().'&sf_guard_permission_id='.$form->getObject()->getSfGuardPermissionId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('project_permission/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'project_permission/delete?sf_guard_user_id='.$form->getObject()->getSfGuardUserId().'&p1ng_project_id='.$form->getObject()->getP1ngProjectId().'&sf_guard_permission_id='.$form->getObject()->getSfGuardPermissionId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <?php echo $form['p1ng_project_id']->renderRow() ?>
      <?php echo $form['sf_guard_user_id']->renderRow() ?>
      <?php echo $form['sf_guard_permission_id']->renderRow() ?>
    </tbody>
  </table>
</form>
