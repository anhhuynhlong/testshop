<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Shops Model
 */
class ShopsTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('shops');
		$this->displayField('name');
		$this->primaryKey('id');
		$this->belongsTo('Users', [
			'alias' => 'Users',
			'foreignKey' => 'user_id'
		]);
		$this->hasMany('Orders', [
			'alias' => 'Orders',
			'foreignKey' => 'shop_id'
		]);
		$this->hasMany('Products', [
			'alias' => 'Products',
			'foreignKey' => 'shop_id'
		]);
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
			
			->requirePresence('address', 'create')
			->notEmpty('address')
			->requirePresence('name', 'create')
			->notEmpty('name')
			->add('user_id', 'valid', ['rule' => 'numeric'])
			->requirePresence('user_id', 'create')
			->notEmpty('user_id')
			;

		return $validator;
	}

}
