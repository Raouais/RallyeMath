<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Deadlines Model
 *
 * @method \App\Model\Entity\Deadline newEmptyEntity()
 * @method \App\Model\Entity\Deadline newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Deadline[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Deadline get($primaryKey, $options = [])
 * @method \App\Model\Entity\Deadline findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Deadline patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Deadline[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Deadline|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Deadline saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Deadline[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Deadline[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Deadline[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Deadline[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DeadlinesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('deadlines');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->dateTime('startdate')
            ->requirePresence('startdate', 'create')
            ->notEmptyDateTime('startdate');

        $validator
            ->dateTime('enddate')
            ->requirePresence('enddate', 'create')
            ->notEmptyDateTime('enddate');

        $validator
            ->integer('editionId')
            ->requirePresence('editionId', 'create')
            ->notEmptyString('editionId');

        $validator
            ->boolean('isLimit')
            ->requirePresence('isLimit', 'create')
            ->notEmptyString('isLimit');

        return $validator;
    }
}
