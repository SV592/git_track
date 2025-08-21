<?php
declare(strict_types=1);

namespace App\Policy;

use Authorization\IdentityInterface;
use App\Model\Table\UsersTable;

/**
 * UsersTable policy
 */
class UsersTablePolicy
{
    /**
     * Anyone can register (add a user).
     */
    public function canRegister(?IdentityInterface $user, UsersTable $resource)
    {
        return true;
    }

    /**
     * Any logged-in user can view the list of users.
     */
    public function canIndex(IdentityInterface $user, UsersTable $resource)
    {
        return true;
    }

    public function scopeIndex(IdentityInterface $user, \Cake\ORM\Query $query)
    {
        // Only show the logged-in user
        return $query->where(['id' => $user['id']]);
    }

}