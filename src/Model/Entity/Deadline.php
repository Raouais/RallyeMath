<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Deadline Entity
 *
 * @property int $id
 * @property string $title
 * @property \Cake\I18n\FrozenTime $startdate
 * @property \Cake\I18n\FrozenTime $enddate
 * @property int $editionId
 * @property bool $isLimit
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class Deadline extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'title' => true,
        'startdate' => true,
        'enddate' => true,
        'editionId' => true,
        'isLimit' => true,
        'created' => true,
        'modified' => true,
    ];
}
