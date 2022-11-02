$(document).ready(function(){
	$(".icon-top").mouseover(function(){
		$(this).css("background-color","#EEEEEE")
	});
	$(".icon-top").mouseout(function(){
		$(this).css("background-color","#ffffff")
	});

  $(function () {
    $('#tab li:first-child a').tab('show')
  });
});
