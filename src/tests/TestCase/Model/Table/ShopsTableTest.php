<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ShopsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ShopsTable Test Case
 */
class ShopsTableTest extends TestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = [
		'Shops' => 'app.shops',
		'Users' => 'app.users',
		'Orders' => 'app.orders',
		'Orderitems' => 'app.orderitems',
		'Products' => 'app.products'
	];

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$config = TableRegistry::exists('Shops') ? [] : ['className' => 'App\Model\Table\ShopsTable'];
		$this->Shops = TableRegistry::get('Shops', $config);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Shops);

		parent::tearDown();
	}

/**
 * Test initialize method
 *
 * @return void
 */
	public function testInitialize() {
		$this->markTestIncomplete('Not implemented yet.');
	}

/**
 * Test validationDefault method
 *
 * @return void
 */
	public function testValidationDefault() {
		$this->markTestIncomplete('Not implemented yet.');
	}

}
