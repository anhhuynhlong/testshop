<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Panels Controller
 *
 * @property \App\Model\Table\PanelsTable $Panels
 */
class PanelsController extends AppController {

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->set('panels', $this->paginate($this->Panels));
	}

/**
 * View method
 *
 * @param string|null $id Panel id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$panel = $this->Panels->get($id, [
			'contain' => []
		]);
		$this->set('panel', $panel);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$panel = $this->Panels->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->Panels->save($panel)) {
				$this->Flash->success('The panel has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The panel could not be saved. Please, try again.');
			}
		}
		$this->set(compact('panel'));
	}

/**
 * Edit method
 *
 * @param string|null $id Panel id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$panel = $this->Panels->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$panel = $this->Panels->patchEntity($panel, $this->request->data);
			if ($this->Panels->save($panel)) {
				$this->Flash->success('The panel has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The panel could not be saved. Please, try again.');
			}
		}
		$this->set(compact('panel'));
	}

/**
 * Delete method
 *
 * @param string|null $id Panel id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$panel = $this->Panels->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->Panels->delete($panel)) {
			$this->Flash->success('The panel has been deleted.');
		} else {
			$this->Flash->error('The panel could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}

}
