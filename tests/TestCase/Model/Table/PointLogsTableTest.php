<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PointLogsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PointLogsTable Test Case
 */
class PointLogsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PointLogsTable
     */
    protected $PointLogs;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.PointLogs',
        'app.Users',
        'app.Tasks',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('PointLogs') ? [] : ['className' => PointLogsTable::class];
        $this->PointLogs = $this->getTableLocator()->get('PointLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PointLogs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\PointLogsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\PointLogsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
