<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EditionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EditionsTable Test Case
 */
class EditionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EditionsTable
     */
    protected $Editions;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Editions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Editions') ? [] : ['className' => EditionsTable::class];
        $this->Editions = $this->getTableLocator()->get('Editions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Editions);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\EditionsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
