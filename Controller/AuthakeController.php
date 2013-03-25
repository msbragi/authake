<?php
/*
 This file is part of Authake.

Author: Jérôme Combaz (jakecake/velay.greta.fr)
Contributors: Mutlu Tevfik Kocak (mtkocak.net)
			  Marco Sbragi (h2o.nospace.net)

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
class AuthakeController extends AuthakeAppController {
	var $uses = array('Authake.Setting', 'Authake.User','Authake.Rule','Authake.Group');// needed as we don't have any model

	function index() {
		$this->set('title_for_layout', 'Authake User & Group Management');
		$admins = $this->Group->find('all', array('conditions'=>array('name'=>'Administrators')));
		$adminCount = sizeof($admins[0]['User']);
		$userCount = $this->User->find('count');
		$groupCount = $this->Group->find('count');
		$ruleCount = $this->Rule->find('count');
		$this->set(compact('adminCount','userCount','groupCount','ruleCount'));
	}

	function help() {
		$this->set('title_for_layout', 'Help for Authake');
	}

	function settings(){
		if (!empty($this->request->data['Settings'])) {
			$settings = $this->Authake->saveSettings($this->request->data['Settings']);
			$this->Authake->storeSettings($settings);
		}
		$configs = Configure::read('Authake');
		$this->set(compact('configs'));// fix permissions dropdown menu
	}

	function reset(){
		$settings = $this->Authake->saveSettings(null, true);
		$this->Authake->storeSettings($settings);
		$this->redirect(array('action' => 'settings'));
	}
}
?>