<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\signature;
use Authorization\IdentityInterface;

/**
 * signature policy
 */
class signaturePolicy
{
    /**
     * Check if $user can add signature
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\signature $signature
     * @return bool
     */
    public function canAdd(IdentityInterface $user, signature $signature)
    {
        return false;
    }

    /**
     * Check if $user can edit signature
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\signature $signature
     * @return bool
     */
    public function canEdit(IdentityInterface $user, signature $signature)
    {
        return $user->isAdmin == 1;
    }

    /**
     * Check if $user can delete signature
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\signature $signature
     * @return bool
     */
    public function canDelete(IdentityInterface $user, signature $signature)
    {
        return false;
    }

    /**
     * Check if $user can view signature
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\signature $signature
     * @return bool
     */
    public function canView(IdentityInterface $user, signature $signature)
    {
        return $user->isAdmin == 1;
    }
}
