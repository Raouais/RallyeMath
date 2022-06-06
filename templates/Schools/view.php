<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\School $school
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $school->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $school->id], ['confirm' => __('Are you sure you want to delete # {0}?', $school->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Revenir à la liste'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="schools view content">
            <h3><?= h($school->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nom') ?></th>
                    <td><?= h($school->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Adresse') ?></th>
                    <td><?= h($school->address) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ville') ?></th>
                    <td><?= h($school->city) ?></td>
                </tr>
                <tr>
                    <th><?= __('Téléphone') ?></th>
                    <td><?= h($school->phone) ?></td>
                </tr>
                <tr>
                    <th><?= __("Participe à l'édition") ?></th>
                    <td><?= $this->Number->format($school->registrationId) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($school->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($school->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
