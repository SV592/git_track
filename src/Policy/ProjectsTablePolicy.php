<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Project;
use Authorization\IdentityInterface;
use Cake\ORM\TableRegistry;

/**
 * Project policy
 */
class ProjectsTablePolicy
{
    /**
     * Scope policy to only show projects the user is a member of.
     *
     * This is crucial for restricting the list of projects a user can see
     * in an index view.
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \Cake\ORM\Query $query The query builder.
     * @return \Cake\ORM\Query
     */
    public function scopeIndex(IdentityInterface $user, \Cake\ORM\Query $query)
    {
        $projectsUsersTable = TableRegistry::getTableLocator()->get('ProjectsUsers');
        $userId = method_exists($user, 'getIdentifier') ? $user->getIdentifier() : ($user->id ?? ($user->getOriginalData()->id ?? null));

        // Find all project IDs the user is a member of.
        $userProjects = $projectsUsersTable->find()
            ->select(['project_id'])
            ->where(['user_id' => $userId])
            ->all()
            ->extract('project_id')
            ->toList();

        // If the user is not a member of any projects, return an always-false condition.
        if (empty($userProjects)) {
            return $query->where(['1 = 0']);
        }

        // Otherwise, restrict to projects the user is a member of.
        return $query->where(['Projects.id IN' => $userProjects]);
    }

    /**
     * Policy for viewing a project.
     * A user should only be able to view projects they are a member of.
     *
     * @param \Authorization\IdentityInterface $identity The identity of the user.
     * @param \App\Model\Entity\Project $resource The Project entity.
     * @return bool
     */
    public function canView(IdentityInterface $identity, Project $resource)
    {
        $projectsUsersTable = TableRegistry::getTableLocator()->get('ProjectsUsers');
        $userId = method_exists($identity, 'getIdentifier') ? $identity->getIdentifier() : ($identity->id ?? ($identity->getOriginalData()->id ?? null));

        // Check if the user is a member of this project
        $isMember = $projectsUsersTable->find()
            ->where([
                'project_id' => $resource->id,
                'user_id' => $userId
            ])
            ->count();

        return $isMember > 0;
    }

    /**
     * Policy for editing a project.
     * Only a project admin can edit a project.
     *
     * @param \Authorization\IdentityInterface $user The identity of the user.
     * @param \App\Model\Entity\Project $resource The Project entity.
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Project $resource)
    {
        return $this->isAdminOfProject($user, $resource);
    }

    /**
     * Policy for deleting a project.
     * Only a project admin can delete a project.
     *
     * @param \Authorization\IdentityInterface $user The identity of the user.
     * @param \App\Model\Entity\Project $resource The Project entity.
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Project $resource)
    {
        return $this->isAdminOfProject($user, $resource);
    }

    /**
     * Policy for adding a user to a project.
     * Only a project admin can add a user to the project.
     *
     * @param \Authorization\IdentityInterface $user The identity of the user.
     * @param \App\Model\Entity\Project $resource The Project entity.
     * @return bool
     */
    public function canAddUser(IdentityInterface $user, Project $resource)
    {
        return $this->isAdminOfProject($user, $resource);
    }

    /**
     * Policy for removing a user from a project.
     * Only a project admin can remove a user from the project.
     *
     * @param \Authorization\IdentityInterface $user The identity of the user.
     * @param \App\Model\Entity\Project $resource The Project entity.
     * @return bool
     */
    public function canRemoveUser(IdentityInterface $user, Project $resource)
    {
        return $this->isAdminOfProject($user, $resource);
    }

    /**
     * A helper method to check if the current user has the 'admin' role in a specific project.
     *
     * @param \Authorization\IdentityInterface $user The identity of the user.
     * @param \App\Model\Entity\Project $resource The Project entity.
     * @return bool
     */
    protected function isAdminOfProject(IdentityInterface $user, Project $resource)
    {
        $projectsUsersTable = TableRegistry::getTableLocator()->get('ProjectsUsers');
        $userId = method_exists($user, 'getIdentifier') ? $user->getIdentifier() : ($user->id ?? ($user->getOriginalData()->id ?? null));

        // Check for the 'admin' role in the junction table
        $isAdmin = $projectsUsersTable->find()
            ->where([
                'project_id' => $resource->id,
                'user_id' => $userId,
                'role' => 'admin'
            ])
            ->count();

        return $isAdmin > 0;
    }
}
