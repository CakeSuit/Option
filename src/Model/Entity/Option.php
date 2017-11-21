<?php
namespace Cakesuit\Option\Model\Entity;

use Cake\ORM\Entity;
use Cake\Utility\Text;

/**
 * Option Entity
 *
 * @property string $id
 * @property string $opts_key
 * @property string $opts_value
 */
class Option extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'opt_key' => true,
        'opt_value' => true,
        'opt_autoload' => true
    ];

    /**
     * Format key to slugify type
     * @param $optKey
     * @return string
     */
    protected function _setOptKey($optKey)
    {
        $optKey = strip_tags($optKey);
        return Text::slug($optKey, '_');
    }
}
