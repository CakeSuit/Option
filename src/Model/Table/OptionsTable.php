<?php

namespace CakeSuit\Option\Model\Table;

use CakeSuit\Option\Error\MissingKeysException;
use CakeSuit\Option\ORM\Result;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Options Model
 *
 * @method \CakeSuit\Option\Model\Entity\Option get($primaryKey, $options = [])
 * @method \CakeSuit\Option\Model\Entity\Option newEntity($data = null, array $options = [])
 * @method \CakeSuit\Option\Model\Entity\Option[] newEntities(array $data, array $options = [])
 * @method \CakeSuit\Option\Model\Entity\Option|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \CakeSuit\Option\Model\Entity\Option patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \CakeSuit\Option\Model\Entity\Option[] patchEntities($entities, array $data, array $options = [])
 * @method \CakeSuit\Option\Model\Entity\Option findOrCreate($search, callable $callback = null, $options = [])
 */
class OptionsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('options');
        $this->setDisplayField('opt_key');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->uuid('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('opt_key')
            ->requirePresence('opt_key', 'create')
            ->notEmpty('opt_key')
            ->add('opt_key', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('opt_value')
            ->allowEmpty('opt_value');

        $validator
            ->allowEmpty('opt_value');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['opt_key']));

        return $rules;
    }

    public function findAutoload(Query $query, array $options)
    {
        $options += [
            'toResult' => true,
        ];

        $res =  $query->where(['opt_autoload' => 1]);

        return $this->_formatData($res, $options);
    }

    public function findKeys(Query $query, array $options)
    {
        $options += [
            'toResult' => true,
            'keys' => []
        ];

        $keys = !empty($options['keys']) ? (array) $options['keys'] : null;

        if (!$keys) {
            throw new MissingKeysException(['widget' => 'finderKeys']);
        }

        $res =  $query->where(['opt_key IN' => $keys]);

        return $this->_formatData($res, $options);
    }

    /**
     * Format Data
     * @param array $array
     * @return Result
     */
    protected function _formatData($query, array $options = [])
    {
        if ($options['toResult']) {
            $res = $query
                ->combine('opt_key', 'opt_value')
                ->toArray();
            return new Result($res);
        }

        return $query;
    }
}
