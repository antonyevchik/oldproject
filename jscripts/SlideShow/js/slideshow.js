

$(window).load(function(){

var maxContainerWidth=650; // width of main container (div#ss_container)
var maximgHeight=450; // maximal height of image in slideshow container (div#slideshow img)
var maximgWidth=maxContainerWidth-100; // maximal width of image in slideshow container (div#slideshow img)
var SlideShowHeight=650; // height of main image container (div#slideshow)
var minSlideShowHeight=400; // minimal height of main image container (div#slideshow)
var maximgLineHeight=90; // height of images line (div#imgLine)
var maxContainerHeight=SlideShowHeight+maximgLineHeight; // height of main container (div#ss_container)
var arrowHeight=80; // height of arrows in main image container
var imgSetMargin=2; // margin between images in imgSet container
var imgShiftStep=2; // step of sliding small images in imgSet container (speed of sliding) 
var imgLineArrowWidth=30; //width of arrows in bottom images line
// background gradient colors
var gr_color1="#cfcfcf";
var gr_color2="#cfcfcf";
var gr_color3="#9f9f9f";

var currentImg=0;
var imgArray=[];
var imgLine=[];
var imgHeightArray=[];
var imgWidthArray=[];
var imgSetWidth=0;
var imgSetShift=0;



$("div#slideshow img").each(function(){
	imgArray.push($(this).html(this));
	imgSrc=$(this).attr('src');
	imgLine.push(imgSrc);
	imgHeightArray.push($(this).height());
	imgWidthArray.push($(this).width());
  });

function finalAdjustment()
{
	$("div#ss_container").css({"max-width": +maxContainerWidth+"px"});
	
	$("div#imgLine, div#imgSet, div#imgSet img, div#imgLine_left, div#imgLine_right").css({"height": +maximgLineHeight+"px"});
	$("div#imgSet img").css({"margin-right":+imgSetMargin+"px"});
	
	$("div#imgLine_left, div#imgLine_right").css({"width": +imgLineArrowWidth+"px"});
	$("div#imgLine_right").css({"left": +maxContainerWidth-imgLineArrowWidth+"px"});
	$("div#rightArrow").css({"left": +maxContainerWidth-50+"px"});
	
	// setup background gradient
	$("div#ss_container").css({"background": "-webkit-radial-gradient("+gr_color1+","+gr_color2+" 3%,"+gr_color3+")",
    "background": "-o-radial-gradient("+gr_color1+","+gr_color2+" 3%,"+gr_color3+")", 
    "background": "-moz-radial-gradient("+gr_color1+","+gr_color2+" 3%,"+gr_color3+")", 
    "background": "radial-gradient("+gr_color1+","+gr_color2+" 3%,"+gr_color3+")"});
}

function imageSet(currentImg)
{
	$("div#slideshow img").animate({opacity: '0.1'}, {duration: 400});
	$("div#slideshow").html(imgArray[currentImg]);
	$("div#slideshow img").animate({opacity: '1.0'}, {duration: 400});

	var imgWidth=$("div#slideshow img").width();
	var imgHeight=$("div#slideshow img").height();
	
	//var imgWidth=imgWidthArray[currentImg];
	//var imgHeight=imgHeightArray[currentImg];
	
	if(imgWidth>imgHeight) 
	{ 
		imgHeightResized=Math.round((maximgWidth/imgWidth)*imgHeight);  
		imgWidthResized=maximgWidth;
	}
	if(imgWidth<=imgHeight) 
	{ 
		imgWidthResized=Math.round((maximgHeight/imgHeight)*imgWidth); 
		imgHeightResized=maximgHeight;
	}
	$("div#slideshow img").css({"height": +imgHeightResized+"px"}); 
	$("div#slideshow img").css({"width": +imgWidthResized+"px"}); 
	
	//$("div#slideshow img").css({"max-width": +maximgWidth+"px"});
	//$("div#slideshow img").css({"max-height": +maximgHeight+"px"});
	//$("div#slideshow").css({"min-height": +minSlideShowHeight+"px"});

	//$("div#slideshow").css({"min-height": +minSlideShowHeight+"px"});
	if(imgHeightResized<=(minSlideShowHeight-100)){SlideShowHeight=minSlideShowHeight; } else  SlideShowHeight=imgHeightResized+100;

	$("div#slideshow").animate({height: +SlideShowHeight+"px"});
	$("div#leftArrow, div#rightArrow").animate({top: +(SlideShowHeight/2)-(arrowHeight/2)+"px"});
	
	finalAdjustment();
}

	$("div#ss_container").append("<div id='leftArrow'><h1>&#10092; </h1></div> <div id='rightArrow'><h1>&#10093;</h1></div> <div id='imgLine'></div>");
	
	$("div#leftArrow").click(function(){ if(currentImg>0){ currentImg--; imageSet(currentImg); } });
	$("div#rightArrow").click(function(){ if(currentImg<imgArray.length-1) { currentImg++; imageSet(currentImg); } });
	

	
	$("div#imgLine").append("<div id='imgSet'></div> <div id='imgLine_left'><h1>&#10094;</h1></div> <div id='imgLine_right'><h1>&#10095;</h1></div>");

	for(var i=0;i<imgLine.length;i++)
	{
		var imgWidth_inSet=(maximgLineHeight/imgHeightArray[i])*imgWidthArray[i];
		imgSetWidth=imgSetWidth+imgWidth_inSet+imgSetMargin;
		imgLine[i]="<img style='width: "+imgWidth_inSet.toFixed()+"px;' src='"+imgLine[i]+"'/>";
		//alert(maximgLineHeight+" "+imgHeightArray[i]+" "+imgWidthArray[i]);
	}
	
		//imgLine.push("<div id='imgLine_left'><h1>&larr;</h1></div> <div id='imgLine_right'><h1>&rarr;</h1></div>");
	var imgs=imgLine.join(" ");
	$("div#imgSet").html(imgs);
	

	
	imgShiftStep=(imgSetWidth-maxContainerWidth)/imgShiftStep;
	
		$("div#imgLine_left").click(function(){
			imgSetShift=parseInt($("div#imgSet").css("left"));
			if(imgSetShift<0) {$("div#imgSet").animate({left: '+='+imgShiftStep+'px'},{duration: 100});}

		});	
	
		$("div#imgLine_right").click(function(){
			imgSetShift=parseInt($("div#imgSet").css("left"));
			if(Math.abs(imgSetShift)<(imgSetWidth-maxContainerWidth-imgShiftStep)) {$("div#imgSet").animate({left: '-='+imgShiftStep+'px'},{duration: 100});}
			
		});
		
	
	
	$("div#imgSet img").click(function(){
		
		currentImg=$("div#imgSet img").index(this);
		imageSet(currentImg);
	
	});
	imageSet(currentImg);



});
