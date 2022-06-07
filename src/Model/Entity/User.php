<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $lastname
 * @property string $firstname
 * @property string $email
 * @property string $password
 * @property string $function
 * @property string $phone
 * @property string $civility
 * @property int|null $isAdmin
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class User extends Entity
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
        'lastname' => true,
        'firstname' => true,
        'email' => true,
        'password' => true,
        'function' => true,
        'phone' => true,
        'civility' => true,
        'isAdmin' => true,
        'created' => true,
        'modified' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected $_hidden = [
        'password',
    ];

    protected function _setPassword(string $password):?string {
        if(strlen($password) >= 4){
            $hasher = new DefaultPasswordHasher();
            return $hasher->hash($password);
        }
        return null;
    }
}
