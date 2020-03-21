<?php
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
/* @var $user \shop\entities\User\User */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset="<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <table width="100%">
        <thead align="center">
        <tr>
            <td>
                <img src="https://manufacture17.com.ua/uploads/logo/Manufacture-2-300x98.png" alt="" />
                <h1>Здравствуйте!</h1>
            </td>
        </tr>
        </thead>
        <tbody align="center">
        <tr>
            <td align="center">

                <?= $content ?>

            </td>
        </tr>
        </tbody>
        <tfoot align="center">
        <tr>
            <td>
                <img src="https://manufacture17.com.ua/uploads/logo/Manufacture-2-300x98.png" alt="" />
            </td>
        </tr>
        </tfoot>
    </table>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
