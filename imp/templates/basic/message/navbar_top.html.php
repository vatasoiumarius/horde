<form method="post" id="messages" name="messages" action="<?php echo $this->message_url ?>">
 <?php echo $this->hiddenFieldTag('targetMbox') ?>
 <?php echo $this->hiddenFieldTag('actionID') ?>
 <?php echo $this->hiddenFieldTag('buid', $this->buid) ?>
 <?php echo $this->hiddenFieldTag('message_token', $this->message_token) ?>
 <?php echo $this->hiddenFieldTag('mailbox', $this->mailbox) ?>
 <?php echo $this->hiddenFieldTag('start', $this->start) ?>
 <?php echo $this->hiddenFieldTag('newMbox') ?>
 <?php echo $this->hiddenFieldTag('flag') ?>
