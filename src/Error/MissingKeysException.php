<?php
/**
 * Created by CakeSuit.
 * Date: 16/09/2017
 * Time: 22:05
 */

namespace Cakesuit\Option\Error;

use Cake\Core\Exception\Exception;

class MissingKeysException extends Exception
{
    protected $_messageTemplate = 'The keys is missing in %s';
}