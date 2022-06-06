<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Student[]|\Cake\Collection\CollectionInterface $students
 */
?>
<div class="students index content">
    <?= $this->Html->link(__('Ajouter'), ['action' => 'add', $schoolID], ['class' => 'button float-right']) ?>
    <h3><?= __('Etudiants') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('Nom') ?></th>
                    <th><?= $this->Paginator->sort('Prénom') ?></th>
                    <th><?= $this->Paginator->sort('Ecole') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= h($student->lastname) ?></td>
                    <td><?= h($student->firstname) ?></td>
                    <td><?= $this->Number->format($student->schoolId) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Voir'), ['action' => 'view', $student->id, $schoolID]) ?>
                        <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $student->id,$schoolID]) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $student->id, $schoolID], ['confirm' => __('Are you sure you want to delete # {0}?', $student->id)]) ?>
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
