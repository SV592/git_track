<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\PointLog> $pointLogs
 */
?>
<div class="pointLogs index content">
    <?= $this->Html->link(__('New Point Log'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Point Logs') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('points_earned') ?></th>
                    <th><?= $this->Paginator->sort('task_id') ?></th>
                    <th><?= $this->Paginator->sort('reason') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pointLogs as $pointLog): ?>
                <tr>
                    <td><?= $this->Number->format($pointLog->id) ?></td>
                    <td><?= $pointLog->hasValue('user') ? $this->Html->link($pointLog->user->email, ['controller' => 'Users', 'action' => 'view', $pointLog->user->id]) : '' ?></td>
                    <td><?= $this->Number->format($pointLog->points_earned) ?></td>
                    <td><?= $pointLog->hasValue('task') ? $this->Html->link($pointLog->task->title, ['controller' => 'Tasks', 'action' => 'view', $pointLog->task->id]) : '' ?></td>
                    <td><?= h($pointLog->reason) ?></td>
                    <td><?= h($pointLog->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $pointLog->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $pointLog->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $pointLog->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $pointLog->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>