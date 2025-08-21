<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BadgesUser $badgesUser
 * @var string[]|\Cake\Collection\CollectionInterface $users
 * @var string[]|\Cake\Collection\CollectionInterface $badges
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $badgesUser->user_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $badgesUser->user_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Badges Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="badgesUsers form content">
            <?= $this->Form->create($badgesUser) ?>
            <fieldset>
                <legend><?= __('Edit Badges User') ?></legend>
                <?php
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
