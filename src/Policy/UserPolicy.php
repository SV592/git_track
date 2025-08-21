<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\User;
use Authorization\IdentityInterface;

/**
 * User policy
 */
class UserPolicy
{
    /**
     * Policy for adding a new user.
     * Anyone can register, even if they aren't logged in.
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
     * @param \Authorization\IdentityInterface $user The identity of the user.
     * @param \App\Model\Entity\User $resource The User entity.
     * @return bool
     */
    public function canView(IdentityInterface $identity, User $resource)
    {
        // Any user can view their own profile.
        // We can add logic to check for a manager role to view other users later.
        return $identity['id'] === $resource->id;
    }

    public function canIndex(IdentityInterface $identity, User $resource)
    {
        // Any logged-in user can view the list of users.
        return true;
    }

    /**
     * Policy for editing a user.
     * A user should only be able to edit their own profile.
     *
     * @param \Authorization\IdentityInterface $user The identity of the user.
     * @param \App\Model\Entity\User $resource The User entity.
     * @return bool
     */
    public function canEdit(IdentityInterface $user, User $resource)
    {
        // Check if the current user ID matches the resource's user ID.
        return $this->isOwner($user, $resource);
    }

    /**
     * A helper method to check if the current user is the owner of a resource.
     *
     * @param \Authorization\IdentityInterface $user The identity of the user.
     * @param \App\Model\Entity\User $resource The User entity.
     * @return bool
     */
    protected function isOwner(IdentityInterface $user, User $resource)
    {
        return $resource->id === $user['id'];
    }
}
