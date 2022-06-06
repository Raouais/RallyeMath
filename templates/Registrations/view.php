<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Registration $registration
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Ajouter'), ['action' => 'add', $editionID], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $registration->id, $editionID], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $registration->id, $editionID], ['confirm' => __('Are you sure you want to delete # {0}?', $registration->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Revenir à la liste'), ['action' => 'index', $editionID], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="registrations view content">
            <h3><?= h($registration->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($registration->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($registration->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('IsConfirm') ?></th>
                    <td><?= $registration->isConfirm ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('IsFinalist') ?></th>
                    <td><?= $registration->isFinalist ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
