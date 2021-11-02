<?php

declare(strict_types=1);



namespace App\Model\Table;



use Cake\ORM\Query;

use Cake\ORM\RulesChecker;

use Cake\ORM\Table;

use Cake\Validation\Validator;



class ServicesTable extends Table {



    public function initialize(array $config): void {

        parent::initialize($config);



        $this->setTable('services');

        $this->setDisplayField('title');

        $this->setPrimaryKey('id');



        $this->belongsTo('Clients', [

            'foreignKey' => 'client_id',

            'joinType' => 'INNER',

        ]);

        $this->belongsTo('Situations', [

            'foreignKey' => 'situation_id',

            'joinType' => 'INNER',

        ]);

        $this->belongsTo('Methods', [

            'foreignKey' => 'method_id',

            'joinType' => 'INNER',

        ]);

        $this->belongsTo('Paids', [

            'foreignKey' => 'paid_id',

            'joinType' => 'INNER',

        ]);

    }

    public function validationDefault(Validator $validator): Validator

    {

        $validator

            ->integer('id')

            ->allowEmptyString('id', null, 'create');



        $validator

            ->dateTime('date')

            ->requirePresence('date', 'create')

            ->notEmptyDateTime('date');



        $validator

            ->scalar('title')

            ->maxLength('title', 255)

            ->requirePresence('title', 'create')

            ->notEmptyString('title');



        $validator

            ->numeric('price')

            ->requirePresence('price', 'create')

            ->notEmptyString('price');

            

        $validator

            ->integer('technician_id');



        return $validator;

    }

    public function buildRules(RulesChecker $rules): RulesChecker

    {

        $rules->add($rules->existsIn(['client_id'], 'Clients'));

        $rules->add($rules->existsIn(['situation_id'], 'Situations'));



        return $rules;

    }

}