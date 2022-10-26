<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Signature $signature
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Signature'), ['action' => 'edit', $signature->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Signatures'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="signatures view content">
            <h3><?= h($signature->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Text') ?></th>
                    <td><?= h($signature->text) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
