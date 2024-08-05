<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\web\View;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
$this->registerJsFile('https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js', ['position' => View::POS_END]);
$this->registerCssFile('https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script src="https://kit.fontawesome.com/b5c7161fc1.js" crossorigin="anonymous"></script>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php if (!Yii::$app->user->isGuest): ?>
        <?php
        NavBar::begin([
            'brandLabel' => 'Punto de Venta',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'encodeLabels' => false,
            'items' => [
                ['label' => '<i class="fas fa-home"></i> Inicio', 'url' => ['/site/index']],
                '<li class="nav-item">'
                    . Html::beginForm(['login/logout'])
                    . Html::submitButton(
                        '<i class="fas fa-sign-out-alt"></i> Salir (' . Yii::$app->user->identity->NombreCompleto . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
            ]
        ]);
        NavBar::end();
        ?>
    <?php endif; ?>
</header>


<main id="main" class="flex-shrink-0" role="main">
    <div class="container-fluid">
        <?php if (!Yii::$app->user->isGuest): ?>
            <?php if (!empty($this->params['breadcrumbs'])): ?>
                <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
            <?php endif; ?>
        <?php endif; ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="bg-body-tertiary text-center">
  <!-- Grid container -->
  <div class="container p-4"></div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
    <a class="text-body">&copy; ASTRA IT <?= date('Y') ?></a>
  </div>
  <!-- Copyright -->
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
