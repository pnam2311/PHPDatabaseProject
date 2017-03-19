<?php
	$con = pg_connect("host=localhost port=5432 dbname=class_project user=postgres password=admin");
	if(!$con){
		die("Không thể kết nối!");
	}
?>
