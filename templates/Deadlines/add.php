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
            <?= $this->Html->link(__('Revenir à la liste'), ['action' => 'index', $editionID], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="deadlines form content">
            <?= $this->Form->create($deadline) ?>
            <fieldset>
                <legend><?= __('Ajout Echéance') ?></legend>
                <?php
                    echo $this->Form->control('title', ['label' => "Titre"]);
                    echo $this->Form->control('startdate', ['label' => "Début"]);
                    echo $this->Form->control('enddate', ['label' => "Fin"]);
                    echo $this->Form->label('Dernière échéance');
                    echo $this->Form->select('isLimit',[1 => 'Oui', 0 => 'Non']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
