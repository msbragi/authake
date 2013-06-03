<div id="authake">
<?php echo $this->element('gotohomepage'); ?>
<div class="register form">
<?php echo $this->Form->create(null, array('url' => array('controller' => 'user', 'action'=>'register')));?>
	<fieldset>
 		<legend><?php __d('authake','Registration');?></legend>
<?php
        
    if ( ! Configure::read('Authake.useEmailAsUsername') ) echo $this->Form->input('login', array('label'=>__d('authake','Login'), 'size'=>'12')); 
    // do not show if we're using emails as usernames
    echo $this->Form->input('email', array('label'=>__d('authake','Email'), 'size'=>'40'));
    echo $this->Form->input('password1', array('type'=>'password', 'label'=>__d('authake','Password'), 'value' => '', 'size'=>'12'));
    echo $this->Form->input('password2', array('type'=>'password', 'label'=>__d('authake','Please, re-enter password'), 'value' => '', 'size'=>'12'));
        
    echo $this->Form->end(__d('authake','Register'));
?>
	</fieldset>
</div>
</div>




