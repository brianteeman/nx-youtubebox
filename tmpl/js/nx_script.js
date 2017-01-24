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
            for(var i = 0; i< nxplayersArray.length; i++){
                nxplayersArray[i]();
            }      
            nxvideobox();
        }
    }
}

// startup the players
function calculatePositioning(movement,heightval,rand){
    console.log('height will now be calculated for: '+rand+' Value: '+heightval);
    var hve_width = jQuery('#outer_'+rand).width(),
        hve_fullheight = hve_width / 1.777778,
        hve_height = hve_fullheight / 100 * heightval,
        hve_inner = jQuery('#outer_'+rand).children('div.nx-videobox-container'),
        hve_move = hve_height / 100 * movement;
    
    console.log(hve_width,hve_fullheight,hve_height);
    jQuery('#outer_'+rand).css('height', hve_height+'px').css('overflow-y', 'hidden');
    jQuery(hve_inner).css('margin-top', hve_move+'px');
    console.log(hve_move+'px');
    
};