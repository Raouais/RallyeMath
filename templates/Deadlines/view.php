<?php

use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Deadline $deadline
 */

function formatTime($time){
    return (new FrozenTime($time))->format('d-m-Y H:i');
}
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?php if($isAdmin):?>
                <?= $this->Html->link(__('Ajouter'), ['action' => 'add', $editionID], ['class' => 'side-nav-item']) ?>
                <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $deadline->id, $editionID], ['class' => 'side-nav-item']) ?>
                <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $deadline->id, $editionID], ['confirm' => __('Are you sure you want to delete # {0}?', $deadline->id), 'class' => 'side-nav-item']) ?>
            <?php endif?>
            <?= $this->Html->link(__('Revenir à la lise'), ['action' => 'index', $editionID], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="deadlines view content">
            <h3><?= h($deadline->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Titre') ?></th>
                    <td><?= h($deadline->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Début') ?></th>
                    <td><?= h(formatTime($deadline->startdate)) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fin') ?></th>
                    <td><?= h(formatTime($deadline->enddate)) ?></td>
                </tr>
                <tr>
                    <th><?= __('Créée') ?></th>
                    <td><?= h(formatTime($deadline->created)) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiée') ?></th>
                    <td><?= h(formatTime($deadline->modified)) ?></td>
                </tr>
                <tr>
                    <th><?= __('Dernière échéance') ?></th>
                    <td><?= $deadline->isLimit ? __('Oui') : __('Non'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
