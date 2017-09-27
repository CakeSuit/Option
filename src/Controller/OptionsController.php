<?php

namespace CakeSuit\Option\Controller;

use CakeSuit\Option\Controller\Traits\OptionsTrait;

/**
 * Options Controller
 *
 * @property \CakeSuit\Option\Model\Table\OptionsTable $Options
 *
 * @method \CakeSuit\Option\Model\Entity\Option[] paginate($object = null, array $settings = [])
 */
class OptionsController extends AppController
{
    use OptionsTrait;
}
