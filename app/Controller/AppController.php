<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */

/**
 * @property RequestHandlerComponent $RequestHandler
 * @property SessionComponent $Session
 * @property AuthComponent $Auth
 * @property SecurityComponent $Security
 * @property Dashboard $Dashboard
 */
class AppController extends Controller {
	public $layout = 'clean';
	public $components = array(		
		'RequestHandler',
		'Session',
//		'Auth' => array(
//			'loginRedirect' => array('controller' => 'posts', 'action' => 'index'),
//			'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
//		),
		'Auth' => array(
			'authenticate' => array(
				'Form' => array(
					'userModel' => 'User',
					'fields' => array(
						'username' => 'email',
						'password' => 'password'
					)
				)
			)
		),
		'Security'
	);
	
	public $helpers = array(
		'Form',
		'Html',
		'Js',
		'Time',
		'Session'
	);

	public function beforeFilter(){

		/*$this->Auth->authenticate = array('Form');
		$this->Auth->fields = array(
			'username' => 'email',
			'password' => 'password'
		);*/
		$this->loadModel('Dashboard');
		$this->Security->validatePost = false;
		
		$public_dashboards = $this->Dashboard->find('list', array(
			'conditions'	=> array(
				'is_public'	=> 1
			)
		));
		
		if($this->Auth->user('id')!==null){
			$user_dashboards = $this->Dashboard->find('list', array(
				'conditions'	=> array(
					'user_id'	=> $this->Auth->user('id')
				)
			));
			$this->set('dblist', array_merge($public_dashboards, $user_dashboards));
		} else {
			$this->set('dblist', $public_dashboards);
		}
	}
}
