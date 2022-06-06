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
            <?= $this->Form->postLink(
                __('Supprimer'),
                ['action' => 'delete', $school->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $school->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('Revenir à la liste'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="schools form content">
            <?= $this->Form->create($school) ?>
            <fieldset>
                <legend><?= __('Modification') ?></legend>
                <?php
                   echo $this->Form->control('name', ['label' => 'Nom']);
                   echo $this->Form->control('address', ['label' => 'Adresse']);
                   echo $this->Form->control('city', ['label' => 'Ville']);
                   echo $this->Form->control('phone', ['label' => 'Téléphone']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
