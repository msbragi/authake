<h3><?php echo sprintf(__d('authake','Your e-mail verification at %s'),  $service);?></h3>
<p><?php echo __d('authake','You registered at our service.');?> <?php echo __d('authake','To ensure that this e-mail is valid, please follow this link:');?></p>
<p><?php
$url = $this->Html->url(array('plugin'=>'authake', 'controller'=>'user', 'action'=>'verify', $code), true);
echo $this->Html->link(__d('authake','Click here to verify'), $url);?>
</p>
<p><?php echo sprintf(__d('authake','Verification code: %s'), $code);?></p>
<p><?php echo __d('authake','Best regards');?><br/><?php echo $service;?></p>