<?php
class admin extends ACore_Admin {
	
	public function get_content() {
		
		$query = "SELECT id,title FROM statti";
		$result = mysql_query($query);
		if(!$result) {
			exit(mysql_error());
		}
		
		echo "<div id='main'>";
		echo "<a style='color:red' href='?option=add_statti'>Добавить новую ствтью</a><hr>";
		if($_SESSION['res']) {
			echo $_SESSION['res'];
			unset($_SESSION['res']);
		}
		
		$row = array();
		for($i = 0; $i < mysql_num_rows($result);$i++) {
			$row = mysql_fetch_array($result,MYSQL_ASSOC);
			printf("<p style='font-size:14px;'>
						<a style='color:#585858' href='?option=update_statti&id_text=%s'>%s</a> |
						<a style='color:red' href='?option=delete_statti&del=%s'>Удалить</a>
					</p>",$row['id'],$row['title'],$row['id']);
		}
		
		echo '</div>
			</div>';
	}
}
?>