<?php $this->Html->addCrumb('Edit User', $this->Html->url( null, true )); ?>
<div id="content">
	<div class="container">
		<div class="section">
			<div class="section-header">
				<h3>
					Modify User
					<?php echo $this->data['User']['login']; ?>
				</h3>
				<div class="section-actions">
					<?php echo $this->Html->link(__d('authake','View user'), array('action'=>'view', $this->Form->value('User.id')), array('class'=>'btn btn-primary'));?>
					<a
						href="<?php echo $this->Html->url( array('controller'=> 'users', 'action'=>'index')); ?>"
						class="btn btn-link">Cancel</a>
					<?php echo $this->Html->link(__d('authake','Delete'), array('action'=>'delete', $this->Form->value('User.id')), array('class'=>'btn btn-danger'), sprintf(__d('authake','Are you sure you want to delete @%s?'), $this->Form->value('User.login'))); ?>
				</div>
			</div>
			<div class="section-body">
				<?php echo $this->Form->create('User');?>
				<div class="form-horizontal">
					<fieldset class="inputs">
						<legend>User Information</legend>
						<?php echo $this->Form->input('id');?>
						<div class="string control-group stringish" id="ExternalId">
							<?php echo $this->Form->input('external_id', array('type' => 'text', 'label'=>array('text'=>__d('authake','Id to external data'),'class'=>'control-label'),'style'=>'width: 15em;', 'between'=>'<div class="controls">', 'after'=>'</div>'));?>
						</div>
						<div class="string control-group stringish" id="UserLogin">
							<?php echo $this->Form->input('login', array('type' => 'text', 'label'=>array('text'=>__d('authake','Login'),'class'=>'control-label'),'style'=>'width: 15em;', 'between'=>'<div class="controls">', 'after'=>'</div>'));?>
						</div>
						<div class="string control-group stringish" id="UserName">
							<?php echo $this->Form->input('name', array('type' => 'text', 'label'=>array('text'=>__d('authake','Name'),'class'=>'control-label'),'style'=>'width: 15em;', 'between'=>'<div class="controls">', 'after'=>'</div>'));?>
						</div>
						<div class="string control-group stringish" id="Group">
							<?php echo $this->Form->input('Group', array('label'=>array('text'=>__d('authake','In groups Press \'Control\' for multi-selection'),'class'=>'control-label'),'style'=>'width: 15em;', 'between'=>'<div class="controls">', 'after'=>'</div>', 'multiple' => true));?>
						</div>
						<div class="string control-group stringish" id="Email">
							<?php echo $this->Form->input('email', array('label'=>array('text'=>__d('authake','Email'),'class'=>'control-label'),'size'=>'40', 'between'=>'<div class="controls">', 'after'=>'<span class="help-inline">User\'s email address. Choose a real one. Confirmation goes to this email.</span></div>'));?>
						</div>
						<div class="string control-group stringish" id="Password">
							<?php echo $this->Form->input('password', array('label'=>array('text'=>__d('authake','Password (visible!)'),'class'=>'control-label'),'type'=>'text','value'=>'','size'=>'12' ,'between'=>'<div class="controls">', 'after'=>'</div>'));?>
						</div>
						<div class="string control-group stringish"
							id="PasswordChangeCode">
							<?php echo $this->Form->input('passwordchangecode', array('label'=>array('text'=>__d('authake','Password Change Code'),'class'=>'control-label'), 'between'=>'<div class="controls">', 'after'=>'<span class="help-inline">This is the code sent to User\'s email address at any password change</span></div>'));?>
						</div>
						<div class="string control-group stringish" id="EmailChangecode">
							<?php echo $this->Form->input('emailchangecode', array('label'=>array('text'=>__d('authake','Email Check Code'),'class'=>'control-label'), 'between'=>'<div class="controls">', 'after'=>'<span class="help-inline">This is the code sent to User\'s email address at to validate account</span></div>'));?>
						</div>
						<div class="string control-group stringish" id="ExpireAccount">
							<?php echo $this->Form->input('expire_account', array('type' => 'text', 'label'=>array('text'=>__d('authake','Account Expiry Date'),'class'=>'control-label'), 'between'=>'<div class="controls datepicker">', 'after'=>'</div>'));?>
						</div>
						<div class="string control-group stringish" id="Email">
							<div class="controls">
								<label class="checkbox"> <?php
								echo $this->Form->checkbox('disable');
								?> Disable User
								</label>
							</div>
						</div>
					</fieldset>
					<fieldset class="form-actions">
						<?php echo $this->Form->end(array('div'=>false,'label'=>'Edit','class'=>'action input-action btn btn-success'));?>
						<?php echo $this->Html->link(__d('authake','View user'), array('action'=>'view', $this->Form->value('User.id')), array('class'=>'btn btn-primary'));?>
						<a
							href="<?php echo $this->Html->url( array('controller'=> 'users', 'action'=>'index')); ?>"
							class="btn btn-link">Cancel</a>
						<?php echo $this->Html->link(__d('authake','Delete'), array('action'=>'delete', $this->Form->value('User.id')), array('class'=>'btn btn-danger'), sprintf(__d('authake','Are you sure you want to delete @%s?'), $this->Form->value('User.login'))); ?>
					</fieldset>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(function() {
	$(".datepicker input").datepicker({
		 changeMonth: true,
		 changeYear: true,
		 dateFormat: "yy-mm-dd"
	});
});
</script>
