$(function(){
	$(document).on("click touchend", ".svg_contain", function(e){

		var $this = $(this);

		var $code_div = $this.children('.code');

		$code_div.select();

		document.execCommand('copy');

		$this.addClass('copied');
		setTimeout(function(){ $this.removeClass('copied'); }, 3000);
	});
});