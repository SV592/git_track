<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\BadgesUser> $badgesUsers
 */
?>
<div class="badgesUsers index content">
    <?= $this->Html->link(__('New Badges User'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Badges Users') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('badge_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($badgesUsers as $badgesUser): ?>
                <tr>
                    <td><?= $badgesUser->hasValue('user') ? $this->Html->link($badgesUser->user->email, ['controller' => 'Users', 'action' => 'view', $badgesUser->user->id]) : '' ?></td>
                    <td><?= $badgesUser->hasValue('badge') ? $this->Html->link($badgesUser->badge->name, ['controller' => 'Badges', 'action' => 'view', $badgesUser->badge->id]) : '' ?></td>
                    <td><?= h($badgesUser->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $badgesUser->user_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $badgesUser->user_id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $badgesUser->user_id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $badgesUser->user_id),
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