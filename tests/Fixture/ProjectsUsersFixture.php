<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProjectsUsersFixture
 */
class ProjectsUsersFixture extends TestFixture
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
                'project_id' => 1,
                'user_id' => 1,
                'role' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
