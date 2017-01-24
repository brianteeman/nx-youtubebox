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
$afs = $params->get( 'allowfullscreen' );
$apl = $params->get( 'autoplay' );
$lop = $params->get( 'loop' );
$typ = $params->get('sourceType');
$vid = $params->get('videoID');
$pid = $params->get('playlistID');
$uid = $params->get('userID');
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
$bll = $params->get('blocklayer');
$blc = $params->get('blocklayercolor');
$pil = $params->get('playsinline');


if ($ano == 0) {$ano = 3;};       // 3 will disable all annotions

switch ($typ){
    case 0:
        // Single Video
        $video = modnxyoutubeBoxHelper::single( $rndm,$afs,$apl,$lop,$vid,$mut,$vol,$ctl,$rel,$dkb,$log,$ano,$nfo,$sta,$pil );
        break;
    case 1:
        // Playlist
        $video = modnxyoutubeBoxHelper::playlist( $rndm,$afs,$apl,$pid,$mut,$vol,$ctl,$rel,$dkb,$log,$ano,$nfo,$pil,$lop );
        break;
}

if($bll == 1){
    $blocklayer = '<div class="nx-blocklayer" style="background-color:'.$blc.';"></div>';
}else{
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