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
	<div id="banner">
		<img id="logo" src="<?php echo image_path('logo.png');?>" border="0" alt="Logo" />
		<div id="search">
			<a href="<?php echo url_for('issue/new');?>"><img src="<?php echo image_path('icons/create_issue.png')?>" border="0" title="Create issue" alt="Create Issue" /></a>
			<form action="<?php echo url_for('issue/index')?>" method="get">
				<input type="text" name="search" size="16" /><input type="submit" value="Search" />
			</form>
		</div>
		<div id="menu">
			&nbsp;
			<?php if ($sf_user->isAuthenticated()):?>
			<span class="bg">
				<a href="<?php echo url_for('@homepage');?>">Home</a>
				<a href="<?php echo url_for('project/index');?>">Projects</a>
				<a href="<?php echo url_for('issue/index');?>">Issues</a>
				<a href="<?php echo url_for('@sf_guard_signout');?>">Logout</a>
			</span>
			<span class="bg">
				Administration:
				<a href="<?php echo url_for('field/index');?>">Fields</a>
			</span>
			<?php endif; ?>
		</div>
	</div>
	
	<?php if (has_slot('right-sidebar')):?>
	<div id="right-sidebar">
		<?php echo get_slot('right-sidebar');?>
	</div>
	<?php endif;?>
	
	<div id="content" class="<?php if (has_slot('right-sidebar')):?>has-right-sidebar<?php endif;?>">
    	<?php echo $sf_content ?>
    </div>
  </body>
</html>