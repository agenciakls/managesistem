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
        $this->setDisplayField('os');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
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

        $this->belongsTo('Packs', [
            'foreignKey' => 'pack_id',
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
        return $rules;
    }
}
