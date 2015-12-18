<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title><?=$langMass['HELLO']. ' ' .$mass[0]['name']?></title>
	<link href="/style/users.css" type="text/css" rel="stylesheet">
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<body>
<script type="text/javascript" src="/js/script.js"></script>
<div id="fonfg"></div>
<div id="fonbg"><img src="/images/im7.jpg"></div>
<div class="wrapper">
	<div class="content"><a href="/index.php?reg=false" id="close" title="<?=$langMass['LOGOUT']?>">&times;</a>
		<h2><?=$langMass['HELLO']. ' ' .$mass[0]['name']?></h2>
		<div class="lcont">
			<img src="/images/users/<?=$mass[0]['name'].'/'.$mass[0]['avatar']?>">
		</div>
		<div class="rcont">
			<p><?=$langMass['REG']. ': ' .$mass[0]['date']?></p>
			<p>email: <?=$mass[0]['email']?></p>
		</div>
		<div class="clear"></div>
	</div>
</div>
</body>
</html>