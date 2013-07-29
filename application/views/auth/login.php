<!DOCTYPE html><!-- doctype do HTML5 -->
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="pt-BR" class="no-js"><!-- A classe 'no-js' é reconhecida pelo javascript modernizr, permitindo que browsers antigos reconheçam corretamente nossas tags -->
<!--<![endif]-->
    <head>
        <meta charset="utf-8">
        		
        <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- Importante para habilitar os recursos de Responsividade em conjunto com o CSS -->
		
		<title>Primeira página utilizando o framework Twitter Bootstrap</title>
		
		<script src="js/jquery-1.8.1.js"></script>
        <script src="js/bootstrap.js"></script>
		<script src="js/modernizr-2.6.1.min.js"></script>
		        
		<link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/main.css">
        
        <?php echo HTML::style('media/css/bootstrap.css'); ?>
        <?php echo HTML::style('media/css/main.css'); ?>
        
</head>
<body>
		
        <!--[if lt IE 7]>
            <p class="chromeframe">Você está usando um brower desatualizado. <a href="http://browsehappy.com/">Atualize seu browser</a> ou <a href="http://www.google.com/chromeframe/?redirect=true">instale Google Chrome Frame</a> para melhor visualizar este site.</p>
        <![endif]-->

        <!-- Código retidado de http://twitter.github.com/bootstrap/examples/hero.html -->
		
		<!-- Início da barra de navegação -->
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">Seu nome</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li class="active"><a href="index.html" title="Página inicial">Home</a></li>
							<li><a href="#" title="" rel="nofollow">Link 1</a></li>
                            <li><a href="#" title="" rel="nofollow">Link 2</a></li>
                            <li><a href="#" title="" rel="nofollow">Link 3</a></li>
                            <li><a href="#" title="#">Contato</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
               </div>
           </div>
        </div>
		<!-- Fim da barra de navegação -->
        <!-- Início do container para a classe 'hero-unit' -->
		<div class="container-fluid hero">

            <!-- Hero unit para o showcase -->
            <div class="hero-unit">
				<h1>Título</h1>
				<br />
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<p><a href="#" class="btn btn-primary btn-large" rel="" title="">Saiba mais &raquo;</a></p>
            </div>
		</div> <!-- /container hero -->
		
		<div class="container-fluid submenu"><!-- Submenu -->
			<div class="row-fluid">
				<div class="span12">
					<p>Aqui podemos colocar um submenu, ou até mesmo utilizar Breadcrumbs!</p>
				</div>
			</div>
		</div><!-- /Submenu -->
		<!-- Aqui colocaremos nosso container e uma linha com 3 colunas -->
		<div class="container-fluid">
            <div class="row-fluid">
                <div class="span4">
                    <h2>Título</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p><a class="btn" href="#" title="">Veja mais &raquo;</a></p>
                </div>
                <div class="span4">
                    <h2>Título</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p><a class="btn" href="#" title="">Veja mais &raquo;</a></p>
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
               </div>
                <div class="span4">
                    <h2>Título</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p><a class="btn" href="#" title="">Veja mais &raquo;</a></p>
                </div>
            </div>
        </div> <!-- /container 2-->
            <hr>
		<div class="container-fluid rodape">
			<div class="row-fluid">
				<div class="span3 footer">
					<h4>Links</h4>
					<ul>
						<li><a href="" title="Ruby on Rails" rel="nofollow">Linha de Código</a></li>
						<li><a href="" title="jQuery" rel="nofollow">jQuery</a></li>
						<li><a href="" title="LESS CSS" rel="nofollow">LESS CSS</a></li>
						<li><a href="" title="Wordpress" rel="nofollow">Wordpress</a></li>
						<li><a href="" title="Joomla" rel="nofollow">Joomla</a></li>
					</ul>
				</div>
				<div class="span3 footer">
					<h4>Links</h4>
					<ul>
						<li><a href="" title="W3C" rel="nofollow">W3C</a></li>
						<li><a href="" title="W3schools" rel="nofollow">W3Schools</a></li>
						<li><a href="" title="PHP Oficial" rel="nofollow">PHP.net</a></li>
						<li><a href="" title="MySQL" rel="nofollow">MySQL</a></li>
						<li><a href="" title="Bootstrap" rel="nofollow">Bootstrap</a></li>
					</ul>
				</div>
				<div class="span3 footer">
					<h4>Links</h4>
					<ul>
						<li><a href="" title="" rel="nofollow">Link</a></li>
						<li><a href="" title="" rel="nofollow">Link</a></li>
						<li><a href="" title="" rel="nofollow">Link</a></li>
						<li><a href="" title="" rel="nofollow">Link</a></li>
						<li><a href="" title="" rel="nofollow">Link</a></li>
					</ul>
				</div>
				<div class="span3 footer">
					<h4>Citação da semana</h4>
					<cite class="pull-right">"Dá-se muita atenção ao custo de se realizar algo. E nenhuma ao custo de não realizá-lo."<br />Philip Kotler</cite>
				</div>
			</div>
		</div>
		<div class="container-fluid copyright">
            <footer>
                <p><a href="#" title="#">&copy; Fulano de tal - 2012</a></p>
            </footer>
		</div>
		<!-- Script para o Google Analytics-->
        <script>
            var _gaq=[['_setAccount','xxxxxxxxxxxxxx'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>
