<?php
/*
    This file is part of Authake.
    Author: Marco Sbragi
    Contributors:
    
    Persistent storage for settings
*/
App::uses('AuthakeAppModel', 'Authake.Model');
class Setting extends AuthakeAppModel {
	var $name = 'Setting';
	var $useTable = 'authake_settings';

}
?>