<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title><?php echo $title; ?></title>
	</head>
	<body>
		<?php 
			echo Form::open($action, array('method' => 'post'));
			echo 'Usuário:<br />';
			echo Form::input('txtUser');
			echo '<br />Senha:<br />';
			echo Form::password('txtPassword');
			echo '<br /><br />';
			echo Form::submit('btnLogin', 'Login');
			echo Form::close();
		?>
	</body>
</html>