<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 */
class ProductsTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('products');
		$this->displayField('name');
		$this->primaryKey('id');
	}

/**
 * Default validation rules.
 *
 * @param \Cake\Validation\Validator $validator instance
 * @return \Cake\Validation\Validator
 */
	public function validationDefault(Validator $validator) {
		$validator
			->add('id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('id', 'create')
			->requirePresence('name', 'create')
			->notEmpty('name')
			->add('price', 'valid', ['rule' => 'numeric'])
			->requirePresence('price', 'create')
			->add('shop_id', 'valid', ['rule' => 'numeric'])
			->requirePresence('shop_id', 'create')
			->notEmpty('price')
			->requirePresence('image', 'create')
			->notEmpty('image');

		return $validator;
	}

}
