<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Deadline[]|\Cake\Collection\CollectionInterface $deadlines
 */
?>
<div class="deadlines index content">
    <?= $this->Html->link(__('New Deadline'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Deadlines') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('startdate') ?></th>
                    <th><?= $this->Paginator->sort('enddate') ?></th>
                    <th><?= $this->Paginator->sort('editionId') ?></th>
                    <th><?= $this->Paginator->sort('isLimit') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($deadlines as $deadline): ?>
                <tr>
                    <td><?= $this->Number->format($deadline->id) ?></td>
                    <td><?= h($deadline->title) ?></td>
                    <td><?= h($deadline->startdate) ?></td>
                    <td><?= h($deadline->enddate) ?></td>
                    <td><?= $this->Number->format($deadline->editionId) ?></td>
                    <td><?= h($deadline->isLimit) ?></td>
                    <td><?= h($deadline->created) ?></td>
                    <td><?= h($deadline->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $deadline->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $deadline->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $deadline->id], ['confirm' => __('Are you sure you want to delete # {0}?', $deadline->id)]) ?>
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
