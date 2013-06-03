<div id="authake">
	<div class="confirmregister form">
		<?php echo $this->Form->create(null, array('url' => array('controller' => 'user', 'action'=>'pass')));?>
		<fieldset>
			<legend>
				<?php __d('authake','Change your password');?>
			</legend>
			<?php
			echo $this->Form->input('passwordchangecode', array('label'=>__d('authake','Code'), 'size'=>'40'));
			echo $this->Form->input('password1', array('size'=>'40', 'type'=>'password'));
			echo $this->Form->input('password2', array('size'=>'40', 'type'=>'password'));
			?>
		</fieldset>
		<?php echo $this->Form->end(__d('authake','Confirm'));?>
	</div>
</div>
