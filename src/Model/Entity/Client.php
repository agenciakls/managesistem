<?php
declare(strict_types=1);
namespace App\Model\Entity;
use Cake\ORM\Entity;

class Client extends Entity
{

    protected $_accessible = [
        'nome' => true,
        'cpf' => true,
        'address' => true,
        'district' => true,
        'city' => true,
        'reference' => true,
        'cep' => true,
        'phone' => true,
        'email' => true,
        'status_id' => true,
        'status' => true,
        'services' => true,
    ];
}
