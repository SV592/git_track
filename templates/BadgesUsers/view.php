<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BadgesUser $badgesUser
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Badges User'), ['action' => 'edit', $badgesUser->user_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Badges User'), ['action' => 'delete', $badgesUser->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $badgesUser->user_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Badges Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Badges User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="badgesUsers view content">
            <h3><?= h($badgesUser->Array) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $badgesUser->hasValue('user') ? $this->Html->link($badgesUser->user->email, ['controller' => 'Users', 'action' => 'view', $badgesUser->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Badge') ?></th>
                    <td><?= $badgesUser->hasValue('badge') ? $this->Html->link($badgesUser->badge->name, ['controller' => 'Badges', 'action' => 'view', $badgesUser->badge->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($badgesUser->created) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>