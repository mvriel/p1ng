  <table width="100%" cellspacing="0" cellpadding="0" style="margin-left: 4px;">
    <tr>
      <td colspan="2" style="font-size: 80%; color: gray;padding-bottom: 4px;">
      <?php echo $p1ng_issue_log->getP1ngIssue() ?> - <?php echo Doctrine::getTable('sfGuardUser')->findOneById($p1ng_issue_log->getCreatedBy()) ?>
        <div style="float: right; padding-right: 8px;">
          <a href="#" onclick="jQuery('td.log-sidebar').toggle()">Details</a>
          <a href="<?php echo url_for('log/edit?id=' . $p1ng_issue_log->getId()) ?>">Edit</a>
          <a href="<?php echo url_for('log/delete?id=' . $p1ng_issue_log->getId()) ?>">Delete</a>
        </div>
      </td>
    </tr>
    <tr>
      <td><?php echo nl2br(trim(Markdown($p1ng_issue_log->getText()))) ?></td>
      <td class="log-sidebar" style="display: none; width: 250px; text-align: right; background-color: #eeeeee; font-size: 80%;">
        <table>
          <tr>
            <td>Created at:</td>
            <td><?php echo $p1ng_issue_log->getCreatedAt() ?><br /></td>
          </tr>
          <tr>
            <td>Created by:</td>
            <td><?php echo Doctrine::getTable('sfGuardUser')->find($p1ng_issue_log->getCreatedBy()) ?><br /></td>
          </tr>
          <tr>
            <td>Updated at:</td>
            <td><?php echo $p1ng_issue_log->getUpdatedAt() ?><br /></td>
          </tr>
          <tr>
            <td>Updated by:</td>
            <td><?php echo Doctrine::getTable('sfGuardUser')->find($p1ng_issue_log->getUpdatedBy()) ?><br /></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>