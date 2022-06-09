<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Edition;
use Authentication\Identity;
use Authorization\IdentityInterface;

/**
 * Edition policy
 */
class EditionPolicy
{
    /**
     * Check if $user can add Edition
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Edition $edition
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Edition $edition)
    {
        return $user->isAdmin;
    }

    /**
     * Check if $user can edit Edition
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Edition $edition
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Edition $edition)
    {
        return $user->isAdmin;
    }

    /**
     * Check if $user can delete Edition
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Edition $edition
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Edition $edition)
    {
        return $user->isAdmin;
    }

    /**
     * Check if $user can view Edition
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Edition $edition
     * @return bool
     */
    public function canView(IdentityInterface $user, Edition $edition)
    {
        return true;
    }
}
