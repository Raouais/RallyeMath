<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DeadlinesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DeadlinesTable Test Case
 */
class DeadlinesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DeadlinesTable
     */
    protected $Deadlines;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Deadlines',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Deadlines') ? [] : ['className' => DeadlinesTable::class];
        $this->Deadlines = $this->getTableLocator()->get('Deadlines', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Deadlines);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DeadlinesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
