<?php
	include "../../../wp-load.php";
	if ($_GET["action"] == "add") {
		add_to_mfsc($_GET["id"]);
	} else if ($_GET["action"] == "empty") {
		empty_mfsc();
	} else if ($_GET["action"] == "delete") {
		delete_mfsc($_GET["id"]);
	}
	header ("Location: $_SERVER[HTTP_REFERER]" );
?>