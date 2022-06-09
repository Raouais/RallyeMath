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
            <?php if(!$isAdmin):?>
                <?= $this->Html->link(__('Ajouter'), ['action' => 'add', $schoolID], ['class' => 'side-nav-item']) ?>
                <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $student->id, $schoolID], ['class' => 'side-nav-item']) ?>
                <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $student->id, $schoolID], ['confirm' => __('Are you sure you want to delete # {0}?', $student->id), 'class' => 'side-nav-item']) ?>
                <?= $this->Html->link(__('Revenir à la liste'), ['action' => 'index', $schoolID], ['class' => 'side-nav-item']) ?>
            <?php else:?>
                <?= $this->Html->link(__('Revenir à la liste'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?php endif?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="students view content">
            <h3><?= h("Eleve de l'école ".$schoolName) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nom') ?></th>
                    <td><?= h($student->lastname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Prénom') ?></th>
                    <td><?= h($student->firstname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ecole') ?></th>
                    <td><?= h($schoolName) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($student->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($student->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
