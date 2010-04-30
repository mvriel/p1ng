<style>
  div.admin_group
  {
    float: left;
    width: 150px;
    border: 1px solid silver;
    -moz-border-radius: 10px;
    padding: 5px;
    margin: 5px;
  }

  #content div.admin_group h1
  {
    text-align: center;
    margin: 0px;
    padding: 0px;
    border-bottom: 1px solid silver;
    font-size: 0.9em;
    font-family: Arial, sans-serif;
  }

  #content div.admin_group ul
  {
    margin: 0px;
    padding: 0px;
    padding-left: 20px;
  }
</style>

<div class="admin_group">
  <h1>User management</h1>
  <div align="center" style="padding: 10px 0px;">
    <img src="<?php echo image_path('icons/user64x64.png');?>" border="0" />
  </div>
  <ul>
    <li><a href="<?php echo url_for('sfGuardUser/index');?>">Users</a></li>
    <li><a href="<?php echo url_for('sfGuardGroup/index');?>">Groups</a></li>
    <li><a href="<?php echo url_for('sfGuardPermission/index');?>">Permissions</a></li>
  </ul>
</div>

<div class="admin_group">
  <h1>Project management</h1>
  <div align="center" style="padding: 10px 0px;">
    <img src="<?php echo image_path('icons/project64x64.png');?>" border="0" />
  </div>
  <ul>
    <li><a href="">Customers</a></li>
    <li><a href="<?php echo url_for('project/index');?>">Projects</a></li>
    <li><a href="<?php echo url_for('workflow/index');?>">Workflows</a></li>
  </ul>
</div>

<div class="admin_group">
  <h1>Settings</h1>
  <div align="center" style="padding: 10px 0px;">
    <img src="<?php echo image_path('icons/settings64x64.png');?>" border="0" />
  </div>
  <ul>
    <li><a href="">Status'</a></li>
    <li><a href="<?php echo url_for('field/index');?>">Custom Fields</a></li>
  </ul>
</div>

<div style="clear: both;"></div>