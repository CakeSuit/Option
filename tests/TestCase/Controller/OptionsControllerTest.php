<?php
namespace CakeSuit\Option\Test\TestCase\Controller;

use CakeSuit\Option\Controller\OptionsController;
use CakeSuit\Option\Model\Table\OptionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;

/**
 * CakeSuit\Option\Controller\OptionsController Test Case
 */
class OptionsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.CakeSuit/option.options'
    ];

    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Options') ? [] : ['className' => OptionsTable::class];
        $this->Options = TableRegistry::get('Options', $config);
    }


    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/CakeSuit/options');
        $this->assertResponseOk();

        $options = $this->Options->find('autoload');
        $this->assertEquals(1, $options->count());

        $options = $this->Options->find('keys', [
            'keys' => ['site_name', 'site_description']
        ]);
        $this->assertEquals(2, $options->count());
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('CakeSuit/options/view/ac106825-8aef-4ca2-9c2a-5b3d63c3e0c7');
        $this->assertResponseOk();
    }

    public function testViewNotFound()
    {
        $this->get('CakeSuit/options/view/1');
        $this->assertResponseError();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->get('CakeSuit/options/add');
        $this->assertResponseOk();
        $this->assertResponseContains('option');

        $this->post('CakeSuit/options/add', [
            'opt_key' => 'site__meta_description',
            'opt_value' => 'My new web site',
            'opt_autoload' => 1
        ]);
        $this->assertRedirect(['plugin' => 'CakeSuit/Option', 'controller' => 'Options', 'action' => 'index']);
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->get('CakeSuit/options/edit/ac106825-8aef-4ca2-9c2a-5b3d63c3e0c7');
        $this->assertResponseOk();
        $this->assertResponseContains('option');

        $this->post('CakeSuit/options/edit/ac106825-8aef-4ca2-9c2a-5b3d63c3e0c7', [
            'opt_value' => 'My new web site'
        ]);

        $this->assertRedirect(['plugin' => 'CakeSuit/Option', 'controller' => 'Options', 'action' => 'index']);

        $this->put('CakeSuit/options/edit/ac106825-8aef-4ca2-9c2a-5b3d63c3e0c7', [
            'opt_autoload' => 1
        ]);

        $this->assertRedirect(['plugin' => 'CakeSuit/Option', 'controller' => 'Options', 'action' => 'index']);

        $this->post('CakeSuit/options/edit/ac106825-8aef-4ca2-9c2a-5b3d63c3e0c7', [
            'opt_autoload' => 1
        ]);

        $this->assertRedirect(['plugin' => 'CakeSuit/Option', 'controller' => 'Options', 'action' => 'index']);
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->delete('CakeSuit/options/delete/ac106825-8aef-4ca2-9c2a-5b3d63c3e0c7');
        $this->assertRedirect(['plugin' => 'CakeSuit/Option', 'controller' => 'Options', 'action' => 'index']);
    }
}
