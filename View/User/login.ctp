<div id="authake">
	<div class="login form">
		<?php echo $this->Form->create(null, array('url' => array('controller' => 'user', 'action'=>'login')));?>
		<fieldset>
			<?php
			echo $this->Form->input('login', array('label'=>__d('authake','Login'), 'size'=>'14'));
			echo $this->Form->input('password', array('label'=>__d('authake','Password'), 'value' => '', 'size'=>'14'));
			?>
		</fieldset>
		<?php echo $this->Form->end(__d('authake','Login'))  ?>
		<?php if(Configure::read('Authake.registration') == true){?>
		<p class="lostpassword" style="margin-left: 16em;">
			<?php echo $this->Html->link(__d('authake',"I forgot my password..."), array('action'=>'lost_password'))."<br/>"; ?>
		</p>
		<p class="register" style="margin-left: 16em;">
			<?php echo $this->Html->link(__d('authake',"Register yourself"), array('action'=>'register'))."<br/>"; ?>
		</p>
		<?php };?>
	</div>
</div>
