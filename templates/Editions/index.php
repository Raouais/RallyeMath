<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Edition[]|\Cake\Collection\CollectionInterface $editions
 */
?>
<div class="editions index content">
<?php if($isAdmin):?>    
    <?= $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'button float-right']) ?>
<?php endif?>
    <h3><?= __('Editions') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('Titre') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= $this->Paginator->sort("Nombre d'élèves") ?></th>
                    <th><?= $this->Paginator->sort('Année scolaire') ?></th>
                    <?php if($isAdmin):?>
                        <th><?= $this->Paginator->sort("Echéances") ?></th>
                        <th><?= $this->Paginator->sort("Photos") ?></th>
                    <?php endif?>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($editions as $edition): ?>
                <tr>
                    <td><?= h($edition->title) ?></td>

                    <?php if(strlen($edition->description) >= 10):?>
                        <td><?= h(substr($edition->description,0,10))."..." ?></td>
                    <?php else:?>
                        <td><?= h($edition->description)?></td>
                    <?php endif?>
                    
                    <td><?= "De ". $this->Number->format($edition->nbStudentMin) ." à ".$this->Number->format($edition->nbStudentMax) ?></td>
                    <td><?= h($edition->schoolYear) ?></td>

                    <?php if($isAdmin):?>                        
                        <td class="actions"><?= $this->Html->link(__('Créer'), ['action' => 'view', $edition->id]) ?></td>
                        <td class="actions"><?= $this->Html->link(__('Ajouter'), ['action' => 'view', $edition->id]) ?></td>
                    <?php endif?>
                    
                    <td class="actions">
                        <?= $this->Html->link(__('Voir'), ['action' => 'view', $edition->id]) ?>
                        <?php if(!$isAdmin):?>                        
                            <?= $this->Html->link(__("S'inscrire"), ['controller' => 'registrations', 'action' => 'index', $edition->id]) ?>
                        <?php else:?>                        
                            <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $edition->id]) ?>
                            <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $edition->id], ['confirm' => __('Are you sure you want to delete # {0}?', $edition->id)]) ?>
                        <?php endif?>
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
