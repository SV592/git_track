<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\User;
use Authorization\IdentityInterface;

/**
 * User policy
 */
class UsersTablePolicy
{
    /**
     * Scope policy to only show the user's own record in the index.
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \Cake\ORM\Query $query The query builder.
     * @return \Cake\ORM\Query
     */
    public function scopeIndex(IdentityInterface $user, \Cake\ORM\Query $query)
    {
        $userId = method_exists($user, 'getIdentifier') ? $user->getIdentifier() : ($user->id ?? ($user->getOriginalData()->id ?? null));
        return $query->where(['id' => $userId]);
    }

    /**
     * Policy for adding a new user.
     * Anyone can register.
     *
     * @param \Authorization\IdentityInterface $user The identity of the user.
     * @param \App\Model\Entity\User $resource The User entity.
     * @return bool
     */
    public function canRegister(?IdentityInterface $user, User $resource)
    {
        return true;
    }

    /**
     * Policy for viewing a user's profile.
     * A user should only be able to view their own profile.
     *
     * @param \Authorization\IdentityInterface $identity The identity of the user.
     * @param \App\Model\Entity\User $resource The User entity.
     * @return bool
     */
    public function canView(IdentityInterface $identity, User $resource)
    {
        $identityId = method_exists($identity, 'getIdentifier') ? $identity->getIdentifier() : ($identity->id ?? ($identity->getOriginalData()->id ?? null));
        return $identityId === $resource->id;
    }

    /**
     * Policy for editing a user.
     * Only a user can edit their own profile.
     *
     * @param \Authorization\IdentityInterface $user The identity of the user.
     * @param \App\Model\Entity\User $resource The User entity.
     * @return bool
     */
    public function canEdit(IdentityInterface $user, User $resource)
    {
        $userId = method_exists($user, 'getIdentifier') ? $user->getIdentifier() : ($user->id ?? ($user->getOriginalData()->id ?? null));
        return $userId === $resource->id;
    }

    /**
     * Policy for deleting a user.
     * Only a user can delete their own profile.
     *
     * @param \Authorization\IdentityInterface $user The identity of the user.
     * @param \App\Model\Entity\User $resource The User entity.
     * @return bool
     */
    public function canDelete(IdentityInterface $user, User $resource)
    {
        $userId = method_exists($user, 'getIdentifier') ? $user->getIdentifier() : ($user->id ?? ($user->getOriginalData()->id ?? null));
        return $userId === $resource->id;
    }
}
