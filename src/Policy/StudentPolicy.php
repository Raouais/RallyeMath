<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Student;
use App\Model\Table\SchoolsTable;
use Authorization\IdentityInterface;
use Cake\Datasource\Exception\RecordNotFoundException;

/**
 * Student policy
 */
class StudentPolicy
{
    /**
     * Check if $user can add Student
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Student $student
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Student $student)
    {
        return !$user->isAdmin;
    }

    /**
     * Check if $user can edit Student
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Student $student
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Student $student)
    {
        return $this->isAuthorAndHasSchool($user,$student);
    }

    /**
     * Check if $user can delete Student
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Student $student
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Student $student)
    {
        return $this->isAuthorAndHasSchool($user,$student);
    }

    /**
     * Check if $user can view Student
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Student $student
     * @return bool
     */
    public function canView(IdentityInterface $user, Student $student)
    {
        return $this->isAuthorAndHasSchool($user,$student) || $user->isAdmin;
    }

    protected function isAuthorAndHasSchool(IdentityInterface $user, Student $student)
    {
        try{
            $schoolId = ((new SchoolsTable())->findByUserid($user->id)->firstOrFail())->id;
        } catch(RecordNotFoundException $e){
            return false;
        }

        return $student->schoolId === $schoolId;
    }
}
