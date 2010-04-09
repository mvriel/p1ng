<table width="100%" cellspacing="0" cellpadding="0" style="margin-left: 4px;">
<tr>
	<td colspan="2" style="font-size: 80%; color: gray;padding-bottom: 4px;">
		<?php echo $p1ng_issue_log->getP1ngIssue() ?> - <?php echo Doctrine::getTable('sfGuardUser')->findOneById($p1ng_issue_log->getCreatedBy()) ?>
		<div style="float: right; padding-right: 8px;">
			<a href="#">Details</a>
			<a href="<?php echo url_for('log/edit?id='.$p1ng_issue_log->getId()) ?>">Edit</a>
			<a href="<?php echo url_for('log/delete?id='.$p1ng_issue_log->getId()) ?>">Delete</a>
		</div>
	</td>
</tr>
<tr>
	<td><?php echo $p1ng_issue_log->getText() ?></td>
	<td class="log-sidebar" style="display: none;">
		<?php echo $p1ng_issue_log->getCreatedAt() ?><br />
		<?php echo $p1ng_issue_log->getUpdatedAt() ?><br />
		<?php echo $p1ng_issue_log->getDeletedAt() ?><br />
		<?php echo $p1ng_issue_log->getUpdatedBy() ?>
	</td>
</tr>
</table>