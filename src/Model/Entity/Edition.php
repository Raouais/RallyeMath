<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Edition Entity
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $nbStudentMax
 * @property int $nbStudentMin
 * @property string $schoolYear
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class Edition extends Entity
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
        'description' => true,
        'nbStudentMax' => true,
        'nbStudentMin' => true,
        'schoolYear' => true,
        'created' => true,
        'modified' => true,
    ];
}
