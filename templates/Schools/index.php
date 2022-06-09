<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\School[]|\Cake\Collection\CollectionInterface $schools
 */
?>
<div class="schools index content">
    <?php if(sizeof($schools) == 0):?>
        <?= $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <?php endif?>
    <h3><?= __('Ecole') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('Nom') ?></th>
                    <th><?= $this->Paginator->sort('Adresse') ?></th>
                    <th><?= $this->Paginator->sort('Ville') ?></th>
                    <th><?= $this->Paginator->sort('Téléphone') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($schools as $school): ?>
                <tr>
                    <td><?= h($school->name) ?></td>
                    <td><?= h($school->address) ?></td>
                    <td><?= h($school->city) ?></td>
                    <td><?= h($school->phone) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Voir'), ['action' => 'view', $school->id]) ?>
                        <?php if(!$isAdmin):?>
                            <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $school->id]) ?>
                            <?= $this->Html->link(__('Ajouter un élève'), ['controller' => 'students', 'action' => 'index', $school->id]) ?>
                            <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $school->id], ['confirm' => __('Are you sure you want to delete # {0}?', $school->id)]) ?>
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
