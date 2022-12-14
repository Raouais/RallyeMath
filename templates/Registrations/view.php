<?php

use Cake\I18n\FrozenTime;

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Registration $registration
 */

function formatTime($time){
    return (new FrozenTime($time))->format('d-m-Y H:i');
}
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Ajouter'), ['action' => 'add', $registration->editionId], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $registration->id, $registration->editionId], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $registration->id, $registration->editionId], ['confirm' => __('Are you sure you want to delete # {0}?', $registration->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Revenir à la liste'), ['action' => 'index', $registration->editionId], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="registrations view content">
            <h3><?= h("Inscription à l'édition ".$editionName) ?></h3>
            <table>
                <tr>
                    <th><?= __('Equipe') ?></th>
                    <td><?= h($registration->team); ?></td>
                </tr>
                <tr>
                    <th><?= __('Ecole') ?></th>
                    <td><?= h($school->name); ?></td>
                </tr>
                <tr>
                    <th><?= __('Edition') ?></th>
                    <td><?= h($editionName) ?></td>
                </tr>
                <tr>
                    <th><?= __('Etudiants') ?></th>
                    <td>
                        <table>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                            </tr>
                            <?php foreach($students as $s): ?>
                                <tr>
                                    <td>
                                        <?= $s->lastname ?>
                                    </td>
                                    <td>
                                        <?= $s->firstname ?>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        </table>
                        <?= $this->Html->link('Tout voir', ['controller' => 'students', 'action' => 'index', $registration->schoolId], ['class' => 'button']) ?>
                        <br>
                        <ul class="pagination">
                            <?=$this->Paginator->prev("<<")?>
                            <?=$this->Paginator->numbers()?>
                            <?=$this->Paginator->next(">>")?>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Confirmée') ?></th>
                    <td><?= $registration->isConfirm ? __('Oui') : __('Non'); ?></td>
                </tr>
                <tr>
                    <th><?= __('En finale') ?></th>
                    <td><?= $registration->isFinalist ? __('Oui') : __('Non'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Créée') ?></th>
                    <td><?= h(formatTime($registration->created)) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiée') ?></th>
                    <td><?= h(formatTime($registration->modified)) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
