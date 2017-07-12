<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header" style="background: #4F4F4F;">
    
    <?= Html::a('<span style="background: #000;" class="logo-mini">ADM</span><span class="logo-lg" style="background:#357ca5;">Área Administrativa</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>
    

    <nav class="navbar navbar-static-top" role="navigation" style="background: #3b8ab8;">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" style="background: #4F4F4F;">
            <span class="sr-only">Toggle navigation</span>
        </a>    

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav" style="background: #3b8ab8;">
               
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="background: #363636;">
                        <span class="hidden-xs"><?= Yii::$app->user->identity->username;?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header" style="background: #363636;">
                           <b>
                                <?= Yii::$app->user->identity->username;?>
                            </b></p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="/funcionario/passwd" class="btn btn-default btn-flat">Alterar senha</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sair',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
                
            </ul>
        </div>
    </nav>

</header>



