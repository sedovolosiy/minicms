<?php

class login extends ACore
{

    protected function obr()
    {
        $login = strip_tags(mysql_real_escape_string($_POST['login']));
        $password = strip_tags(mysql_real_escape_string($_POST['password']));

        if (!empty($login) AND !empty($password)) {
            $password = md5($password);
            $query = "SELECT id FROM users WHERE login='$login' AND pass = '$password'";

            if (!$result = mysql_query($query)) {
                exit(mysql_error());//exit - выводит сообщение и прекращает выполнение текущего скрипта.
            }

            if (mysql_num_rows($result) == 1) {
                $_SESSION['user'] = 'REG';
                header("Location:?option=admin");
                exit();
            } else {
                exit("Такого пользователя нет");
            }
        } else {
            exit("Заполните обязательные поля");
        }
    }

    public function get_content()
    {
    }
}
