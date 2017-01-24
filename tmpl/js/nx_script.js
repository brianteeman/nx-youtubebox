/*

    Script to define the Video Dimensions for nx-youtubeBox

*/
var nxplayersArray=[];

var nxvideobox = (function(){
    jQuery('div.nx-videobox-container').each(function(){
        var videocontainer = jQuery(this);
        var videoframe = jQuery(this).children('iframe');
        //videoframe.hide();

        var videocontainerwidth = videocontainer.width();
        var videoheight = videocontainerwidth/1.777778;
        jQuery(this).css('min-height',videoheight);
        var videoframe = jQuery(this).children();
        setTimeout(function(){
        videoframe.attr('height',videoheight).attr('width',videocontainerwidth).fadeIn('slow');
            },100);
    });
});
      
jQuery(window).resize(nxvideobox);

var tryCounter = 0;

function onYouTubePlayerAPIReady() {
    checkifexists();
    function checkifexists(){
        if(typeof nxplayerElement === 'undefined'){
            tryCounter++;
            console.log('Wir sind im Try: '+tryCounter);
            setTimeout(function(){
                onYouTubePlayerAPIReady();
            },100); 
        }else{ 
            tryCounter = 0;
            console.log('here we are '+nxplayersArray);
            for(var i = 0; i< nxplayersArray.length; i++){
                nxplayersArray[i]();
            }      
            nxvideobox();
        }
    }
}

// startup the players