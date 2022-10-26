<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Registration[]|\Cake\Collection\CollectionInterface $registrations
 */


$editionsChoice = [];

foreach($editions as $d){
    $editionsChoice[$d->id] = $d->title;
}

?>
<div class="registrations index content">
<?php if(!$isAdmin):?>
        <?= $this->Html->link(__("Vous pouvez créer une inscription que depuis une édition"), ['controller' => 'editions', 'action' => 'index'], ['class' => 'button float-right']) ?>
<?php endif?>
    <h3><?= __('Inscriptions aux éditions') ?></h3>

    <div class="choice">
        <?php
            echo $this->Form->create($registration);
            echo $this->Form->label('Editions');
            echo $this->Form->select('edition', $editionsChoice);
            echo $this->Form->submit("Choisir");
            echo $this->Form->end();
        ?>
    </div>

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
                    <?php foreach ($editions as $e): ?>
                        <?php if($e->id == $registration->editionId):?>
                            <td><?= $e->title?></td>
                        <?php endif;?>
                    <?php endforeach;?>
                    <td class="actions">
                        <?= $this->Html->link(__('Voir'), ['action' => 'view', $registration->id, $registration->editionId]) ?>
                        <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $registration->id, $registration->editionId]) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $registration->id, $registration->editionId], ['confirm' => __('Are you sure you want to delete # {0}?', $registration->id)]) ?>
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
        <p><?= $this->Paginator->counter(__('Page {{page}}/{{pages}}, Inscriptions {{current}}/{{count}} ')) ?></p>
    </div>
</div>
