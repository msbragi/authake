<h3><?php echo sprintf(__d('authake','You requested a password change at %s'),  $service);?></h3>
<p><?php echo __d('authake','Following the link below you can change your password:');?></p>
<p><?php
$url = $this->Html->url(array('plugin'=>'authake', 'controller'=>'user', 'action'=>'pass', $code), true);
echo $this->Html->link(__d('authake','Click here to change your password'), $url);?>
</p>
<p><?php echo sprintf(__d('authake','Verification code: %s'), $code);?></p>
<p><?php echo __d('authake',"If you don't request this change, no action is required. Your password will remain the same until you don't activate this code.");?></p>
<p><?php echo __d('authake','Best regards');?><br/><?php echo $service;?></p>