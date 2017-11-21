<?php

namespace Cakesuit\Option\Controller;

use Cakesuit\Option\Controller\Traits\OptionsTrait;

/**
 * Options Controller
 *
 * @property \Cakesuit\Option\Model\Table\OptionsTable $Options
 *
 * @method \Cakesuit\Option\Model\Entity\Option[] paginate($object = null, array $settings = [])
 */
class OptionsController extends AppController
{
    use OptionsTrait;
}
