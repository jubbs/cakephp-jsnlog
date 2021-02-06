<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * JsnLogs Model
 *
 * @method \App\Model\Entity\JsnLog get($primaryKey, $options = [])
 * @method \App\Model\Entity\JsnLog newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\JsnLog[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\JsnLog|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\JsnLog saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\JsnLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\JsnLog[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\JsnLog findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class JsnLogsTable extends Table
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

        $this->setTable('jsn_logs');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('l')
            ->maxLength('l', 45)
            ->allowEmptyString('l');

        $validator
            ->scalar('message')
            ->maxLength('message', 16777215)
            ->allowEmptyString('message');

        $validator
            ->scalar('name')
            ->maxLength('name', 45)
            ->allowEmptyString('name');

        $validator
            ->scalar('stamp')
            ->maxLength('stamp', 45)
            ->allowEmptyString('stamp');

        $validator
            ->scalar('u')
            ->maxLength('u', 45)
            ->allowEmptyString('u');

        return $validator;
    }
}
