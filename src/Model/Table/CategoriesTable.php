<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Categories Model
 */
class CategoriesTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('categories');
		$this->displayField('name');
		$this->primaryKey('id');
		$this->addBehavior('Tree');
		$this->belongsTo('ParentCategories', [
			'alias' => 'ParentCategories',
			'className' => 'Categories',
			'foreignKey' => 'parent_id'
		]);
		$this->belongsTo('Shops', [
			'alias' => 'Shops',
			'foreignKey' => 'shop_id'
		]);
		$this->hasMany('ChildCategories', [
			'alias' => 'ChildCategories',
			'className' => 'Categories',
			'foreignKey' => 'parent_id'
		]);
		$this->hasMany('Products', [
			'alias' => 'Products',
			'foreignKey' => 'category_id'
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
			->add('parent_id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('parent_id')
			->requirePresence('name', 'create')
			->notEmpty('name')
			->add('shop_id', 'valid', ['rule' => 'numeric'])
			->requirePresence('shop_id', 'create')
			->notEmpty('shop_id');

		return $validator;
	}

}
