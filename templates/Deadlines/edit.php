<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Deadline $deadline
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $deadline->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $deadline->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Deadlines'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="deadlines form content">
            <?= $this->Form->create($deadline) ?>
            <fieldset>
                <legend><?= __('Edit Deadline') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('startdate');
                    echo $this->Form->control('enddate');
                    echo $this->Form->control('editionId');
                    echo $this->Form->control('isLimit');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
