<?php

class login extends ACore{
	
	protected function obr() {
		$login = strip_tags(mysql_real_escape_string($_POST['login'])); //strip_tags -Удаляет HTML и PHP тэги из строки
		$password = strip_tags(mysql_real_escape_string($_POST['password']));

		if(!empty($login) AND !empty($password)) {
			$password = md5($password);
			$query = "SELECT id FROM users WHERE login='$login' AND pass = '$password'";
			
			if(!$result = mysql_query($query)) {
				exit(mysql_error());//exit - выводит сообщение и прекращает выполнение текущего скрипта.
			}
			
			if(mysql_num_rows($result) == 1) {
				$_SESSION['user'] = 'REG';
				header("Location:?option=admin");
				exit;
			}
			else {
				exit("Такого пользователя нет");
			}
		}
		else {
			exit("Заполните обязательные поля");
		}
	}
	
	public function get_content() {
		echo "<div id='main'>";
		
print <<<ECHO
<form action='' method='POST'>
<p>Login:<br />
<input type='text' name='login'>
</p>
<p>Password:<br />
<input type='password' name='password'>
</p>
<p>
<p><input type='submit' name='button' value='Войти'></p></form>
ECHO;
		echo "</div></div>";		
	}
}
?>