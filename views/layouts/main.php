<html>
<head>
    <meta charset="utf-8">

</head>
<body>
<h1>Заголовок</h1>
<a href="<?php echo \helpers\Url::to(['items/index'])?>">Index</a>
<?php if (\classes\F::$app->getUser()->getId()): ?>

    <a href="<?php echo \helpers\Url::to(['users/logout'])?>">Logout</a>
    <a href="<?php echo \helpers\Url::to(['users/profile'])?>">Profile</a>
<?php else: ?>
    <a href="<?php echo \helpers\Url::to(['users/login'])?>">Login</a>
<?php endif;?>
<?php// print_r($_SESSION) ?>


</body>

<?php echo $content ?>

<h1>Подвал</h1>
</html>