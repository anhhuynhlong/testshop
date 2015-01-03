<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Category Entity.
 */
class Category extends Entity {

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
	protected $_accessible = [
		'parent_id' => true,
		'name' => true,
		'description' => true,
		'shop_id' => true,
		'lft' => true,
		'rght' => true,
		'parent_category' => true,
		'shop' => true,

		'child_categories' => true,
		'products' => true,
			'parent_name' => true,
	];
	
	protected function _getParentName()
	{
		return $this->parent_category->name;
	}
}
