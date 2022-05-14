<?php
	require_once('fns_ifts.php');
	session_start();
	do_html_header('Administracion');
	display_login_form();
	do_html_footer();
?>
