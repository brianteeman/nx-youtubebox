<?php
/**
 * Printout File for nx-youtubeBox 
 * @package     nx-youtubeBox
 *
 * @copyright   Copyright (C) 2009 - 2016 nx-designs.
 * @license     GNU General Public License version 2 or later
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
include __DIR__ . '/css/nx-youtubebox.css.php';
include __DIR__ . '/css/bordersettings.css.php';
include __DIR__ . '/css/blocklayersettings.css.php';


include __DIR__ . '/js/rotator.js.php';
?>
<script type="text/javascript">
    jQuery(document).ready(function($){
        $('#nxplayer_<?php echo $rndm; ?>').css('left', '99999px');
        $('#nxplayer_<?php echo $rndm; ?>').on('display.uk.check', function(){
            // custom code if video is in a uikit hidden container to adjust width / height etc on show
            nxvideobox();
        });
    <?php echo $positioning_calc; ?>
    });
    function setblocklayer<?php echo $rndm; ?>(){
        jQuery(document).ready(function($){
            setTimeout(function(){
                // necessary for fast Resize Actions
                var w = $('#nx_videoBox_<?php echo $rndm; ?>').width();
                var h = parseInt($('#nx_videoBox_<?php echo $rndm; ?>').width()) / 1.7777777778;
                $('#nx-blocklayer_<?php echo $rndm; ?>').css('height', h+'px');
                $('#nx-blocklayer_<?php echo $rndm; ?>').css('width', w+'px');
            },500);
        });
    }
    jQuery(window).resize(setblocklayer<?php echo $rndm; ?>);
    /* Settings with 'onplayerready' Event below */
    <?php echo $settings; ?>
</script>

<div class="nx-videobox-outer" id="nxouter_<?php echo $rndm; ?>">
    <div class="nx-videobox-container<?php echo $moduleclass_sfx; ?>" id="nxplayer_<?php echo $rndm; ?>" data-uk-check-display>
        <div style="position:relative;">
            <?php echo $video; ?>
            <?php echo $blocklayer;?>
            
        </div>
    </div>
</div>
