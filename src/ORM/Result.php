<?php
/**
 * Created by Cakesuit.
 * Date: 16/09/2017
 * Time: 22:42
 */

namespace Cakesuit\Option\ORM;

use Cake\Utility\Inflector;
use InvalidArgumentException;

class Result
{
    /**
     * Holds all properties and their values for this entity
     *
     * @var array
     */
    protected $_properties = [];

    /**
     * Holds a cached list of getters/setters per class
     *
     * @var array
     */
    protected static $_accessors = [];


    /**
     * Initializes the internal properties of this entity out of the
     * keys in an array. The following list of options can be used:
     *
     * - useSetters: whether use internal setters for properties or not
     * - markClean: whether to mark all properties as clean after setting them
     * - markNew: whether this instance has not yet been persisted
     * - guard: whether to prevent inaccessible properties from being set (default: false)
     * - source: A string representing the alias of the repository this entity came from
     *
     * ### Example:
     *
     * ```
     *  $entity = new Entity(['id' => 1, 'name' => 'Andrew'])
     * ```
     *
     * @param array $properties hash of properties to set in this entity
     * @param array $options list of options to use when creating this entity
     */
    public function __construct(array $properties = [])
    {
        if (!empty($properties)) {
            $this->_properties = $properties;
        }
    }
    /**
     * Magic getter to access properties that have been set in this entity
     *
     * @param string $property Name of the property to access
     * @return mixed
     */
    public function &__get($property)
    {
        return $this->get($property);
    }

    /**
     * Returns whether this entity contains a property named $property
     * regardless of if it is empty.
     *
     * @param string $property The property to check.
     * @return bool
     * @see \Cake\ORM\Entity::has()
     */
    public function __isset($property)
    {
        return $this->has($property);
    }

    /**
     * Returns the value of a property by name
     *
     * @param string $property the name of the property to retrieve
     * @return mixed
     * @throws \InvalidArgumentException if an empty property name is passed
     */
    public function &get($property)
    {
        if (!strlen((string)$property)) {
            throw new InvalidArgumentException('Cannot get an empty property');
        }

        $value = null;
        $method = static::_accessor($property, 'get');

        if (isset($this->_properties[$property])) {
            $value =& $this->_properties[$property];
        }

        if ($method) {
            $result = $this->{$method}($value);

            return $result;
        }

        return $value;
    }

    /**
     * Returns whether this entity contains a property named $property
     * that contains a non-null value.
     *
     * ### Example:
     *
     * ```
     * $entity = new Entity(['id' => 1, 'name' => null]);
     * $entity->has('id'); // true
     * $entity->has('name'); // false
     * $entity->has('last_name'); // false
     * ```
     *
     * You can check multiple properties by passing an array:
     *
     * ```
     * $entity->has(['name', 'last_name']);
     * ```
     *
     * All properties must not be null to get a truthy result.
     *
     * When checking multiple properties. All properties must not be null
     * in order for true to be returned.
     *
     * @param string|array $property The property or properties to check.
     * @return bool
     */
    public function has($property)
    {
        foreach ((array)$property as $prop) {
            if ($this->get($prop) === null) {
                return false;
            }
        }

        return true;
    }

    /**
     * Genarate Array of properties
     * @return array
     */
    public function toArray()
    {
        return $this->_properties;
    }

    /**
     * Fetch accessor method name
     * Accessor methods (available or not) are cached in $_accessors
     *
     * @param string $property the field name to derive getter name from
     * @param string $type the accessor type ('get' or 'set')
     * @return string method name or empty string (no method available)
     */
    protected static function _accessor($property, $type)
    {
        $class = static::class;

        if (isset(static::$_accessors[$class][$type][$property])) {
            return static::$_accessors[$class][$type][$property];
        }

        if (!empty(static::$_accessors[$class])) {
            return static::$_accessors[$class][$type][$property] = '';
        }

        if ($class === 'Cake\ORM\Entity') {
            return '';
        }

        foreach (get_class_methods($class) as $method) {
            $prefix = substr($method, 1, 3);
            if ($method[0] !== '_' || ($prefix !== 'get' && $prefix !== 'set')) {
                continue;
            }
            $field = lcfirst(substr($method, 4));
            $snakeField = Inflector::underscore($field);
            $titleField = ucfirst($field);
            static::$_accessors[$class][$prefix][$snakeField] = $method;
            static::$_accessors[$class][$prefix][$field] = $method;
            static::$_accessors[$class][$prefix][$titleField] = $method;
        }

        if (!isset(static::$_accessors[$class][$type][$property])) {
            static::$_accessors[$class][$type][$property] = '';
        }

        return static::$_accessors[$class][$type][$property];
    }


    /**
     * Counter of properties
     * @return int Counter
     */
    public function count()
    {
        return count($this->_properties);
    }

    /**
     * Check if empty properties
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->_properties);
    }

    /**
     * Returns a string representation of this object in a human readable format.
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode($this, JSON_PRETTY_PRINT);
    }

    /**
     * Returns an array that can be used to describe the internal state of this
     * object.
     *
     * @return array
     */
    public function __debugInfo()
    {
        return $this->_properties;
    }
}