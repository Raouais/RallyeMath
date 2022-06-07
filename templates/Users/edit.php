<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$options = [
    1 => "Mme.",
    2 => "M."
 ]
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
                    echo $this->Form->control('password',['label' => 'Mot de passe']);
                    echo $this->Form->control('password_confirm',['label' => 'Confirmation du mot de passe', 'type' => 'password']);
                    echo $this->Form->control('function',['label' => 'Fonction ex: (professeur, éducateur)']);
                    echo $this->Form->control('phone',['label' => 'Téléphone']);
                    echo $this->Form->label("Civilité");
                    echo $this->Form->select('civility', $options);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
