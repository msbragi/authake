Authake
============

Authake is finally arrived to CakePHP 2.2.3 and is (another) solution to manage users and groups and their rights in a CakePHP platform, as well as their registration, email confirmation and password changing requests. It’s composed by a component, a plugin, and a helper.

<h3>Latest changed:</h3>
<ol>
<li>jQuery library update
<li>Settings save and restore
<li>Up & run with SQLite storage instead of mysql
<li>Some little changes in interface
</ol>
<p>
<h3>SQLite config:</h3>
// Add to database.php
</p>

	public $authake2 = array(
		'datasource' => 'Database/Sqlite',
		'database'   => '',
		'persistent' => false,
		'prefix'     => ''
	);

	function __construct() {
		$this->authake2['database'] = APP .DS. 'Plugin' .DS. 'Authake' .DS. 'SQLite' .DS. 'authake2.sqlite';
	}

<p>
For other documentation see
https://github.com/mtkocak/authake
</p>
