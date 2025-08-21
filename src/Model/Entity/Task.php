<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Task Entity
 *
 * @property int $id
 * @property int $project_id
 * @property int|null $user_id
 * @property string $title
 * @property string|null $description
 * @property int|null $points
 * @property string|null $status
 * @property string $github_link
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Project $project
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Comment[] $comments
 * @property \App\Model\Entity\PointLog[] $point_logs
 */
class Task extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'project_id' => true,
        'user_id' => true,
        'title' => true,
        'description' => true,
        'points' => true,
        'status' => true,
        'github_link' => true,
        'created' => true,
        'modified' => true,
        'project' => true,
        'user' => true,
        'comments' => true,
        'point_logs' => true,
    ];
}
