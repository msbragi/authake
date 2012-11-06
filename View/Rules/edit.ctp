<div id="authake">
<div class="actions menuheader">
    <ul>
        <li class="icon lock"><?php echo $this->Html->link(__('Manage rules'), array('action'=>'index'));?></li>
    </ul>
</div>
<div class="rules form">
<?php echo $this->Form->create('Rule');?>
	<fieldset>
 		<legend><?php __('Modify rule');?></legend>
	<?php
	    echo $this->Form->input('id');
		echo $this->Form->input('name', array('label'=>__('Description'), 'type'=>'textarea', 'cols'=>'50', 'rows'=>'2'));
		echo $this->Form->input('group_id', array('label'=>__('Group'), 'empty'=>true));
		echo $this->Form->input('order', array('label'=>__('Order')));
        echo $this->Form->input('action', array('label'=>__('Action<br/>(perl regex)'), 'type'=>'textarea', 'cols'=>'50', 'rows'=>'5'));
        echo $this->Form->select('permission', array('1' => 'Allow', '0' => 'Deny'), array('label'=>__('Permission'), 'empty'=>false, 'style'=>'width: 5em;','escape' => false));
        echo $this->Form->input('forward', array('label'=>__('Forward action on error')));
        echo $this->Form->input('message', array('label'=>__('Flash message on deny'), 'type'=>'textarea', 'cols'=>'50', 'rows'=>'2'));
	?>
	</fieldset>
<?php echo $this->Form->end('Modify');?>
</div>
<div class="actions">
	<ul>
        <li class="icon info"><?php echo $this->Html->link(__('View rule'), array('action'=>'view', $this->Form->value('Rule.id')));?></li>
		<li class="icon cross"><?php echo $this->Html->link(__('Delete'), array('action'=>'delete', $this->Form->value('Rule.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('Rule.id'))); ?></li>
	</ul>
</div>
</div>