<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Deadline;
use Authorization\IdentityInterface;

/**
 * Deadline policy
 */
class DeadlinePolicy
{
    /**
     * Check if $user can add Deadline
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Deadline $deadline
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Deadline $deadline)
    {
        return $user->isAdmin == 1;
    }

    /**
     * Check if $user can edit Deadline
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Deadline $deadline
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Deadline $deadline)
    {
        return $user->isAdmin == 1;
    }

    /**
     * Check if $user can delete Deadline
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Deadline $deadline
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Deadline $deadline)
    {
        return $user->isAdmin == 1;
    }

    /**
     * Check if $user can view Deadline
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Deadline $deadline
     * @return bool
     */
    public function canView(IdentityInterface $user, Deadline $deadline)
    {
        return true;
    }
}
