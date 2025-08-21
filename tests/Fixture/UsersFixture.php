<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
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
                'email' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'username' => 'Lorem ipsum dolor sit amet',
                'total_points' => 1,
                'role' => 'Lorem ipsum dolor sit amet',
                'created' => '2025-08-21 02:34:06',
                'modified' => '2025-08-21 02:34:06',
            ],
        ];
        parent::init();
    }
}
