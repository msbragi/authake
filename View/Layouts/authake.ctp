<?php echo $this->Html->docType('html5'); ?>
	<head>
		<title>
			<?php echo $title_for_layout ?>
		</title>
		<?php
			echo $this->Html->charset();
			echo $this->Html->meta('icon');
			$this->Html->css('/authake/css/bootstrap.min', null, array('inline' => false));
			$this->Html->css('/authake/css/custom', null, array('inline' => false));
			$this->Html->script('Authake.jquery-latest', array('block' => 'script'));
			$this->Html->script('Authake.custom', array('block' => 'script'));
			$this->Html->script('Authake.bootstrap.min', array('block' => 'script'));
			$this->Html->script('Authake.html5shiv', array('block' => 'script'));

			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
		?>
	</head>
	<body>
		<header>
			<div class="navbar navbar-inverse navbar-fixed-top">
                <div class="navbar-inner">
                    <div class="container">
                        <a class="brand" href="#">Authake</a>
                        <ul class="nav pull-left">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Users <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Add User</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="icon-th-list"> </i> All Users</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Groups <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Add Group</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="icon-th-list"> </i> All Groups</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Rules <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Add Rule</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="icon-th-list"> </i> All Rules</a></li>
                                </ul>
                            </li>
</ul>

                      <ul class="nav pull-right">

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Profile <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </li>
                            <li class="divider-vertical"></li>
                            <li><a href="#"><i class="icon-comment icon-white"></i> Help</a></li>
                        </ul>                    
</div>
                </div>
            </div>
            
			<?php
				if ($this->Session->check('Message.flash')):
					echo $this->Session->flash();
				endif;
			?>
		</header>
		<div class="container">
			<?php echo $this->fetch('content'); ?>
		</div>
		<footer>
		</footer>
	</body>
</html>