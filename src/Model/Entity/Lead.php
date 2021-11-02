<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Lead extends Entity {
    protected $_accessible = [
        'date' => true,
        'number' => true,
        'situation_id' => true,
        'situation' => true,
    ];
}
