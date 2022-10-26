<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Signature[]|\Cake\Collection\CollectionInterface $signatures
 */
?>
<div class="signatures index content">
    <?= $this->Html->link(__('New Signature'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Signatures') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('text') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($signatures as $signature): ?>
                <tr>
                    <td><?= h($signature->text) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $signature->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $signature->id]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
   
</div>
