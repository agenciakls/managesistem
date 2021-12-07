<?php
declare(strict_types=1);
namespace App\Model\Entity;
use Cake\ORM\Entity;
class Cost extends Entity {
    protected $_accessible = [
        'title' => true,
        'detalhes' => true,
        'price' => true,
        'date' => true,
        'seller_id' => true,
        'seller' => true,
        'expense_id' => true,
        'expense' => true,
        'method_id' => true,
        'method' => true,
        'statuscost_id' => true,
        'statuscost' => true,
    ];
}
