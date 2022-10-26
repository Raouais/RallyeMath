<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Signature $signature
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Signatures'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="signatures form content">
            <?= $this->Form->create($signature) ?>
            <fieldset>
                <legend><?= __('Edit Signature') ?></legend>
                <?php
                    echo $this->Form->control('text');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
