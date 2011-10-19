<div id="mailbox" data-role="page">
  <div data-role="header">
    <a href="#folders" data-icon="arrow-l" data-direction="reverse"><?php echo _("Back") ?></a>
    <h1 id="imp-mailbox-header">&nbsp;</h1>
    <?php if ($this->logout): ?>
    <a href="<?php echo $this->logout ?>" rel="external" data-theme="e" data-icon="delete"><?php echo _("Log out") ?></a>
    <?php endif ?>
  </div>
  <div data-role="content">
    <ul id="imp-mailbox-list" data-role="listview">
    </ul>
  </div>
  <div data-role="footer" class="ui-bar" data-position="fixed">
    <a href="#" class="imp-compose" data-role="button" data-icon="plus"><?php echo _("New Message") ?></a>
  </div>
</div>
