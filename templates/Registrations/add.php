<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Registration $registration
 */

 $options = [
     7 => " Jean",
     13 => " Louis"
 ]
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Revenir à la liste'), ['action' => 'index', $editionID], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="registrations form content">
            <?= $this->Form->create($registration) ?>
            <fieldset>
                <legend><?= __('Add Registration') ?></legend>
                <?php
                    echo $this->Form->control('isConfirm');
                    echo $this->Form->control('isFinalist');

                    echo $this->Form->label("Ecole");
                    echo $this->Form->select('schools', [1 => "HERS"]);
                    echo $this->Form->label("Etudiants");
                    echo $this->Form->select(
                        'students', 
                        $options,
                    ['multiple' => 'checkbox']);
                    echo $this->Form->control('editionId');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
