<div id="authake">
<div class="actions menuheader">
    <ul>
        <li class="icon lock"><?php echo $this->Html->link(__('Manage rules'), array('action'=>'index'));?></li>
    </ul>
</div>
<div class="rules form">
<?php echo $this->Form->create('Rule');?>
	<fieldset>
 		<legend><?php __('Add Rule');?></legend>
	<?php
        echo $this->Form->input('name', array('label'=>__('Description'), 'type'=>'textarea', 'cols'=>'50', 'rows'=>'2'));
        echo $this->Form->input('group_id', array('label'=>__('Group'), 'empty'=>true));
        echo $this->Form->input('order', array('label'=>__('Order')));
        echo $this->Form->input('action', array('label'=>__('Action<br/>(perl regex)'), 'type'=>'textarea', 'cols'=>'50', 'rows'=>'3'));
        echo $this->Form->select('permission', array('1' => 'Allow', '0' => 'Deny'), array('label'=>__('Permission'), 'empty'=>false, 'style'=>'width: 5em;','escape' => false));
        echo $this->Form->input('forward', array('label'=>__('Forward action on deny')));
        echo $this->Form->input('message', array('label'=>__('Flash message on deny'), 'type'=>'textarea', 'cols'=>'50', 'rows'=>'2'));
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
</div>
