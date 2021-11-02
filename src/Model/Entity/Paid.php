<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Paid extends Entity {
    protected $_accessible = [
        'id' => true,
        'title' => true,
        'slug' => true,
        'services' => true
    ];
}