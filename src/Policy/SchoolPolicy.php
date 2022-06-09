<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\School;
use Authorization\IdentityInterface;
use App\Model\Table\SchoolsTable;
/**
 * School policy
 */
class SchoolPolicy
{
    /**
     * Check if $user can add School
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\School $school
     * @return bool
     */
    public function canAdd(IdentityInterface $user, School $school)
    {
        return !(new SchoolsTable())->exists(['Schools.userId' => $user->id]) && !$user->isAdmin;
    }

    /**
     * Check if $user can edit School
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\School $school
     * @return bool
     */
    public function canEdit(IdentityInterface $user, School $school)
    {
        return $this->isAuthor($user,$school);
    }

    /**
     * Check if $user can delete School
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\School $school
     * @return bool
     */
    public function canDelete(IdentityInterface $user, School $school)
    {
        return $this->isAuthor($user,$school);
    }
    

    /**
     * Check if $user can view School
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\School $school
     * @return bool
     */
    public function canView(IdentityInterface $user, School $school)
    {
        return $this->isAuthor($user,$school) || $user->isAdmin;
    }

    protected function isAuthor(IdentityInterface $user, School $school)
    {
        return $school->userId === $user->id;
    }
}
