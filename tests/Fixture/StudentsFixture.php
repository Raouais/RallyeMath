<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * StudentsFixture
 */
class StudentsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'lastname' => 'Lorem ipsum dolor sit amet',
                'firstname' => 'Lorem ipsum dolor sit amet',
                'schoolId' => 1,
                'registrationId' => 1,
                'created' => '2022-06-06 13:10:57',
                'modified' => '2022-06-06 13:10:57',
            ],
        ];
        parent::init();
    }
}
