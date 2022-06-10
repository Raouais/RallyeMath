<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File[]|\Cake\Collection\CollectionInterface $files
 */
?>
<div class="files index content">
    <?= $this->Html->link(__('Ajouter'), ['action' => 'add', $editionID], ['class' => 'button float-right']) ?>
    <h3><?= __('Photos') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('Nom') ?></th>
                    <th><?= $this->Paginator->sort('Type') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($files as $file): ?>
                <tr>
                    <td><?= h($file->name) ?></td>
                    <td><?= h($file->type) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Voir'), ['action' => 'view', $file->id, $editionID]) ?>
                    <?php if($isAdmin):?>
                        <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $file->id, $editionID]) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $file->id, $editionID], ['confirm' => __('Are you sure you want to delete # {0}?', $file->id)]) ?>
                    <?php endif?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __(' ')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__(' ') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
