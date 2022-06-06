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
                'isConfirm' => 1,
                'isFinalist' => 1,
                'editionId' => 1,
                'created' => '2022-06-06 13:04:44',
                'modified' => '2022-06-06 13:04:44',
            ],
        ];
        parent::init();
    }
}
