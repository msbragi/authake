<div id="authake">
<div class="users view">
<h2><?php  echo __d('authake','Profile of '); echo $user['User']['login'];?></h2>
    <dl><?php $i = 0; $class = ' class="altrow"';?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __d('authake','Login'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $user['User']['login']." <em>(ID {$user['User']['id']})</em>"; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __d('authake','Groups'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php
             
            $gr = array();
            foreach($user['Group'] as $group) $gr[] = $group['name'];
            if (empty($gr))
                echo __d('authake','Guest');
            else
                echo implode(", ", $gr); ?>  
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __d('authake','Created'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $this->Time->format('d/m/Y', $user['User']['created']); ?>
            &nbsp;
        </dd>
    </dl>

<?php echo $this->Form->create('User', array('url' => array('controller' => 'user', 'action'=>'index')));?>
<fieldset>
        <legend><?php echo __d('authake','Modify profile');?></legend>
    <?php
        echo $this->Form->input('email', array('value'=>$user['User']['email'], 'size'=>'40', 'after'=>'<p>'.__d('authake','(If modified, you will have to confirm it before the next login)').'</p>'));
        echo $this->Form->input('password1', array('type'=>'password', 'label'=> __d('authake','New Password') , 'value' => '', 'size'=>'12'));
        echo $this->Form->input('password2', array('type'=>'password',  'label'=> __d('authake','Enter Your New Password Again'), 'value' => '', 'size'=>'12'));
    ?>
</fieldset>
<?php echo $this->Form->end(__d('authake','Save'));?>

</div>
</div>