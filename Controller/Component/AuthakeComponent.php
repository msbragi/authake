<?php

/*
 This file is part of Authake.

Author: Jérôme Combaz (jakecake/velay.greta.fr)
Contributors: Mutlu Tevfik Kocak Since too long time, Do not forget Nick Chankov nchankov

Authake is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Authake is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
*/

class AuthakeComponent extends Component {
	var $components = array('Session', 'RequestHandler');
	var $_forward = null;
	var $_flashmessage = '';

	function initialize(Controller $controller) {
	}

	function __construct(ComponentCollection $collection, $settings = array()) {
		parent::__construct($collection, $settings);
	}

	function startup(Controller $controller = null) {
		if($this->Session->check('Authake.Settings')) {
			$settings = $this->Session->read('Authake.Settings');
		} else {
			$settings = $this->getSettings();
		}
		$this->storeSettings( $settings );
	}

	/*
	 * Store settings in Config
	 */
	function storeSettings($settings = array()) {
		Configure::write("Authake", $settings);
		$this->Session->write('Authake.Settings', $settings);
	}

	/*
	 * Get settings from DB
	 * if not found store default settings
	 */
	function getSettings( $id = 1 ) {
		App::import("Model", "Authake.Setting");
		$model = new Setting;
		$data = $model->read(null, $id);

		if($data && @$data['Setting']['data']) {
			$settings = json_decode($data['Setting']['data'], true);
		} else {
			$settings = $this->saveSettings(null, true);
		}
		if(!$settings) {
			$this->Session->setFlash(__d('authake','Error retrieving settings'), 'warning');
			return array();
		}
		return $settings;
	}

	/*
	 * Store settings Into DB
	 * $data an array of Setting['data']
	 * $reset boolean if you want to restore default setting
	 */
	function saveSettings($settings = array(), $reset = false) {
		App::import("Model", "Authake.Setting");
		$model = new Setting;
		if($reset) {
			$settings = $this->defaultSettings();
		}
		if(!$settings) {
			$this->Session->setFlash(__d('authake','Error settings array not valid'), 'error');
			return array();
		}

		$data = array(
			'id'   => 1,
			'name' => 'Default settings',
			'data' => json_encode($settings)
		);

		if(!$model->save($data)) {
			$this->Session->setFlash(__d('authake','Error save settings'), 'error');
			return array();
		}
		$this->Session->setFlash(__d('authake','Settings saved'), 'info');
		return $settings;
	}

	/*
	 * Set an array of default settings based on installation
	 */
	private function defaultSettings() {
		/**
		 * Base URL, used to insert the application URL in mails.
		 */

		$settings = array(
			'baseUrl'             => Router::url('/', true),   // set the application url
			'service'             => 'Authake',                // Name of the service i.e. "Super Authake"
			'loginAction'         => '/authake/user/login',    // Default login action
			'loggedAction'        => '/',                      // Default logged in action
			'sessionTimeout'      => (3600 * 24 * 7),          // Session timeout
			'defaultDeniedAction' => '/authake/user/denied',   // Denied action
			'rulesCacheTimeout'   => 300,                      // reload rules every seconds
			'systemEmail'         => 'noreply@example.com',    // System email
			'systemReplyTo'       => 'noreply@example.com',    // Replay address
			'passwordVerify'      => false,                    // Verify by confirmation link
			'registration'        => false,                    // User cannot register
			'defaultGroup'        => 1,                        // Default group for registered user
			'useDefaultLayout'    => true,                     // Use site layout for user controller
			'useEmailAsUsername'  => false,                    // Use email instead of login name
		);
		return $settings;
	}

	function beforeFilter(&$controller, $setting_id = 1) {
		//Getting vars
		$this->startup(&$controller, $setting_id);

		// get action path
		$path = $this->cleanUrl($controller->request->params);

		// check if 'pass' param included value and store it for returning after login
		if(isset($controller->request->params['pass'][0])) {
			$previousRecordId =  $controller->request->params['pass'][0];
		}

		// get login action
		$loginAction = $this->cleanUrl(Configure::read('Authake.loginAction'));

		// check session timeout
		$tm = Configure::read('Authake.sessionTimeout');
		if ($tm && $this->isLogged()) {
			$ts = $this->Session->read('Authake.timestamp');
			if ((time() - $ts) > $tm) {
				$this->logout();
				$this->Session->setFlash(__d('authake','Your session expired'), 'warning');
				if($this->RequestHandler->isAjax()) {
					echo __d('authake','Your session expired');
					die();
				} else {
					// check for previous record id via 'pass' parameter
					if(isset($previousRecordId)) {
						$this->setPreviousUrl($path, $previousRecordId);
					} else {
						$this->setPreviousUrl($path);
					}
					$controller->redirect($loginAction);
				}
			}
			$this->setTimestamp();
		}

		if (!$this->isAllowed($path)) { // check for permissions
			if($this->RequestHandler->isAjax()) {
				die();
			}
			if ($this->isLogged()) { // if denied & logged, write a message
				if ($this->_flashmessage) { // message from the rule (accept path in %s)
					$this->Session->setFlash(sprintf(__d('authake',$this->_flashmessage), $path), 'error');    // Set Flash message
				}
				$fw = $this->_forward ? $this->_forward : Configure::read('Authake.defaultDeniedAction');
				$controller->redirect($fw);
			} else { // if denied & not loggued, propose to log in
				if(isset($previousRecordId)) {
					$this->setPreviousUrl($path, $previousRecordId);
				} else {
					$this->setPreviousUrl($path);
				}
				$this->Session->setFlash(sprintf(__d('authake','You have to log in to access %s'), $path), 'warning');
				$controller->redirect($loginAction);
			}
			$this->_flashmessage = '';
		}
	}

