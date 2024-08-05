<?php

/** @var yii\web\View $this */
use yii\web\View;
$this->title = 'My Yii Application';
?>

<?php 
$session = Yii::$app->session;
$usuario = $session->get('usuario', 'Usuario');
if ($session->isActive) {
    // Verifica si la variable de sesión 'alert_shown' no está establecida
    if (!$session->has('alert_shown')) {
        $frases = [
            '¡Que tengas un excelente día!',
            'Estamos felices de tenerte con nosotros.',
            '¡Gracias por visitarnos!',
            'Esperamos que disfrutes tu experiencia.',
            '¡Tu presencia es importante para nosotros!'
        ];
        // Selecciona una frase aleatoria
        $fraseAleatoria = $frases[array_rand($frases)];
        $js = <<<JS
        $(document).ready(function() {
            Swal.fire({
                title: '¡Bienvenido, $usuario!',
                text: '$fraseAleatoria',
                icon: 'info',
                confirmButtonText: 'OK'
            });
        });
        JS;
        $this->registerJs($js);

        // Define una acción en el controlador para establecer la variable de sesión
        $session->set('alert_shown', true);
    }
}
?>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="https://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4 mb-3">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="https://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4 mb-3">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="https://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="https://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
