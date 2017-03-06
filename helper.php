<?php

/**
 * Helper Datei für die nx-youtubeBox 
 * @package     nx-youtubeBox
 *
 * @copyright   Copyright (C) 2009 - 2016 nx-designs.
 * @license     GNU General Public License version 2 or later
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


JHtml::_('jquery.framework');

$document = JFactory::getDocument();
$youtube = 'modules/mod_nxyoutubebox/tmpl/js/youtubeBase.js';
$nxscript = 'modules/mod_nxyoutubebox/tmpl/js/nx_script.js';


$maincssurl = 'modules/mod_nxyoutubebox/tmpl/css/nx-youtubebox.css';


$document->addScript($youtube);
$document->addScript($nxscript);
$document->addStyleSheet($maincssurl);

class modnxyoutubeBoxHelper
    
{
    public static function single ( $rndm,$afs,$apl,$lop,$vid,$mut,$vol,$ctl,$rel,$dkb,$log,$ano,$nfo,$sta,$pil,$bll,$deg2d )
    {
			
		if ((strpos($vid,"https://")!==false) OR (strpos($vid,"http://")!==false)){ 
			$ytarray=explode("/", $vid);
			$ytendstring=end($ytarray);
			$ytendarray=explode("?v=", $ytendstring);
			$ytendstring=end($ytendarray);
			$ytendarray=explode("&", $ytendstring);
			$videoID=$ytendarray[0];

		} else {
			$videoID = $vid;
		}
		$nxVideo = "<div id='nx_videoBox_$rndm'></div>
        
        <script type='text/javascript'>
        
        nxplayersArray.push(nx_videoBox_$rndm);
        var nxplayerElement = nx_videoBox_$rndm;
        
function nx_videoBox_".$rndm."(){
    nx_videoBox_$rndm = new YT.Player('nx_videoBox_$rndm', {
        height: 200,
        width: 300,
        videoId:'$videoID',
        wmode:'opaque',
        playerVars: {
            'enablejsapi':1,
            'origin':document.domain,
            'allowfullscreen':'true',
            'autoplay':$apl, 
            'disablekb':$dkb, 
            'start':$sta, 
            'rel':$rel, 
            'controls':$ctl, 
            'showinfo':$nfo,
            'fs':$afs, 
            'modestbranding':$log, 
            'playsinline':$pil, 
            'iv_load_policy':$ano
        },
        events: {
                'onReady':onPlayerReady$rndm,
                'onStateChange':onPlayerStateChange$rndm
            }
        });
// The API will call this function when the video player is ready.
	function onPlayerReady".$rndm."(event) {
    console.log('ready');
        event.target.setVolume($vol);
        if($mut == 1){
            event.target.mute();
        }
        if($deg2d !== 0){
            rotateScript($rndm, $deg2d);
        }
        if($bll == 1){
            setblocklayer".$rndm."();
        }
        makevisible(".$rndm.");
    }
// The API will call this function when the video player change its state.
	function onPlayerStateChange".$rndm."(event) {
		if (event.data == YT.PlayerState.ENDED) {
			if($lop == 1){
  				nx_videoBox_$rndm.playVideo();  
			}
		}
	}
}
</script>";
		
		return $nxVideo;
    }
    
    public static function playlist ( $rndm,$afs,$apl,$pid,$mut,$vol,$ctl,$rel,$dkb,$log,$ano,$nfo,$pil,$lop,$bll,$deg2d )
    {	
		if ((strpos($pid,"https://")!==false) OR (strpos($pid,"http://")!==false)){ 
			$ytarray=explode("list=", $pid);
			$playlistID=$ytarray[1];

		} else {
			$playlistID = $pid;
		}
		$nxVideo = "<div id='nx_videoBox_".$rndm."'></div>
        
        <script type='text/javascript'>
        
        nxplayersArray.push(nx_videoBox_".$rndm.");
        var nxplayerElement = nx_videoBox_".$rndm.";
        
function nx_videoBox_".$rndm."(){
    nx_videoBox_".$rndm." = new YT.Player('nx_videoBox_".$rndm."', {
        height: 200,
        width: 300,
        wmode:'opaque',
        playerVars:{ 'enablejsapi':1,'origin':document.domain,'listType':'playlist','list':'".$playlistID."','autoplay':".$apl.",'disablekb':".$dkb.",'rel':".$rel.",'controls':".$ctl.",'showinfo':".$nfo.",'fs':".$afs.",'modestbranding':".$log.",'playsinline':".$pil.",'iv_load_policy':".$ano.",'loop':".$lop."}, events: {'onReady':onPlayerReady".$rndm.",'onStateChange':onPlayerStateChange".$rndm."}
        });
// The API will call this function when the video player is ready.
	function onPlayerReady".$rndm."(event) {
        event.target.setVolume(".$vol.");
        if(".$mut." == 1){
            event.target.mute();
        }
        if($deg2d !== 0){
            rotateScript($rndm, $deg2d);
        }
        if($bll == 1){
            setblocklayer".$rndm."();
        }
        makevisible(".$rndm.");
    }
// The API will call this function when the video player change its state.
	function onPlayerStateChange".$rndm."(event) {
		if (event.data == YT.PlayerState.ENDED) {
			if(".$lop." == 1){
  				//nx_videoBox_".$rndm.".playVideo();  
			}
		}
	}
}
</script>";
		
		return $nxVideo;
    }
}

?>
