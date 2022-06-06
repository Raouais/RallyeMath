<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EditionsFixture
 */
class EditionsFixture extends TestFixture
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
                'title' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'nbStudentMax' => 1,
                'nbStudentMin' => 1,
                'schoolYear' => 'Lorem ipsum dolor sit amet',
                'created' => '2022-06-06 07:25:40',
                'modified' => '2022-06-06 07:25:40',
            ],
        ];
        parent::init();
    }
}
