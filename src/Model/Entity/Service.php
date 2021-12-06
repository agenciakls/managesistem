<?php
declare(strict_types=1);
namespace App\Model\Entity;
use Cake\ORM\Entity;

class Service extends Entity {
    protected $_accessible = [
        'date' => true,
        'delivery' => true,
        'date_end' => true,
        'price' => true,
        'distributor' => true,
        'representative' => true,
        'weight' => true,
        'observation' => true,
        'pack_id' => true,
        'pack' => true,
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
