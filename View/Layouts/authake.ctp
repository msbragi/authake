<?php
/* SVN FILE: $Id: default.ctp 6296 2008-01-01 22:18:17Z phpnut $ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.cake.libs.view.templates.layouts
 * @since			CakePHP(tm) v 0.10.0.1076
 * @version			$Revision: 6296 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2008-01-01 16:18:17 -0600 (Tue, 01 Jan 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<!DOCTYPE html>
<head>
	<title>
		<?php echo $title_for_layout ?>
	</title>
	<?php
		echo $this->Html->charset();
		echo $this->Html->meta('icon');
        echo $this->Html->css('/authake/css/bootstrap.min');
        echo $this->Html->css('/authake/css/custom');
	    echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        
	?>
</head>
<body>
	<div id="container">
        <header></header>
		<div id="content">
			<?php
				if ($this->Session->check('Message.flash')):
					echo $this->Session->flash();
				endif;
			?>
			<?php echo $this->fetch('content'); ?>
		</div>
        <footer></footer>
	</div>
</body>
</html>
