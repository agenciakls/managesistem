<?php

declare(strict_types=1);



namespace App\Model\Entity;



use Cake\ORM\Entity;



/**

 * Client Entity

 *

 * @property int $id

 * @property string $nome

 * @property string $address

 * @property string $district

 * @property string $city

 * @property string $reference

 * @property string $phone

 * @property string $email

 * @property int $status_id

 *

 * @property \App\Model\Entity\Status $status

 * @property \App\Model\Entity\Service[] $services

 */

class Client extends Entity

{

    /**

     * Fields that can be mass assigned using newEntity() or patchEntity().

     *

     * Note that when '*' is set to true, this allows all unspecified fields to

     * be mass assigned. For security purposes, it is advised to set '*' to false

     * (or remove it), and explicitly make individual fields accessible as needed.

     *

     * @var array

     */

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

