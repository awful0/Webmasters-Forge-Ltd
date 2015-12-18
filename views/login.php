<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title><?=$langMass['HELLOGL']?></title>
	<link href="/style/login.css" type="text/css" rel="stylesheet">
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="/config/<?=$langMass['PREF']?>.js"></script>
<body>
<script type="text/javascript" src="/js/script.js"></script>
<div id="fonfg"></div>
<div id="fonbg"><img src="/images/im2.jpg"></div>
<div class="wrapper">
	<?php 
		($err) && print '<div class="messError">'.$err.'</div>';
		($mess) && print '<div class="messages">'.$mess.'</div>';
	?>
	<div id="lang">
		<div>
			<a><?=$langMass['LANG']?></a>
			<span>&#9660;</span>
			<div>
				<ul>
					<a href="index.php?lang=ru"><li>Русский</li></a>
					<a href="index.php?lang=en"><li>English</li></a>
				</ul>
			</div>
		</div>
	</div>
	<div id="inputBlock" class="lBlock">
		<form method="post" action="index.php">
			<input type="hidden" id="token" value="<?=$token?>" name="token">
			<input type="text" placeholder="<?=$langMass['NAMEOREMAIL']?>" name="name">
			<input type="password" id="input"\ placeholder="<?=$langMass['PASS']?>" name="password">
			<p><?=$langMass['REMEMBER']?>
				<input type="checkbox" name="scookies" value="yes">
				<input type="submit" value="<?=$langMass['LOGIN']?>" name="login">
			</p>
		</form>
		<div class="error"></div>
	</div>

	<div id="regBlock" class="lBlock">
		<h3><?=$langMass['HELLO']?></h3><p><?=$langMass['TEXTFORHELLO']?></p>
		<form enctype="multipart/form-data" method="post" action="index.php">
			<input type="hidden" value="<?=$token?>" name="token">
			<input type="text" placeholder="<?=$langMass['NAME']?>" name="name">
			<input type="email" placeholder="<?=$langMass['EMAIL']?>" name="email">
			<input type="password" placeholder="<?=$langMass['PASS']?>" name="password">
			<div class="margin">
				<p>
					<span id="spanfile"><?=$langMass['AVATAR']?></span>
					<input type="hidden" name="MAX_FILE_SIZE" value="102400" />
					<div class="fileinput" title="<?=$langMass['DOWNAVATAR']?>">
						<div class="fileinputV">...</div>
						<input type="file" name="image" id="file" size="1" style="">
					</div>
					<br><br>
					<input type="submit" value="<?=$langMass['SIGNUP']?>" name="registration">
				</p>
			</div>
		</form>
		<div class="error"></div>
		<div id="inform">
			<span>&#063;</span>
			<div class="info"><?=$langMass['INFO']?></div>
		</div>
	</div>
</div>
</body>
<script type="text/javascript" src="/js/login.js"></script>
</html>