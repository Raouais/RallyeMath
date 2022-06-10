<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Edition[]|\Cake\Collection\CollectionInterface $editions
 */

$deadline = [];
$hasLimit = false;


function getIcon($isOk)
{
    $icon = '';
    if ($isOk) {
        $icon = ' <svg style="color: green;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
        </svg>';
    } else {
        $icon = '        <svg style="color: red;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
    </svg>';
    }
    return $icon;
}

?>
<div class="editions index content">
    <?php if ($isAdmin) : ?>
        <?= $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <?php endif ?>
    <h3><?= __('Editions') ?></h3>

    <p>
        Contient une date de départ et une date de fin.
        <?= getIcon(true) ?>
    </p>
    <p>
        Ne contient pas date ou n'a pas de date de fin.
        <?= getIcon(false) ?>
    </p>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('Titre') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= $this->Paginator->sort("Nombre d'élèves") ?></th>
                    <th><?= $this->Paginator->sort('Année scolaire') ?></th>
                    <th><?= $this->Paginator->sort("Echéances") ?></th>
                    <th><?= $this->Paginator->sort("Photos") ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($editions as $edition) : ?>
                    <tr>
                        <td><?= h($edition->title) ?></td>

                        <?php if (strlen($edition->description) >= 10) : ?>
                            <td><?= h(substr($edition->description, 0, 10)) . "..." ?></td>
                        <?php else : ?>
                            <td><?= h($edition->description) ?></td>
                        <?php endif ?>

                        <td><?= "De " . $this->Number->format($edition->nbStudentMin) . " à " . $this->Number->format($edition->nbStudentMax) ?></td>
                        <td><?= h($edition->schoolYear) ?></td>

                        <?php
                            foreach ($deadlines as $d) {
                                if ($d->editionId == $edition->id) {
                                    $deadline[] = $d;
                                }
                            }

                            if (!empty($deadline)) {
                                foreach ($deadline as $d) {
                                    if ($d->isLimit == true) {
                                        $hasLimit = true;
                                    }
                                }
                                $deadline = [];
                            } else {
                                $hasLimit = false;
                            }
                            
                        ?>

                        <?php if ($isAdmin) : ?>

                            <td class="actions">
                                <?php if ($hasLimit) : ?>
                                    <?= getIcon($hasLimit) ?>
                                    <?= $this->Html->link(__('Voir'), ['controller' => 'deadlines', 'action' => 'index', $edition->id]) ?>
                                <?php else:?>
                                    <?= getIcon($hasLimit) ?>
                                    <?= $this->Html->link(__('Créer'), ['controller' => 'deadlines', 'action' => 'index', $edition->id]) ?>
                                <?php endif ?>
                            </td>


                            <td class="actions"><?= $this->Html->link(__('Ajouter'), ['controller' => 'files', 'action' => 'index', $edition->id]) ?>
                            </td>

                        <?php else:?>

                            <td class="actions">
                                <?php if ($hasLimit) : ?>
                                    <?= getIcon($hasLimit) ?>
                                <?php else : ?>
                                    <?= getIcon($hasLimit) ?>
                                <?php endif ?>
                                <?= $this->Html->link(__('Voir'), ['controller' => 'deadlines', 'action' => 'index', $edition->id]) ?>
                            </td>


                            <td class="actions"><?= $this->Html->link(__('Voir'), ['controller' => 'files', 'action' => 'index', $edition->id]) ?>
                            </td>


                        <?php endif ?>

                        <td class="actions">
                            <?= $this->Html->link(__('Voir'), ['action' => 'view', $edition->id]) ?>
                            <?php if (!$isAdmin) : ?>
                                <?= $this->Html->link(__("S'inscrire"), ['controller' => 'registrations', 'action' => 'index', $edition->id]) ?>
                            <?php else : ?>
                                <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $edition->id]) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $edition->id], ['confirm' => __('Are you sure you want to delete # {0}?', $edition->id)]) ?>
                            <?php endif ?>
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