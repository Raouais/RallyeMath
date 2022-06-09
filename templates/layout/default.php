<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$isConnected = isset($_SESSION['Auth']);
$isAdmin = null;
if($isConnected) $isAdmin = $_SESSION['Auth']->isAdmin === 1;
$cakeDescription = 'RALLYE MATHÉMATIQUE';
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="home">
                <?= $this->Html->image("Logo/LOGO_rallye_math.JPG", [
                    "width" => 80,
                    "alt" => "HERS",
                    "url" => ['controller' => 'pages', 'action' => 'home']
                ]) ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <?= $this->Html->link(
                            __('Editions'),
                            ['controller' => 'editions', 'action' => 'index'],
                            ['class' => 'nav-link active', 'aria-current' => 'page']
                        ) ?>
                    </li>
                    <?php if ($isConnected) : ?>
                        <?php if ($isAdmin !== null && !$isAdmin): ?>
                        <li class="nav-item">
                            <?= $this->Html->link(__('Mes Inscriptions'), ['controller' => 'registrations', 'action' => 'all'], ['class' => 'nav-link']) ?>
                        </li>
                        <li class="nav-item">
                            <?= $this->Html->link(__('Mon compte'), ['controller' => 'users', 'action' => 'index'], ['class' => 'nav-link']) ?>
                        </li>
                        <?php elseif($isAdmin !== null && $isAdmin):?>
                            <li class="nav-item">
                                <?= $this->Html->link(__('Inscriptions'), ['controller' => 'registrations', 'action' => 'all'], ['class' => 'nav-link']) ?>
                            </li>
                            <li class="nav-item">
                                <?= $this->Html->link(__('Comptes'), ['controller' => 'users', 'action' => 'index'], ['class' => 'nav-link']) ?>
                            </li>
                        <?php endif?>
                    <?php endif ?>
                    <?php if ($isAdmin !== null && !$isAdmin): ?>
                        <li class="nav-item">
                            <?= $this->Html->link(__('Mon école'), ['controller' => 'schools', 'action' => 'index'], ['class' => 'nav-link']) ?>
                        </li>
                        <li class="nav-item">
                            <?= $this->Html->link(__('Mes élèves'), ['controller' => 'students', 'action' => 'index'], ['class' => 'nav-link']) ?>
                        </li>
                    <?php elseif($isAdmin !== null && $isAdmin): ?>
                            <li class="nav-item">
                                <?= $this->Html->link(__('Ecoles'), ['controller' => 'schools', 'action' => 'index'], ['class' => 'nav-link']) ?>
                            </li>
                            <li class="nav-item">
                                <?= $this->Html->link(__('Elèves'), ['controller' => 'students', 'action' => 'index'], ['class' => 'nav-link']) ?>
                            </li>
                    <?php endif ?>
                    <?php if (!$isConnected) : ?>
                        <li class="nav-item">
                            <?= $this->Html->link(__('S\'enregistrer'), ['controller' => 'users','action' => 'add'], ['class' => 'nav-link']) ?>
                        </li>
                    <?php endif ?>
                    <?php if (!$isConnected) : ?>
                        <li class="nav-item">
                            <?= $this->Html->link(
                                __('Se connecter'),
                                ['controller' => 'users', 'action' => 'login'],
                                ['class' => 'nav-link']
                            ) ?>
                        </li>
                    <?php endif ?>
                </ul>
                <?php if ($isConnected) : ?>
                    <span class="navbar-text">
                        <?= $this->Html->link(
                            __('Se déconnecter'),
                            ['controller' => 'users', 'action' => 'logout']
                        ) ?>
                    </span>
                <?php endif ?>
                <span class="navbar-text">
                    <?= $this->Html->image("Logo/Logo/LOGO GENERAL/LOGO-Blanc-FondTransp.png", [
                        "width" => 80,
                        "alt" => "HERS",
                    ]); ?>
                </span>
            </div>
        </div>
    </nav>

    <main class="main" style="padding-bottom: 2.5rem">
        <div class="container">
            <br>
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <div class="container-fluid" style="margin-top: auto;">
        <footer id="footer" class="py-3 my-4 bg-dark ">
            <!-- <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
            </ul> -->
            <p class="text-center text-muted">© 2022 HERS, Site Web réalisé par un étudiant en informatique.</p>
        </footer>
    </div>
</body>

</html>