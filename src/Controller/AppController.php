<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

/**
 * Initialization hook method.
 *
 * Use this method to add common initialization code like loading components.
 *
 * @return void
 */
	public function initialize() {
		$this->loadComponent('Flash');
		$this->loadComponent('Auth', [
				'loginRedirect' => [
						'controller' => 'Orders',
						'action' => 'index'
				],
				'logoutRedirect' => [
						'controller' => 'Shops',
						'action' => 'select',
						
				]
		]);
	}

	public function beforeFilter(Event $event ) {
		
	//$this->Auth->allow(['index', 'view', 'select']);
	$counter = 0;
	if ($this->request->session()->read('Cart.Counter')) {
		$counter = $this->request->session()->read('Cart.Counter');
	}
	
	$this->set(compact('counter'));
	

	
	// Define your menu
	$menu = array(
			'main-menu' => array(
					array(
							'title' => 'Home',
							'url' => array('controller' => 'pages', 'action' => 'home'),
					),
					array(
							'title' => 'About Us',
							'url' => '/pages/about-us',
					),
			),
			'left-menu' => array(
					array(
							'title' => 'Item 1',
							'url' => array('controller' => 'items', 'action' => 'view', 1),
							'children' => array(
									array(
											'title' => 'Item 3',
											'url' => array('controller' => 'items', 'action' => 'view', 3),
									),
									array(
											'title' => 'Item 4',
											'url' => array('controller' => 'items', 'action' => 'view', 4),
									),
							)
					),
					array(
							'title' => 'Item 2',
							'url' => array('controller' => 'items', 'action' => 'view', 2),
					),
			),
	);
	
	// For default settings name must be menu
	$this->set(compact('menu'));
}
}
