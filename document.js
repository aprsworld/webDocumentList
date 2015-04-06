/*
 * Image preview script 
 * powered by jQuery (http://www.jquery.com)
 * 
 * written by Alen Grakalic (http://cssglobe.com)
 * 
 * for more info visit http://cssglobe.com/post/1695/easiest-tooltip-and-image-preview-using-jquery
 *
 */
 
this.imagePreview = function(){	
	/* CONFIG */
		
		xOffset = 10;
		yOffset = 10;
		
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result
		
	/* END CONFIG */
	$("a.preview").hover(function(e){
		this.t = this.title;
		this.title = "";	
		var c = (this.t != "") ? "<br/>" + this.t : "";
		//$("body").append("<p id='preview'><img src='"+ this.href +"' alt='Image preview' />"+ c +"</p>");								 

		/* get filename only and then prefix with preview/ 
		and postfix with preview640.png */
		var fileExtension = this.href.substr(this.href.length-3);
		if ( 'jpg'!=fileExtension )
			fileExtension='png';

		var previewBig = this.href.substr(this.href.lastIndexOf('/')+1);
		previewBig = previewBig.substr(0,previewBig.length-3);
		previewBig = "previews/" + previewBig + "preview640." + fileExtension;

		
		$("body").append("<p id='preview'>Click image to view full size document.<br /><img src='"+ previewBig +"' alt='Image preview' />"+ c +"</p>");								 

		$("#preview")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("fast");						
    },
	function(){
		this.title = this.t;	
		$("#preview").remove();
    });	
	$("a.preview").mousemove(function(e){
		$("#preview")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});			
};


// starting the script on page load
$(document).ready(function(){
	imagePreview();
});
