<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DeadlinesFixture
 */
class DeadlinesFixture extends TestFixture
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
                'startdate' => '2022-06-06 07:46:48',
                'enddate' => '2022-06-06 07:46:48',
                'editionId' => 1,
                'isLimit' => 1,
                'created' => '2022-06-06 07:46:48',
                'modified' => '2022-06-06 07:46:48',
            ],
        ];
        parent::init();
    }
}
