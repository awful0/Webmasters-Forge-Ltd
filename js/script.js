document.body.style.zoom=screen.width*100/1920+'%';
/***
	Анимация фона
***/
$(function(){
	var i = 1;
	setInterval(function(){
		startAnimation();
	}, 10000);

	function startAnimation(){

		$("#fonbg img").animate({
			'opacity': 0
		}, 2000, function(){
			$("#fonbg img").attr('src','/images/im'+((i>7)? i = 1 : i++)+'.jpg');
			$("#fonbg img").animate({
				'opacity': 1
			}, 1500);
		});
	}
});

