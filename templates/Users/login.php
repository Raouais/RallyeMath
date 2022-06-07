<div class="column-responsive column-80">
    <div class="users form content">
        <h1>Connexion</h1>
        <?= $this->Form->create()?>
        <fieldset>
            <legend> Connectez vous avec votre e-mail et votre mot de passe</legend>
            <?= $this->Form->control('email', ['required' => true, 'autocomplete' => 'on'])?>
            <?= $this->Form->control('password', ['required' => true])?>
        </fieldset>
        <br>
        <?= $this->Form->submit(__('Se connecter'))?>
        <?= $this->Form->end()?>
    </div>
</div>