<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Signatures Model
 *
 * @method \App\Model\Entity\Signature newEmptyEntity()
 * @method \App\Model\Entity\Signature newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Signature[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Signature get($primaryKey, $options = [])
 * @method \App\Model\Entity\Signature findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Signature patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Signature[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Signature|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Signature saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Signature[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Signature[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Signature[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Signature[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SignaturesTable extends Table
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

        $this->setTable('signatures');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->scalar('text')
            ->maxLength('text', 80)
            ->requirePresence('text', 'create')
            ->notEmptyString('text');

        return $validator;
    }
}
