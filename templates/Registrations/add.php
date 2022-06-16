<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Registration $registration
 */

$options = [];

if($isSchoolAlreadyCreated){
    foreach($students as $s){
        $options[$s->id] = "  ".$s->lastname." ".$s->firstname; 
    }
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
                    echo $this->Form->control('team',['label' => "Nom de l'équipe"]);
                    echo '<label>Choisissez les élèves participants</label>';
                    if($isSchoolAlreadyCreated){
                        echo $this->Form->select(
                            'students', 
                            $options,
                        ['multiple' => 'checkbox']);
                    } else {
                        echo $this->Form->label('Insérez les données de votre école');
                        echo $this->Form->control('name', ['label' => 'Nom']);
                        echo $this->Form->control('address', ['label' => 'Adresse']);
                        echo $this->Form->control('city', ['label' => 'Ville']);
                        echo $this->Form->control('phone', ['label' => 'Téléphone']);
                    }
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
