<?php
/**
 * Controller File for nx-youtubeBox 
 * @package     nx-youtubeBox
 *
 * @copyright   Copyright (C) 2009 - 2016 nx-designs.
 * @license     GNU General Public License version 2 or later
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// include the syndicate functions only once
require_once __DIR__ . '/helper.php';

// get Player Settings
$rndm = intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) );
$afs = $params->get('allowfullscreen');
$apl = $params->get('autoplay');
$lop = $params->get('loop');
$typ = $params->get('sourceType');
$vid = $params->get('videoID');
$pid = $params->get('playlistID');

$mut = $params->get('mute');
$vol = $params->get('volume');
$ctl = $params->get('controls');
$rel = $params->get('related');
$dkb = $params->get('disablekb');
$log = $params->get('branding');
$ano = $params->get('annotations');
$nfo = $params->get('showinfo');
$sta = $params->get('start');
$hem = $params->get('headermode');
$mhe = $params->get('maxheightvalue');
$mup = $params->get('movevideo');
$bll = $params->get('blocklayer');				// 0-1 blocklayer enabled
$blc = $params->get('blocklayercolor');			// color - hue
$bse = $params->get('blocklayershadowenable');	// 0-1 inner shadow enabled
$bsh = $params->get('blocklayershadowwidthh');	// horizontal
$bsv = $params->get('blocklayershadowwidthv');	// vertical
$bsb = $params->get('blocklayershadowwidthb');	// blur
$bss = $params->get('blocklayershadowwidths');	// spread
$bsc = $params->get('blocklayershadowcolor');	// color - hue
$pil = $params->get('playsinline');
$deg2d = $params->get('rotate2d');				// divframe rotation in deg
$ubo = $params->get('useborder');				// border enabled
$bow = $params->get('borderwidth');				// border width
$boc = $params->get('bordercolor');				// general Border Color
$bor = $params->get('borderradius');            // General Borderradius (0px 0px 0px 0px)
$ubb = $params->get('useborderbottom');			// enable special settings for bottom-border
$ubw = $params->get('borderbottomwidth');		// bottom-border width
$ubc = $params->get('bottombordercolor');		// bottom-border color
$she = $params->get('useshadow');				// enable box shadow (outer)
$shh = $params->get('shadowwidthh');			// horizontal
$shv = $params->get('shadowwidthv');			// vertical
$shb = $params->get('shadowwidthb');			// blur
$shs = $params->get('shadowwidths');			// spread
$shc = $params->get('shadowcolor');				// color - hue

if (($ubo == 1) && ($bll == 1)){
    $borders = $bow *2;
} else {
    $borders = 0;
}


if ($ano == 0) {$ano = 3;};                     // 3 will disable all annotions

switch ($typ){
    case 0:
        // Single Video
        $video = modnxyoutubeBoxHelper::single( $rndm,$afs,$apl,$lop,$vid,$mut,$vol,$ctl,$rel,$dkb,$log,$ano,$nfo,$sta,$pil,$bll,$deg2d );
        break;
    case 1:
        // Playlist
        $video = modnxyoutubeBoxHelper::playlist( $rndm,$afs,$apl,$pid,$mut,$vol,$ctl,$rel,$dkb,$log,$ano,$nfo,$pil,$lop,$bll,$deg2d );
        break;
}

switch ($bll) {
    case 0:
        $blocklayer = '';
        break;
    case 1:
        if($bse == 0){
			$blocklayer = "<div id='nx-blocklayer_".$rndm."' class=\"nx-blocklayer\" style=\"background-color:$blc;\"></div>";
		} else {
			$blocklayer = '<div id="nx-blocklayer_'.$rndm.'" style="background-color:'.$blc.';box-shadow:inset '.$bsh.'px '.$bsv.'px '.$bsb.'px '.$bss.'px '.$bsc.'; moz-box-shadow:inset '.$bsh.'px '.$bsv.'px '.$bsb.'px '.$bss.'px '.$bsc.';"></div>';
		}
		break;
    default:
       $blocklayer = '';
}

if($hem == 1){
    $positioning_calc = "
    <script type='text/javascript'>
    jQuery(document).ready(function(){
        calculatePositioning(".$mup.",".$mhe.",".$rndm.");
        jQuery(window).resize(resize);
        function resize(){
            console.log('Re-calculating');
            calculatePositioning(".$mup.",".$mhe.",".$rndm.");
        };
    });</script>";
}else{
    $positioning_calc = "";
}

// Moduleclass Suffix
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));


// The Layout
require( JModuleHelper::getLayoutPath( 'mod_nxyoutubebox' ) );
?>
