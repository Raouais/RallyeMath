<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Registration;
use App\Model\Table\RegistrationsTable;
use Authorization\IdentityInterface;

/**
 * Registration policy
 */
class RegistrationPolicy
{
    /**
     * Check if $user can add Registration
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Registration $registration
     * @return bool
     */

    public function canAdd(IdentityInterface $user, Registration $registration)
    {
        return !$user->isAdmin;
    }

    /**
     * Check if $user can edit Registration
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Registration $registration
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Registration $registration)
    {
        return $this->isAuthor($user,$registration) || $user->isAdmin;
    }

    /**
     * Check if $user can delete Registration
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Registration $registration
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Registration $registration)
    {
        return $this->isAuthor($user,$registration) || $user->isAdmin;
    }

    /**
     * Check if $user can view Registration
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Registration $registration
     * @return bool
     */
    public function canView(IdentityInterface $user, Registration $registration)
    {
        return $this->isAuthor($user,$registration) || $user->isAdmin;
    }

    protected function isAuthor(IdentityInterface $user, Registration $registration)
    {
        return $registration->userId === $user->id;
    }
}
