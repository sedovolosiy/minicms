<?php
abstract class ACore_Admin {
	
	
	protected $db;
	
	public function __construct() {
		
		if(!$_SESSION['user']) {
			header("Location:?option=login");
		}
	
		$this->db = mysql_connect(HOST,USER,PASSWORD);
		if(!$this->db) {
			exit("Ошибка соединения с базой данных".mysql_error());
		}
		if(!mysql_select_db(DB,$this->db)) {
			exit("Нет такой базы данных".mysql_error());
		}
		mysql_query("SET NAMES 'UTF8'");
		
	}
	
	protected function get_header() {
		include "tpl/header.php";
	}
	
	protected function get_left_bar() {
	
		echo '<div class="quick-bg">
				<div id="spacer" style="margin-bottom:15px;">
					<div id="rc-bg">Разделы админки</div>
				</div>';
			
		echo"<div class='quick-links'>
					» <a href='?option=admin'>Статьи</a>
					</div>";
					
		echo"<div class='quick-links'>
					» <a href='?option=edit_menu'>Меню</a>
					</div>";
		echo"<div class='quick-links'>
					» <a href='?option=edit_category'>Категории</a>
					</div>";						
		echo "</div>";		
		
	}
	
	protected function get_menu() {
		
		echo '<div id="mainarea">
			<div class="heading"></div>';			
	}
	
	protected function get_footer() {
		
		echo "<div id='bottom'>";
		$i = 1;
		echo '</div>
		            <div class="copy"><span class="style1"> Copyright 2010 Название сайта </span>

		</div>
	</div>
</center></body></html>';
	}
	
	
	public function get_body() {

		if ($_POST || (isset($_GET['del']) && !empty($_GET['del']))) {
			$this->obr();
		}
		$this->get_header();
		$this->get_left_bar();
		$this->get_menu();
		$this->get_content();
		$this->get_footer();
	}
	
	abstract function get_content();
	
	protected function get_categories() {
		$query = "SELECT id_category, name_category FROM category";
		$result = mysql_query($query);
		if(!$result) {
			exit(mysql_error());
		}
		$row = array();
		for($i = 0; $i < mysql_num_rows($result);$i++) {
			$row[] = mysql_fetch_array($result,MYSQL_ASSOC);
		}
		
		return $row;
	}
	
	protected function get_text_statti($id) {
		$query = "SELECT id,title,img_src,discription,text,cat FROM statti WHERE id='$id'";
		$result = mysql_query($query);
		if(!$result) {
			exit(mysql_error());
		}
		$row = array();
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		
		return $row;
	}
	
	protected function get_text_menu($id) {
		$query = "SELECT id_menu,name_menu,text_menu FROM menu WHERE id_menu = '$id'";
		$result = mysql_query($query);
		if(!$result) {
			exit(mysql_error());
		}
		$row = array();
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		return $row;
	}
	
	protected function get_text_category($id) {
		$query = "SELECT id_category,name_category FROM category WHERE id_category = '$id'";
		$result = mysql_query($query);
		if(!$result) {
			exit(mysql_error());
		}
		$row = array();
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		return $row;
	}
}

?>