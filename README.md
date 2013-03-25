Authake
============

Authake is finally arrived to CakePHP 2.2.3 and is (another) solution to manage users and groups and their rights in a CakePHP platform, as well as their registration, email confirmation and password changing requests. It’s composed by a component, a plugin, and a helper.

Latest changed:
1. jQuery library update
2. Settings save and restore
3. Up & run with SQLite storage instead of mysql
4. Some little changes in interface

SQLite config:
// Add to database.php

	public $authake2 = array(
		'datasource' => 'Database/Sqlite',
		'database'   => '',
		'persistent' => false,
		'prefix'     => ''
	);

	function __construct() {
		$this->authake2['database'] = APP .DS. 'Plugin' .DS. 'Authake' .DS. 'SQLite' .DS. 'authake2.sqlite';
	}


For other documentation see
https://github.com/mtkocak/authake

