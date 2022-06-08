<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RegistrationsFixture
 */
class RegistrationsFixture extends TestFixture
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
                'team' => 'Lorem ipsum dolor sit amet',
                'isConfirm' => 1,
                'isFinalist' => 1,
                'editionId' => 1,
                'userId' => 1,
                'schoolId' => 1,
                'created' => '2022-06-08 20:33:29',
                'modified' => '2022-06-08 20:33:29',
            ],
        ];
        parent::init();
    }
}
