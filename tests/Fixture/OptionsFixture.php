<?php
namespace CakeSuit\Option\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OptionsFixture
 *
 */
class OptionsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'opt_key' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'opt_value' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'opt_autoload' => ['type' => 'integer', 'length' => 1, 'null' => true, 'default' => 0, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'opt_key' => ['type' => 'unique', 'columns' => ['opt_key'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 'ac106825-8aef-4ca2-9c2a-5b3d63c3e0c7',
            'opt_key' => 'site_name',
            'opt_value' => 'CakeSuit/Option for CakePHP.',
            'opt_autoload' => 1
        ],
        [
            'id' => 'ac106825-8aef-4ca2-9c2a-5b3d63c3e0cb',
            'opt_key' => 'site_description',
            'opt_value' => 'Option for your website.',
            'opt_autoload' => 1
        ],
        [
            'id' => 'ac106825-8aef-4ca2-9c2a-5b33ed63c0cb',
            'opt_key' => 'google_analytics',
            'opt_value' => 'UA-XXXXXX',
            'opt_autoload' => 0
        ],
    ];
}
