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
            <?= $this->Form->postLink(
                __('Supprimer'),
                ['action' => 'delete', $registration->id, $editionID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $registration->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('Revenir à la liste'), ['action' => 'index', $editionID], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="registrations form content">
            <?= $this->Form->create($registration) ?>
            <fieldset>
                <legend><?= __('Modification') ?></legend>
                <?php
                    if($isAdmin){
                        echo $this->Form->control('isConfirm', ['label' => 'Conrfimée']);
                        echo $this->Form->control('isFinalist', ['label' => 'En finale']);
                    } else {
                        echo $this->Form->control('team',['label' => "Nom de l'équipe"]);
                        echo '<label>Choisissez les élèves participants</label>';
                        echo $this->Form->select(
                            'students', 
                            $options,
                        ['multiple' => 'checkbox']);
                    }
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
