<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Controller\Component\Helpers;

use Cake\Error\Debugger;
/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 */
class CategoriesController extends AppController {

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		
		//show categories for the logged in users
		$user_id = $this->Auth->user('id');
		$this->loadModel("Shops");
		$shops = $this->Shops->find('list')->where(['user_id' => $user_id]);
		$q = $this->Categories->find()->where(['shop_id' => array_keys($shops->toArray())], ['shop_id' => 'integer[]']);
		$parentCategories = $this->Categories->find('list')->toArray();
		//Debugger::dump($parentCategories);
		$this->set(compact('parentCategories', 'shops'));
		$this->set('categories', $this->paginate($q));
	}

/**
 * View method
 *
 * @param string|null $id Category id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$category = $this->Categories->get($id, [
			'contain' => ['ParentCategories', 'Shops', 'ChildCategories', 'Products']
		]);
		$this->set('category', $category);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		
		//get loggged user infor
		$user_id = $this->Auth->user('id');
		$category = $this->Categories->newEntity($this->request->data);
		
		if ($this->request->is('post')) {
						
			pr($this->request->data);
			if ($this->Categories->save($category)) {
				$this->Flash->success('The category has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The category could not be saved. Please, try again.');
			}
		}
	
		$shops = $this->Categories->Shops->find('list', ['limit' => 200])->where(['user_id' => $user_id]);
		$parentCategories = $this->Categories->find('list', ['limit' => 200])->where(['shop_id' => array_keys($shops->toArray())], ['shop_id' => 'integer[]']);
		
		$this->set(compact('category', 'parentCategories', 'shops'));
	}

/**
 * Edit method
 *
 * @param string|null $id Category id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$category = $this->Categories->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$category = $this->Categories->patchEntity($category, $this->request->data);
			if ($this->Categories->save($category)) {
				$this->Flash->success('The category has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The category could not be saved. Please, try again.');
			}
		}
		$user_id = $this->Auth->user('id');
		$shops = $this->Categories->Shops->find('list', ['limit' => 200])->where(['user_id' => $user_id]);
		$parentCategories = $this->Categories->find('list', ['limit' => 200])->where(['shop_id' => array_keys($shops->toArray())], ['shop_id' => 'integer[]']);
		
		//$parentCategories = $this->Categories->ParentCategories->find('list', ['limit' => 200]);
		//$shops = $this->Categories->Shops->find('list', ['limit' => 200]);
		$this->set(compact('category', 'parentCategories', 'shops'));
	}

/**
 * Delete method
 *
 * @param string|null $id Category id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$category = $this->Categories->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->Categories->delete($category)) {
			$this->Flash->success('The category has been deleted.');
		} else {
			$this->Flash->error('The category could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}

}
