<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Revenir à la liste'), ['action' => 'index', $editionID], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="files form content">
            <?= $this->Form->create($file, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Ajouter une photo') ?></legend>
                <?php
                    echo $this->Form->control('type', ['default' => 'image', 'type' => 'hidden']);
                    echo $this->Form->control('path', ['type' => 'file', 'label' => 'Fichier']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
