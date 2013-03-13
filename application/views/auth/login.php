<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title><?php echo $title; ?></title>
	</head>
	<body>
		<?php 
			echo form::open($action, array('method' => 'post'));
			echo 'Usuário:<br />';
			echo form::input('txtUser');
			echo '<br />Senha:<br />';
			echo form::password('txtPassword');
			echo '<br /><br />';
			echo form::submit('btnLogin', 'Login');
			echo form::close();
		?>
	</body>
</html>