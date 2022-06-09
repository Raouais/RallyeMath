<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Revenir à la liste'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">
            <h3><?= h($user->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nom') ?></th>
                    <td><?= h($user->lastname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Prénom') ?></th>
                    <td><?= h($user->firstname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fonction') ?></th>
                    <td><?= h($user->function) ?></td>
                </tr>
                <tr>
                    <th><?= __('Téléphone') ?></th>
                    <td><?= h($user->phone) ?></td>
                </tr>
                <tr>
                    <th><?= __('Civilité') ?></th>
                    <td><?= h($user->civility == 1 ? "Mme.": "M.") ?></td>
                </tr>
                <?php if($isAdmin):?>
                    <tr>
                        <th><?= __('Aministrateur') ?></th>
                        <td><?= h($user->isAdmin === 1 ? "Oui": "Non") ?></td>
                    </tr>
                <?php endif?>
                <tr>
                    <th><?= __('Créé') ?></th>
                    <td><?= h($user->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifié') ?></th>
                    <td><?= h($user->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
