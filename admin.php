<?php
	require_once('fns_ifts.php'); 
	session_start();

	if ($_POST['username'] && $_POST['passwd'])
	{
    	$username = $_POST['username'];
	    $passwd = $_POST['passwd'];
//		echo ("U: $username");
//		echo ("P: $passwd");


	    if (login($username, $passwd))
    	{
      		$_SESSION['admin_user'] = $_POST['username'];
    	}  
    	else
    	{
      		do_html_header('Problemas:');
      		echo 'Atencion : 
            	Usted debe logearse para ver esta página.<br />';
      		do_html_url('login.php', 'Login','');
      		do_html_footer();
      		exit;
    	}      
	}

	do_html_header('Administracion');
		echo 'Administrador : '.$_SESSION['admin_user'] ;
		display_admin_menu();

	do_html_footer();

?>