<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Registration $registration
 */

$options = [];

foreach($students as $s){
    $options[$s->id] = "  ".$s->lastname." ".$s->firstname; 
}

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
                <legend><?= __("Inscription à l'édition ".$editionName) ?></legend>
                <?php
                    echo '<label>Choisissez les élèves participants</label>';
                    echo $this->Form->select(
                        'students', 
                        $options,
                    ['multiple' => 'checkbox']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
