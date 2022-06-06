<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Deadline $deadline
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Deadline'), ['action' => 'edit', $deadline->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Deadline'), ['action' => 'delete', $deadline->id], ['confirm' => __('Are you sure you want to delete # {0}?', $deadline->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Deadlines'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Deadline'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="deadlines view content">
            <h3><?= h($deadline->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($deadline->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($deadline->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('EditionId') ?></th>
                    <td><?= $this->Number->format($deadline->editionId) ?></td>
                </tr>
                <tr>
                    <th><?= __('Startdate') ?></th>
                    <td><?= h($deadline->startdate) ?></td>
                </tr>
                <tr>
                    <th><?= __('Enddate') ?></th>
                    <td><?= h($deadline->enddate) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($deadline->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($deadline->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('IsLimit') ?></th>
                    <td><?= $deadline->isLimit ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
