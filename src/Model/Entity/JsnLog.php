<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * JsnLog Entity
 *
 * @property int $id
 * @property string|null $l
 * @property string|null $message
 * @property string|null $name
 * @property string|null $stamp
 * @property string|null $u
 * @property \Cake\I18n\FrozenTime|null $created
 */
class JsnLog extends Entity
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
        'l' => true,
        'message' => true,
        'name' => true,
        'stamp' => true,
        'u' => true,
        'created' => true,
    ];
}
