<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Deadline $deadline
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Supprimer'),
                ['action' => 'supprimer', $deadline->id, $editionID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $deadline->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('Revenir à la liste'), ['action' => 'index', $editionID], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="deadlines form content">
            <?= $this->Form->create($deadline) ?>
            <fieldset>
                <legend><?= __('Modification') ?></legend>
                <?php
                   echo $this->Form->control('title', ['label' => "Titre"]);
                   echo $this->Form->control('startdate', ['label' => "Début"]);
                   echo $this->Form->control('enddate', ['label' => "Fin"]);
                   echo $this->Form->control('isLimit', ['label' => "Dernière échéance"]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
