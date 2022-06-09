<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Edition $edition
 */


?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?php if ($isAdmin) : ?>
                <?= $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
                <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $edition->id], ['class' => 'side-nav-item']) ?>
                <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $edition->id], ['confirm' => __('Are you sure you want to delete # {0}?', $edition->id), 'class' => 'side-nav-item']) ?>
            <?php endif ?>
            <?= $this->Html->link(__('Revenir à la liste'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="editions view content">
            <h3><?= h($edition->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Titre') ?></th>
                    <td><?= h($edition->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($edition->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Année scolaire') ?></th>
                    <td><?= h($edition->schoolYear) ?></td>
                </tr>
                <tr>
                    <th><?= __("Nombre d'étudiants maximum") ?></th>
                    <td><?= $this->Number->format($edition->nbStudentMax) ?></td>
                </tr>
                <tr>
                    <th><?= __("Nombre d'étudiants minimum") ?></th>
                    <td><?= $this->Number->format($edition->nbStudentMin) ?></td>
                </tr>
                <tr>
                    <th><?= __('Créée') ?></th>
                    <td><?= h($edition->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifiée') ?></th>
                    <td><?= h($edition->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __($this->Html->link('Echéances', ['controller' => 'deadlines', 'action' => 'index', $edition->id], ['class' => 'button'])) ?></th>
                    <td>
                        <table>
                            <tr>
                                <th>Titre</th>
                                <th>Début</th>
                                <th>Fin</th>
                            </tr>
                            <?php foreach ($deadlines as $d) : ?>
                                <tr>
                                    <td>
                                        <?= $d->title ?>
                                    </td>
                                    <td>
                                        <?= h($d->startdate) ?>
                                    </td>
                                    <td>
                                        <?= h($d->enddate) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <?= $this->Html->link('Tout voir', ['controller' => 'deadlines', 'action' => 'index', $edition->id], ['class' => 'button']) ?>
                        <br>
                        <ul class="pagination">
                            <?= $this->Paginator->prev("<<") ?>
                            <?= $this->Paginator->numbers() ?>
                            <?= $this->Paginator->next(">>") ?>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th><?= __($this->Html->link('Photos', ['controller' => 'files', 'action' => 'index', $edition->id], ['class' => 'button'])) ?></th>
                    <td>

                        <div id="carouselExampleControls" class="carousel carousel-dark slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                $active = true;
                                foreach ($images as $i) {
                                    if ($active) {
                                        echo '<div class="carousel-item active">
                                                                ' . $this->Html->image($i->name, [
                                            'width' => 400,
                                            'height' => 'auto',
                                            'class' => 'd-block w-100'
                                        ]) . '
                                        </div>';
                                        $active = false;
                                    } else {
                                        echo '<div class="carousel-item">
                                                                ' . $this->Html->image($i->name, [
                                            'width' => 400,
                                            'height' => 'auto',
                                            'class' => 'd-block w-100'
                                        ]) . '
                                        </div>';
                                    }
                                }
                                ?>

                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

    </div>
</div>