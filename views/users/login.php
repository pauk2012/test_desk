<form action='?r=users/login' method="POST">
    <p>
    <label>Username
    <input name="username" /></label>
    </p>
    <p>
    <label>Password
        <input name="password" /></label>
    </p>
    <p>
    <input type="submit" />
    </p>
</form>

<a href="<?php echo \helpers\Url::to(['users/register'])?>">Register</a>