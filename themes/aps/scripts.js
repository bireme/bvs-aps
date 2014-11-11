$ = jQuery;

$(function(){
	
	// PRODUTOS
	// pega imagens
	var a = $(".img-item");

	// remove box com imagens
	$(".img-item").each(function(){
		if($(this).length > 0) {
			$(this).remove();
		}
	});

	// adiciona imagens dentro dos outros boxes
	$(".home .widget_links").each(function(num){
		$(this).html("<p>"+a[num].outerHTML+"</p>" + $(this).html());
	});
});

function search_submit() {
	$("#searchForm").submit();
}
