<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$civilities = [
    "Madame" => "Madame",
    "Monsieur" => "Monsieur",
    "Mademoiselle" => "Mademoiselle",
    "others" => "Autres"
];

?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Supprimer'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('Revenir à la liste'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Modification du compte') ?></legend>
                <?php
                    echo $this->Form->control('lastname',['label' => 'Nom']);
                    echo $this->Form->control('firstname',['label' => 'Prénom']);
                    echo $this->Form->control('email',['label' => 'Email']);
                    echo $this->Form->control('password_current',['label' => 'Mot de passe actuel', 'type' => 'password']);
                    if(!$isAdmin){
                        echo $this->Form->control('password',['label' => 'Mot de passe', 'id' => 'pwd']);
                        echo $this->Form->control('password_confirm',['label' => 'Confirmation du mot de passe', 'type' => 'password']);
                    }
                    echo $this->Form->control('function',['label' => 'Fonction ex: (professeur, éducateur)']);
                    echo $this->Form->control('phone',['label' => 'Téléphone']);
                    if($isAdmin){
                        echo $this->Form->label('Administrateur');
                        echo $this->Form->select('isAdmin',[1 => 'Oui', 0 => 'Non']);
                    }
                    echo $this->Form->label("Civilité");
                    echo $this->Form->select('civility', $civilities, ['id' => 'civility']);
                    echo '<div id="others"></div>';
                    echo $this->Html->script('others');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
    let pwd = document.getElementById('pwd');
    if(pwd.value.length > 0){
        pwd.value = ""
    };
</script>