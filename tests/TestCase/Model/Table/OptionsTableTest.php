<?php
namespace Cakesuit\Option\Test\TestCase\Model\Table;

use Cakesuit\Option\Error\MissingKeysException;
use Cakesuit\Option\Model\Table\OptionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * Cakesuit\Option\Model\Table\OptionsTable Test Case
 */
class OptionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Biscuit\Option\Model\Table\OptionsTable
     */
    public $Options;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.Cakesuit/option.options'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Options') ? [] : ['className' => OptionsTable::class];
        $this->Options = TableRegistry::get('Options', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Options);

        parent::tearDown();
    }

    /**
     * Test load all row autoloded
     * \ORM\Result Return an ORM Result Object
     */
    public function testFindAutoload()
    {
        $options = $this->Options->find('autoload');

        $this->assertEquals(2, $options->count());
    }

    /**
     *
     */
    public function testFindAutoloadInResultSet()
    {
        $options = $this->Options->find('autoload', ['toResult' => false]);
        $this->assertEquals(2, $options->count());

    }

    public function testFindKeys()
    {
        $options = $this->Options->find('keys', [
            'keys' => ['site_name', 'site_description']
        ]);

        $this->assertEquals(2, $options->count());
        $this->assertEquals(false, $options->isEmpty());
    }

    public function testHasKey()
    {
        $options = $this->Options->find('keys', [
            'keys' => ['site_name', 'site_description']
        ]);

        $this->assertEquals(true, $options->has('site_name'));
    }

    public function testHasNotKey()
    {
        $options = $this->Options->find('keys', [
            'keys' => ['site_name']
        ]);

        $this->assertEquals(false, $options->has('site_name_check_false'));
    }

    public function testFindWithMissingKey()
    {
        $this->expectException(MissingKeysException::class);
        $this->expectExceptionMessage('The keys is missing in finderKeys');
        $this->Options->find('keys');
    }

    public function testEmptyOptions()
    {
        $options = $this->Options->find('keys', [
            'keys' => ['site_names']
        ]);

        $this->assertEquals(true, $options->isEmpty());
    }

    public function testCountOptions()
    {
        $options = $this->Options->find('autoload');
        $this->assertEquals(2, $options->count());
    }

    public function testFormatOptKey()
    {
        $data = [
            'opt_key' => 'the test',
            'opt_value' => 'is passed'
        ];

        $opt = $this->Options->newEntity($data);
        $this->Options->save($opt);

        $option = $this->Options->find('keys', [
            'keys' => ['the_test']
        ]);
        $this->assertEquals('is passed', $option->the_test);
    }
}
