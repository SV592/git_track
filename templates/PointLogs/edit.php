<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PointLog $pointLog
 * @var string[]|\Cake\Collection\CollectionInterface $users
 * @var string[]|\Cake\Collection\CollectionInterface $tasks
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $pointLog->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $pointLog->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Point Logs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="pointLogs form content">
            <?= $this->Form->create($pointLog) ?>
            <fieldset>
                <legend><?= __('Edit Point Log') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('points_earned');
                    echo $this->Form->control('task_id', ['options' => $tasks, 'empty' => true]);
                    echo $this->Form->control('reason');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
