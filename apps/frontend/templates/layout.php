<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>
  <link rel="shortcut icon" href="/favicon.ico" />
<?php include_stylesheets() ?>
<?php include_javascripts() ?>
</head>
<body>

<div id="page">

  <div id="top">
    <img src="/images/banner-left.png" class="left" align="top"/>
  <?php if ($sf_user->isAuthenticated()): ?>
    <a href="<?php echo url_for('project/index'); ?>" title="Select another project">
      <img src="<?php echo image_path('icons/project24x24.png');?>" border="0" align="top" style="margin-top: 3px;" /> <?php echo (string)$sf_user->getProject(); ?>
    </a>

    <form id="search" style="display: inline" action="<?php echo url_for('issue/search');?>" method="get">
      <input type="text" name="query" class="text" /> <input type="submit" value="Search" />
    </form>
  <?php endif; ?>
  </div>

  <div id="menu">
  <?php if ($sf_user->isAuthenticated()): ?>
    <a href="<?php echo url_for('@homepage');?>" class="menuitem">Home</a>
    <a href="<?php echo url_for('project/index');?>" class="menuitem">Projects</a>
    <a href="<?php echo url_for('issue/index');?>" class="menuitem">Issues</a>
    <?php if ($sf_user->hasCredential('administration.read')): ?>
    <a href="<?php echo url_for('default/admin');?>" class="menuitem">Administration</a>
    <?php endif; ?>
    <a href="<?php echo url_for('@sf_guard_signout');?>" class="menuitem">Logout</a>
  <?php endif; ?>
  </div>

  <div id="banner"></div>

  <div id="sidebar">
    <?php echo get_slot('sidebar');?>
  </div>

  <div id="content">
    <?php if ($sf_user->hasFlash('error')): ?>
    <div class="error-box"><?php echo $sf_user->getFlash('error'); ?></div>
    <?php endif; ?>

    <?php if ($sf_user->hasFlash('notice')): ?>
    <div class="notice-box"><?php echo $sf_user->getFlash('error'); ?></div>
    <?php endif; ?>

    <?php echo $sf_content ?>
  </div>

  <div id="footer">
    P1ng version <?php echo sfConfig::get('app_version');?> |
    Icons are part of the
    <a href="http://www.everaldo.com">Crystal Project</a> and copyright of
    <a href="mailto:everaldo@everaldo.com">Everaldo Coelho</a>
  </div>

</div>
</body>
</html>
