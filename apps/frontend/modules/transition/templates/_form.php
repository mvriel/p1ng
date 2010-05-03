<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('transition/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
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
        <th><?php echo $form['name']->renderLabel() ?></th>
        <td>
          <?php echo $form['name']->renderError() ?>
          <?php echo $form['name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['from_id']->renderLabel() ?></th>
        <td>
          <?php
            $choices = $form->getWidget('from_id')->getChoices();
            echo $choices[$form['from_id']->getValue()];
          ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['to_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['to_id']->renderError() ?>
          <?php echo $form['to_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['expression']->renderLabel() ?></th>
        <td>
          <?php echo $form['expression']->renderError() ?>
          <?php echo $form['expression'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>

<?php slot('right-sidebar'); ?>
<div class="section">
  <h1>Actions</h1>
  <a href="<?php echo url_for('workflow/show?id='.$form->getObject()->getP1ngWorkflowId()) ?>">Back to workflow</a><br />
  <?php if (!$form->getObject()->isNew()): ?>
    <?php echo link_to('Delete', 'transition/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?><br />
  <?php endif; ?>
</div>
<?php include_slot('right-sidebar'); ?>
<?php end_slot(); ?>