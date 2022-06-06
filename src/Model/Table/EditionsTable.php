<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Editions Model
 *
 * @method \App\Model\Entity\Edition newEmptyEntity()
 * @method \App\Model\Entity\Edition newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Edition[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Edition get($primaryKey, $options = [])
 * @method \App\Model\Entity\Edition findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Edition patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Edition[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Edition|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Edition saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Edition[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Edition[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Edition[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Edition[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EditionsTable extends Table
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

        $this->setTable('editions');
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
            ->maxLength('title', 80)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->integer('nbStudentMax')
            ->requirePresence('nbStudentMax', 'create')
            ->notEmptyString('nbStudentMax');

        $validator
            ->integer('nbStudentMin')
            ->requirePresence('nbStudentMin', 'create')
            ->notEmptyString('nbStudentMin');

        $validator
            ->scalar('schoolYear')
            ->maxLength('schoolYear', 80)
            ->requirePresence('schoolYear', 'create')
            ->notEmptyString('schoolYear');

        return $validator;
    }
}
