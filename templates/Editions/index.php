<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Edition[]|\Cake\Collection\CollectionInterface $editions
 */
?>
<div class="editions index content">
    <?= $this->Html->link(__('New Edition'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Editions') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('Titre') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= $this->Paginator->sort('Nb max étudiants') ?></th>
                    <th><?= $this->Paginator->sort('Nb min étudiants') ?></th>
                    <th><?= $this->Paginator->sort('Année scolaire') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($editions as $edition): ?>
                <tr>
                    <td><?= h($edition->title) ?></td>
                    <td><?= h($edition->description) ?></td>
                    <td><?= $this->Number->format($edition->nbStudentMax) ?></td>
                    <td><?= $this->Number->format($edition->nbStudentMin) ?></td>
                    <td><?= h($edition->schoolYear) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Voir'), ['action' => 'view', $edition->id]) ?>
                        <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $edition->id]) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $edition->id], ['confirm' => __('Are you sure you want to delete # {0}?', $edition->id)]) ?>
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