	/**
	 * API functions
	 */
	function setPreviousUrl($url, $recordId = null) {
		$loginAction = $this->cleanUrl(Configure::read('Authake.loginAction'));
		if(!$this->RequestHandler->isAjax() && ($url != $loginAction)) {
			if($recordId) {
				$this->Session->write('Authake.previousUrl', $url . '/' . $recordId);
			} else {
				$this->Session->write('Authake.previousUrl', $url);
			}
		}
	}

	function getPreviousUrl($reset = false) {
		$gotoUrl = $this->Session->read('Authake.previousUrl');
		if($reset) {
			$this->setPreviousUrl(null);
		}
		return $gotoUrl;
	}

	function isLogged() {
		return ($this->getUserId() !== null);
	}

	function getLogin() {
		return $this->Session->read('Authake.login');
	}

	function getUserId() {
		return $this->Session->read('Authake.id');
	}

	function getUserEmail() {
		return $this->Session->read('Authake.email');
	}

	function getGroupIds() {
		$gid = $this->Session->read('Authake.group_ids');
		return (empty($gid) ? null : $gid); //If not logged in (or no groups - return null)
	}

	function getGroupNames() {
		$gn = $this->Session->read('Authake.group_names');
		return (is_array($gn) ? $gn : array(__d('authake','Guest')));
	}

	function isMemberOf($gid) {
		return in_array($gid, $this->getGroupIds());
	}

	function setTimestamp() {
		$ts = $this->Session->write('Authake.timestamp', time());
	}

	function login($user) {
		$this->Session->write('Authake', $user);
		$this->setTimestamp();
	}

	function logout() {
		$this->Session->delete('Authake');
	}

	function getRules($group_ids = null) {
		$force_reload = ($group_ids !== null); // Groups passed ?

		if(!$force_reload) { // If Not Groups passed check if valid time
			$force_reload = (time() - $this->Session->read('Authake.cacheRulesTime')) > Configure::read('Authake.rulesCacheTimeout');
		}

		if(!$force_reload) { // If valid time verify that we have valid data cached
			$cacheRules = $this->Session->read('Authake.cacheRules');
			$force_reload = empty($cacheRules);
		}

		if ($force_reload) {
			App::import("Model", "Authake.Rule");
			$rule = new Rule;
			$cacheRules = $rule->getRules(is_array($group_ids) ? $group_ids : $this->getGroupIds(), true); // use groups provided or take groups of the users

			if ($group_ids === null) { // cache only if no groups of user used
				$this->Session->write('Authake.cacheRules', $cacheRules);
				$this->Session->write('Authake.cacheRulesTime', time());
			}
		}

		return $cacheRules;
	}

	// Function to check the access for the controller / action
	function isAllowed($url = "", $group_ids = null) { // $checkStr: "/name/action/" $group_ids: check again thess groups
		$url = $this->cleanUrl($url) ;
		$allow = false;
		$rules = $this->getRules($group_ids);
		foreach ($rules as $data) {
			if (preg_match("/^({$data['Rule']['action']})$/i", $url, $matches)) {
				$allow = (int) $data['Rule']['permission']; //echo $allow.'=>'.$url.' ** '.$data['Rule']['action'];
				//The Enum database type has to be changed to boolean, False for deny, True for allow
				if ($allow == false) {
					$this->_forward = $data['Rule']['forward'];
					$this->_flashmessage = $data['Rule']['message'];
				} else {
					$allow = true;
				}
			}
		}
		return $allow;
	}

	function getActionsPermissions($group_ids) {
		//pr(getcwd());

		$controllers = $this->_getControllers();
		$rules = $this->getRules($group_ids);
		$actionsList = array();

		foreach ($controllers as $controller => $actions) {
			foreach ($actions as $k => $action) {
				$con = strtolower($controller);
				$permission = $this->_areGroupsAllowed("/{$con}/{$action}/", $rules);
				$actionsList[$controller][] = array('controller' => $con, 'action' => $action, 'permission' => $permission);
			}
		}

		return $actionsList;
	}

	function _getControllers($lowercase = false) {//http://www.cleverweb.nl/cakephp/list-all-controllers-in-cakephp-2/
		$aCtrlClasses = App::objects('controller');

		foreach ($aCtrlClasses as $controller) {
			if ($controller != 'AppController') {
				// Load the controller
				App::import('Controller', str_replace('Controller', '', $controller));


				// Load its methods / actions
				$aMethods = get_class_methods($controller);

				foreach ($aMethods as $method => $idx) {

					if ($method{0} == '_') {
						unset($aMethods[$idx]);
					}
				}

				// Load the ApplicationController (if there is one)
				App::import('Controller', 'AppController');
				$parentActions = get_class_methods('AppController');

				$controllers[$controller] = array_diff($aMethods, $parentActions);
			}
		}
		return $controllers;
	}

	// Function to check the access for the controller / action
	function _areGroupsAllowed($url = "", $rules) { // $checkStr: "/name/action/" $group_ids: check again thess groups
		$allow = false;
		foreach ($rules as $data) {
			if (preg_match("/{$data['Rule']['action']}/i", $url, $matches)) {
				$allow = $data['Rule']['permission'];
				if ($allow == false)
					$allow = false;
				else
					$allow = true;
			}
		}
		return $allow;
	}

	private function cleanUrl($url) {
		if(is_array($url)) {
			$url = array_intersect_key($url, array("controller" => '', "action" => '', "prefix" => '', "admin" => ''));
			$url = Router::url($url + array("base" => false));
		}
		return $url;
	}
}

?>
