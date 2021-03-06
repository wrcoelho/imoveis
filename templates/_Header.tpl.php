<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-Frame-Options" content="deny">
		<base href="<?php $this->eprint($this->ROOT_URL); ?>" />
		<title><?php $this->eprint($this->title); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="Imoveis" />
		<meta name="author" content="phreeze builder | phreeze.com" />

		<!-- Le styles -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link href="styles/style.css" rel="stylesheet" />
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link href="bootstrap/css/font-awesome.min.css" rel="stylesheet" />
		<!--[if IE 7]>
		<link rel="stylesheet" href="bootstrap/css/font-awesome-ie7.min.css">
		<![endif]-->
		<link href="bootstrap/css/datepicker.css" rel="stylesheet" />
		<link href="bootstrap/css/timepicker.css" rel="stylesheet" />
		<link href="bootstrap/css/bootstrap-combobox.css" rel="stylesheet" />
		
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Le fav and touch icons -->
		<link rel="shortcut icon" href="images/favicon.ico" />
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/apple-touch-icon-114-precomposed.png" />
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/apple-touch-icon-72-precomposed.png" />
		<link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon-57-precomposed.png" />

		<script type="text/javascript" src="scripts/libs/LAB.min.js"></script>
		<script type="text/javascript">
			$LAB.script("scripts/libs/jquery-1.8.2.min.js").wait()
				.script("bootstrap/js/bootstrap.min.js")
				.script("bootstrap/js/bootstrap-datepicker.js")
				.script("bootstrap/js/bootstrap-timepicker.js")
				.script("bootstrap/js/bootstrap-combobox.js")
				.script("scripts/libs/underscore-min.js").wait()
				.script("scripts/libs/underscore.date.min.js")
				.script("scripts/libs/backbone-min.js")
				.script("scripts/app.js")
				.script("scripts/model.js").wait()
				.script("scripts/view.js").wait()
		</script>

	</head>

	<body>

			<div class="navbar navbar-inverse navbar-fixed-top">
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						<a class="brand" href="./">Imoveis</a>
						<div class="nav-collapse collapse">
							<ul class="nav">
								<?php if (isset($this->currentUser)) { ?>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> Admin Usu&aacute;rios <i class="caret"></i></a>
									<ul class="dropdown-menu">
										<li <?php if ($this->nav=='users') { echo 'class="active"'; } ?>><a href="./users">Usu&aacute;rios</a></li>
										<li <?php if ($this->nav=='roles') { echo 'class="active"'; } ?>><a href="./roles">Fun&ccedil;&otilde;es</a></li>
									</ul>
								</li>
								<?php } ?>
								<li <?php if ($this->nav=='imovels') { echo 'class="active"'; } ?>><a href="./imovels">Imovels</a></li>
								<li <?php if ($this->nav=='tipoimovels') { echo 'class="active"'; } ?>><a href="./tipoimovels">TipoImovels</a></li>
								</ul>
								</li>
							</ul>
							<ul class="nav pull-right">
								<li class="dropdown">
								<?php if (isset($this->currentUser)) { ?>
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> Bem Vindo <?php $this->eprint($this->currentUser->Username); ?> <i class="caret"></i></a>
								<?php } else { ?>
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-lock"></i> Login <i class="caret"></i></a>
								<?php } ?>	
								<ul class="dropdown-menu">
									<?php if (isset($this->currentUser)) { ?>
										<li><a href="./logout">Logout</a></li>
									<?php } else { ?>
										<li><a href="./loginform">Login</a></li>
									<?php } ?>	
								</ul>
								</li>
							</ul>
						</div><!--/.nav-collapse -->
					</div>
				</div>
			</div>