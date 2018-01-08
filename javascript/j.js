$(".menu a").filter(function(){
    return this.href == location.href.replace(/#.*/, "");
}).addClass("active");

$(function() {
		$('.pop').on('click', function() {
			$('.imagepreview').attr('src', $(this).find('img').attr('src'));
			var alt = $(this).children("img").attr("alt");
			$('#' + alt).modal('show'); 



		});		
});