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
        $this->get('/cakesuit/options');
        $this->assertResponseOk();

        $options = $this->Options->find('autoload');
        $this->assertEquals(2, $options->count());

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
        $this->get('cakesuit/options/view/ac106825-8aef-4ca2-9c2a-5b3d63c3e0c7');
        $this->assertResponseOk();
    }

    public function testViewNotFound()
    {
        $this->get('cakesuit/options/view/1');
        $this->assertResponseError();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->get('cakesuit/options/add');
        $this->assertResponseOk();
        $this->assertResponseContains('option');

        $this->post('cakesuit/options/add', [
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
        $this->get('cakesuit/options/edit/ac106825-8aef-4ca2-9c2a-5b3d63c3e0c7');
        $this->assertResponseOk();
        $this->assertResponseContains('option');

        $this->post('cakesuit/options/edit/ac106825-8aef-4ca2-9c2a-5b3d63c3e0c7', [
            'opt_value' => 'My new web site'
        ]);

        $this->assertRedirect(['plugin' => 'CakeSuit/Option', 'controller' => 'Options', 'action' => 'index']);

        $this->put('cakesuit/options/edit/ac106825-8aef-4ca2-9c2a-5b3d63c3e0c7', [
            'opt_autoload' => 1
        ]);

        $this->assertRedirect(['plugin' => 'CakeSuit/Option', 'controller' => 'Options', 'action' => 'index']);

        $this->post('cakesuit/options/edit/ac106825-8aef-4ca2-9c2a-5b3d63c3e0c7', [
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
        $this->delete('cakesuit/options/delete/ac106825-8aef-4ca2-9c2a-5b3d63c3e0c7');
        $this->assertRedirect(['plugin' => 'CakeSuit/Option', 'controller' => 'Options', 'action' => 'index']);
    }
}
