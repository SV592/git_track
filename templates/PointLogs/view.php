<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PointLog $pointLog
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Point Log'), ['action' => 'edit', $pointLog->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Point Log'), ['action' => 'delete', $pointLog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pointLog->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Point Logs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Point Log'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="pointLogs view content">
            <h3><?= h($pointLog->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $pointLog->hasValue('user') ? $this->Html->link($pointLog->user->email, ['controller' => 'Users', 'action' => 'view', $pointLog->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Task') ?></th>
                    <td><?= $pointLog->hasValue('task') ? $this->Html->link($pointLog->task->title, ['controller' => 'Tasks', 'action' => 'view', $pointLog->task->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Reason') ?></th>
                    <td><?= h($pointLog->reason) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($pointLog->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Points Earned') ?></th>
                    <td><?= $this->Number->format($pointLog->points_earned) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($pointLog->created) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>