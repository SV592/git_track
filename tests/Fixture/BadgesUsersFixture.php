<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BadgesUsersFixture
 */
class BadgesUsersFixture extends TestFixture
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
                'user_id' => 1,
                'badge_id' => 1,
                'created' => '2025-08-21 02:20:27',
            ],
        ];
        parent::init();
    }
}
