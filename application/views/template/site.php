<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title><?php echo $title; ?></title>
	</head>
	<body>
		Funcionalidades:<br />
		<?php 
			echo HTML::anchor('Welcome', 'Home');
			echo '&nbsp;';
			echo HTML::anchor('SYS_Profile', 'Perfil');
			echo '<br /><br /><br /><br />';
			echo $body;
		?>
	</body>
</html>