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