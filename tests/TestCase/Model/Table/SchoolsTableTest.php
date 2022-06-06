<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SchoolsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SchoolsTable Test Case
 */
class SchoolsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SchoolsTable
     */
    protected $Schools;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Schools',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Schools') ? [] : ['className' => SchoolsTable::class];
        $this->Schools = $this->getTableLocator()->get('Schools', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Schools);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SchoolsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
