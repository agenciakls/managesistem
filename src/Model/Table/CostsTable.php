<?php

declare(strict_types=1);



namespace App\Model\Table;



use Cake\ORM\Query;

use Cake\ORM\RulesChecker;

use Cake\ORM\Table;

use Cake\Validation\Validator;



/**

 * Costs Model

 *

 * @property \App\Model\Table\ExpensesTable&\Cake\ORM\Association\BelongsTo $Expenses

 *

 * @method \App\Model\Entity\Cost newEmptyEntity()

 * @method \App\Model\Entity\Cost newEntity(array $data, array $options = [])

 * @method \App\Model\Entity\Cost[] newEntities(array $data, array $options = [])

 * @method \App\Model\Entity\Cost get($primaryKey, $options = [])

 * @method \App\Model\Entity\Cost findOrCreate($search, ?callable $callback = null, $options = [])

 * @method \App\Model\Entity\Cost patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])

 * @method \App\Model\Entity\Cost[] patchEntities(iterable $entities, array $data, array $options = [])

 * @method \App\Model\Entity\Cost|false save(\Cake\Datasource\EntityInterface $entity, $options = [])

 * @method \App\Model\Entity\Cost saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])

 * @method \App\Model\Entity\Cost[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])

 * @method \App\Model\Entity\Cost[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])

 * @method \App\Model\Entity\Cost[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])

 * @method \App\Model\Entity\Cost[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])

 */

class CostsTable extends Table

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



        $this->setTable('costs');

        $this->setDisplayField('title');

        $this->setPrimaryKey('id');


        $this->belongsTo('Methods', [

            'foreignKey' => 'method_id',

            'joinType' => 'INNER',

        ]);

        $this->belongsTo('Expenses', [

            'foreignKey' => 'expense_id',

            'joinType' => 'INNER',

        ]);

        

        $this->belongsTo('Statuscosts', [

            'foreignKey' => 'statuscost_id',

            'joinType' => 'INNER',

        ]);

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

            ->integer('id')

            ->allowEmptyString('id', null, 'create');



        $validator

            ->scalar('title')

            ->maxLength('title', 255)

            ->requirePresence('title', 'create')

            ->notEmptyString('title');



        $validator

            ->scalar('detalhes')

            ->maxLength('detalhes', 1500)

            ->requirePresence('detalhes', 'create')

            ->notEmptyString('detalhes');



        $validator

            ->numeric('price')

            ->requirePresence('price', 'create')

            ->notEmptyString('price');

            

        return $validator;

    }



    /**

     * Returns a rules checker object that will be used for validating

     * application integrity.

     *

     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.

     * @return \Cake\ORM\RulesChecker

     */

    public function buildRules(RulesChecker $rules): RulesChecker

    {

        $rules->add($rules->existsIn(['expense_id'], 'Expenses'));

        $rules->add($rules->existsIn(['method_id'], 'Methods'));



        return $rules;

    }

}

