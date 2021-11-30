<?php
declare(strict_types=1);
namespace App\Model\Entity;
use Cake\ORM\Entity;

class Service extends Entity {
    protected $_accessible = [
        'date' => true,
        'date_end' => true,
        'title' => true,
        'price' => true,
        'weight' => true,
        'observation' => true,
        'method_id' => true,
        'method' => true,
        'paid_id' => true,
        'paid' => true,
        'seller_id' => true,
        'seller' => true,
        'client_id' => true,
        'client' => true,
    ];
}
