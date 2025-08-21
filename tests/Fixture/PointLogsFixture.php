<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PointLogsFixture
 */
class PointLogsFixture extends TestFixture
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
                'user_id' => 1,
                'points_earned' => 1,
                'task_id' => 1,
                'reason' => 'Lorem ipsum dolor sit amet',
                'created' => '2025-08-21 02:19:49',
            ],
        ];
        parent::init();
    }
}
