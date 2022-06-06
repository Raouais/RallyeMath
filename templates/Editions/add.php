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
            <?= $this->Html->link(__('Revenir à la liste'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="editions form content">
            <?= $this->Form->create($edition) ?>
            <fieldset>
                <legend><?= __('Ajouter une édition') ?></legend>
                <?php
                    echo $this->Form->control('title', ['label' => 'Titre']);
                    echo $this->Form->control('description', ['label' => 'Description']); 
                    echo $this->Form->control('nbStudentMax', ['label' => "Nombre maximum d'étudiants", 'default' => 4]);
                    echo $this->Form->control('nbStudentMin', ['label' => "Nombre minmium d'étudiants", 'default' => 2]);
                    echo $this->Form->control('schoolYear', ['label' => "Année scolaire"]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
