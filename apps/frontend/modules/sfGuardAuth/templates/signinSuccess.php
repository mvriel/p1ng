<h1>Sign in</h1>

<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
<?php echo $form->renderHiddenFields();?>
  <table>
    <?php echo $form['username']->renderRow(); ?>
    <?php echo $form['password']->renderRow(); ?>
    <tr><th></th><td><a href="<?php echo url_for('@sf_guard_password') ?>"><?php echo __('Forgot your password?') ?></a></td></tr>
    <?php echo $form['remember']->renderRow(); ?>
  </table>

  <input type="submit" value="<?php echo __('sign in') ?>" />
  
</form>
