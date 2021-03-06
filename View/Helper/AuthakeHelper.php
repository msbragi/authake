<?php
/*
    This file is part of Authake.

    Author: Jérôme Combaz (jakecake/velay.greta.fr)
    Contributors:

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

class AuthakeHelper extends AppHelper {

    var $helpers = array('Session','Authake.Gravatar','Html');

    function getUserId() {
        return $this->Session->read('Authake.id');
    }

    function getUserEmail() {
        return $this->Session->read('Authake.email');
    }

    function getUserMenu() {

 	if($this->getLogin()){
		$output = '<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">'.
			$this->Gravatar->get_gravatar($this->getUserEmail(),18,'','',true).'&nbsp;'.
			$this->getLogin().'<b class="caret"></b></a>
			<ul class="dropdown-menu">
				<li><a href="'.$this->Html->url( array('controller'=>'user','action'=>'index')).'">Profile Settings</a></li>
				<li class="divider"></li>
				<li>'.$this->Html->link(__d('authake','Logout'), array('controller'=> 'user', 'action'=>'logout')).'</li>
			</ul>
		</li>';
		}
		else
		{
		$output = '<li>'.$this->Html->link(__d('authake','Login'), array('controller'=> 'user', 'action'=>'login')).'</li>';
		}
        return $output;
    }

    function isLogged() {
        return ($this->getUserId() !== null);
    }

    function getLogin() {
        return $this->Session->read('Authake.login');
    }

    function getGroupIds() {
        $gid = $this->Session->read('Authake.group_ids');
        return (empty($gid) ? array(0) : $gid);
    }

    function getGroupNames() {
        $gn = $this->Session->read('Authake.group_names');
        return (is_array($gn) ? $gn : array(__d('authake','Guest')));
    }

    function isMemberOf($gid) {
        return in_array($gid, $this->getGroupIds());
    }

    function isMemberOfGroup($gname, $case = false) {
    	if($case) {
    		return in_array($gname, $this->getGroupNames());
    	} else {
    		$a = $this->getGroupNames();
    		foreach( $a as $v ) {
    			$gname = strtolower($gname);
    			if($gname == strtolower($v)) {
    				return true;
    			}
    		}
    	}
    	return false;
    }

    // Function to check the access for the controller / action
    function isAllowed($url = "") {
        if (is_array($url)) {
    		$url = $this->cleanUrl($url) ;
    	}
    	$allow = false;
    	$rules = $this->Session->read('Authake.cacheRules');
    	if(@$rules) {
    		foreach( $rules as $data ) {
    			if(preg_match("/^({$data['Rule']['action']})$/i", $url, $matches)) {
    				$allow = (int) $data['Rule']['permission'];
    			}
    		}
    	}
    	return $allow;
    }

	private function cleanUrl($url) {
		$clurl = array_intersect_key($url, array("controller" => '', "action" => '', "prefix" => '', "admin" => ''));
		return Router::url($clurl + array("base" => false));
	}
}
	
?>