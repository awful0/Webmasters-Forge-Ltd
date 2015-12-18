$(function(){

	// шаблоны
	var patternName=/^[a-zA-Z0-9_-]{4,15}$/i;
	var patternEmail=/^[a-zA-Z0-9_-]{2,20}@[a-zA-Z0-9_-]{2,30}\.[a-zA-Z]{2,8}$/i;
	
	// проверка имени пользователя при логине
	$('#inputBlock input[type=password]').focus(function(){
		
		(!patternName.test($('#inputBlock input[type=text]').val()) &&
			!patternEmail.test($('#inputBlock input[type=text]').val())
			) &&
		$('#inputBlock .error').css({'opacity': 1, 'top': '14px'}).html(langmass[0]) ||
		$('#inputBlock .error').css({'opacity': 0});
		

	});

	// проверка имени пользователя при регистрации
	$('#regBlock input[type=email]').focus(function(){
		
		(!patternName.test($('#regBlock input[type=text]').val())) &&
		$('#regBlock .error').css({'opacity': '1', 'top': '74px'}).html(langmass[0]) ||
		$('#regBlock .error').css({'opacity': 0});
	
	});
	
	// проверка email пользователя при регистрации
	$('#regBlock input[type=password]').focus(function(){
		
		(!patternEmail.test($('#regBlock input[type=email]').val())) &&
			$('#regBlock .error').css({'opacity': '1', 'top': '114px'}).html(langmass[1]) ||
		$('#regBlock .error').css({'opacity': 0});

	});


	// Проверяем размер файла
	function validateSize(imagefile) {
	    var obj;
	  	obj = (typeof ActiveXObject == "function") ? (new ActiveXObject("Scripting.FileSystemObject")).getFile(imagefile.value) : imagefile.files[0];
	    return (obj.size < 102400)? true : false;
	}

	 $('input[type=file]').on('change', function(){
	    var fileName = $(this).val();
	    var patternImage = /\.(gif|jpg|png)$/i;
	    var status = patternImage.test(fileName);
	    $("#spanfile").text(fileName);
	    
	    if (!status)
	    	$('#regBlock .error').css({'opacity': '1', 'top': '204px'}).text(langmass[2]);

	    else if (!validateSize(this))
	    	$('#regBlock .error').css({'opacity': '1', 'top': '204px'}).text(langmass[3]);
	    else
	    	$('#regBlock .error').css({'opacity': '0', 'top': '204px'});
	});

	// выбор языка

	var bl = 1;
	$('#lang div a').click(function(){
	    $('#lang div div').slideToggle(400);

		bl = (bl==1)? ($('#lang div span').html('&#9650;'), 0) :
			( $('#lang div span').html('&#9660;'), 1);

	});

	var showinf = 0
	$('#inform').click(function(){
	    showinf = (showinf==0)? ($('#inform .info').css({'opacity': 1, 'z-index': 100}), 1) :
			( $('#inform .info').css({'opacity': 0, 'z-index': -100}), 0);
	});

});
