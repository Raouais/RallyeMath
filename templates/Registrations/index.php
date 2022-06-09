<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Registration[]|\Cake\Collection\CollectionInterface $registrations
 */
?>
<div class="registrations index content">
    <?php if(!$isAdmin):?>
    <?= $this->Html->link(__("Créer une inscription"), ['action' => 'add', $editionID], ['class' => 'button float-right']) ?>
    <?php endif?>
    <h3><?= __('Inscription') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('Equipe') ?></th>
                    <th><?= $this->Paginator->sort('Confirmée') ?></th>
                    <th><?= $this->Paginator->sort('En finale') ?></th>
                    <th><?= $this->Paginator->sort('Edition') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registrations as $registration): ?>
                <tr>
                    <td><?= h($registration->team) ?></td>
                    <td><?= h($registration->isConfirm ? "Oui" : "Non") ?></td>
                    <td><?= h($registration->isFinalist ? "Oui" : "Non") ?></td>
                    <td><?= h($editionName) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Voir'), ['action' => 'view', $registration->id, $editionID]) ?>
                        <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $registration->id, $editionID]) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $registration->id, $editionID], ['confirm' => __('Are you sure you want to delete # {0}?', $registration->id)]) ?>
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
