<h1>Список Объявлений</h1>

<?php foreach ($items as $item): ?>

    <p><?php echo $item['title'] ?> by <?php echo \models\User::findUserById($item['owner'])->username?> at <?php  echo date('Y:m:d' ,\models\User::findUserById($item['owner'])->date_created)?></p>

<?php endforeach;?>
<a href="<?php echo \helpers\Url::to(['items/create'])?>">Create new</a>
