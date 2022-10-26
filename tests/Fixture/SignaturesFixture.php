<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SignaturesFixture
 */
class SignaturesFixture extends TestFixture
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
                'text' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
