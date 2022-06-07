<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="users index content">
    <?= $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Users') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('Nom') ?></th>
                    <th><?= $this->Paginator->sort('Prénom') ?></th>
                    <th><?= $this->Paginator->sort('Email') ?></th>
                    <th><?= $this->Paginator->sort('Fontion') ?></th>
                    <th><?= $this->Paginator->sort('Téléphone') ?></th>
                    <th><?= $this->Paginator->sort('Civilité') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= h($user->lastname) ?></td>
                    <td><?= h($user->firstname) ?></td>
                    <td><?= h($user->email) ?></td>
                    <td><?= h($user->function) ?></td>
                    <td><?= h($user->phone) ?></td>
                    <td><?= h($user->civility == 1 ? "Mme." : "M.") ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Voir'), ['action' => 'view', $user->id]) ?>
                        <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $user->id]) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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
