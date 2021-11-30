<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ExpensesTable extends Table {
    public function initialize(array $config): void {
        parent::initialize($config);

        $this->setTable('expenses');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->hasMany('Costs', [
            'foreignKey' => 'expense_id',
        ]);
    }
    public function validationDefault(Validator $validator): Validator {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 255)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug');

        return $validator;
    }
}