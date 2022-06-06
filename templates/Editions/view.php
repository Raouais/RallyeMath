<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Edition $edition
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $edition->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $edition->id], ['confirm' => __('Are you sure you want to delete # {0}?', $edition->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Revenir à la liste'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="editions view content">
            <h3><?= h($edition->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($edition->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($edition->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('SchoolYear') ?></th>
                    <td><?= h($edition->schoolYear) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($edition->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('NbStudentMax') ?></th>
                    <td><?= $this->Number->format($edition->nbStudentMax) ?></td>
                </tr>
                <tr>
                    <th><?= __('NbStudentMin') ?></th>
                    <td><?= $this->Number->format($edition->nbStudentMin) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($edition->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($edition->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ajouts') ?></th>
                    <td> 
                        <?= $this->Html->link(__('Photos'), ['controller' => 'files' ,'action' => 'edit', $edition->id]) ?>
                        <?= $this->Html->link(__('Echeances'), ['controller' => 'deadlines', 'action' => 'edit', $edition->id]) ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
