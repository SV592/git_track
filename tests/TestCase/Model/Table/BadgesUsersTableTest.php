<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BadgesUsersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BadgesUsersTable Test Case
 */
class BadgesUsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BadgesUsersTable
     */
    protected $BadgesUsers;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.BadgesUsers',
        'app.Users',
        'app.Badges',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('BadgesUsers') ? [] : ['className' => BadgesUsersTable::class];
        $this->BadgesUsers = $this->getTableLocator()->get('BadgesUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->BadgesUsers);

        parent::tearDown();
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\BadgesUsersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
