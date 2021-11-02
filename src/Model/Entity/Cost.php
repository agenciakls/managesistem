<?php

declare(strict_types=1);



namespace App\Model\Entity;



use Cake\ORM\Entity;



/**

 * Cost Entity

 *

 * @property int $id

 * @property string $title

 * @property string $detalhes

 * @property float $price

 * @property int $expense_id

 *

 * @property \App\Model\Entity\Expense $expense

 */

class Cost extends Entity

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

        'title' => true,

        'detalhes' => true,

        'price' => true,

        'date' => true,

        'expense_id' => true,

        'expense' => true,

        'method_id' => true,

        'method' => true,

        'statuscost_id' => true,

        'statuscost' => true,

    ];

}

