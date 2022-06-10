<?php
use Cake\I18n\FrozenTime;

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Deadline[]|\Cake\Collection\CollectionInterface $deadlines
 */

function formatTime($time){
    return (new FrozenTime($time))->format('d-m-Y H:i:s');
}
?>
<div class="deadlines index content">
    <?= $this->Html->link(__('New Deadline'), ['action' => 'add', $editionID], ['class' => 'button float-right']) ?>
    <h3><?= __('Echéances') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('Titre') ?></th>
                    <th><?= $this->Paginator->sort('Début') ?></th>
                    <th><?= $this->Paginator->sort('Fin') ?></th>
                    <th><?= $this->Paginator->sort('Denière écheance') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($deadlines as $deadline): ?>
                <tr>
                    <td><?= h($deadline->title) ?></td>
                    <td><?= h($deadline->startdate) ?></td>
                    <td><?= h($deadline->enddate) ?></td>
                    <td><?= h($deadline->isLimit == 1 ? "Oui" : "Non") ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Voir'), ['action' => 'view', $deadline->id, $editionID]) ?>
                        <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $deadline->id, $editionID]) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $deadline->id, $editionID], ['confirm' => __('Are you sure you want to delete # {0}?', $deadline->id)]) ?>
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
