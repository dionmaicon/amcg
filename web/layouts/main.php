<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\SiteAsset;

AppAsset::register($this);
SiteAsset::register($this);

if (isset($_GET['p']))
    $page = explode('.', $_GET['p']);
else
    $page = ["home", "home"];
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?= Html::csrfMetaTags() ?>
        <?php if (sizeof($page) > 2) { ?>
            <title>AMCG | Home</title>
        <?php } else { ?>
            <title>AMCG | <?= $page[0]; ?></title>
        <?php }$this->head() ?>
    </head>
    
    <body>
        <?php $this->beginBody() ?>
            <!--<div class="wrap">-->

                <?php
                    require_once "includes/menu.php";

                    if (isset($_GET['p']))
                        require_once "pages/" . $_GET['p'] . "";
                    else
                        require_once "pages/home.php";
                ?>  

            <!--</div>-->
            <footer class="footer" style="height: auto; background: #8FBC8F; color: #fff;font-weight: bold;">
                <p><center>Rua Ataulfo Alves, 351 - Jardim América</center></p>
                <p><center>Ponta Grossa - PR, 84050 - 360, Brasil</center></p><br>
            </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>