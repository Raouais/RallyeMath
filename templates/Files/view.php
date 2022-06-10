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
            <?php if($isAdmin):?>
                <?= $this->Html->link(__('Ajouter'), ['action' => 'add', $editionID], ['class' => 'side-nav-item']) ?>
                <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $file->id, $editionID], ['class' => 'side-nav-item']) ?>
                <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $file->id, $editionID], ['confirm' => __('Are you sure you want to delete # {0}?', $file->id), 'class' => 'side-nav-item']) ?>
            <?php endif?>
            <?= $this->Html->link(__('Revenir à la liste'), ['action' => 'index', $editionID], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="files view content">
            <h3><?= h($file->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Photo') ?></th>
                    <td><?= $this->Html->image($file->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= h($file->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($file->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($file->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
