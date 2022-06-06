<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Registration[]|\Cake\Collection\CollectionInterface $registrations
 */
?>
<div class="registrations index content">
    <?= $this->Html->link(__('New Registration'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Registrations') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('isConfirm') ?></th>
                    <th><?= $this->Paginator->sort('isFinalist') ?></th>
                    <th><?= $this->Paginator->sort('editionId') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registrations as $registration): ?>
                <tr>
                    <td><?= $this->Number->format($registration->id) ?></td>
                    <td><?= h($registration->isConfirm) ?></td>
                    <td><?= h($registration->isFinalist) ?></td>
                    <td><?= $this->Number->format($registration->editionId) ?></td>
                    <td><?= h($registration->created) ?></td>
                    <td><?= h($registration->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $registration->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $registration->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $registration->id], ['confirm' => __('Are you sure you want to delete # {0}?', $registration->id)]) ?>
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
