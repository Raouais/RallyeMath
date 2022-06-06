<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Student $student
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Supprimer'),
                ['action' => 'delete', $student->id, $schoolID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $student->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('Revenir à la liste'), ['action' => 'index', $schoolID], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="students form content">
            <?= $this->Form->create($student) ?>
            <fieldset>
                <legend><?= __('Modification') ?></legend>
                <?php
                    echo $this->Form->control('lastname', ['label' => 'Nom']);
                    echo $this->Form->control('firstname', ['label' => 'Prénom']); 
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
