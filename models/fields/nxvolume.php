<?php
/**
 * @package     nx-YouTubeBox
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2017 nx-designs.
 * @license     GNU General Public License version 2 or later
 */

defined('JPATH_PLATFORM') or die;

JFormHelper::loadFieldClass('number');

/**
 * Form Field class for the Joomla Platform.
 * Provides a horizontal scroll bar to specify a value in a range.
 *
 * @link   http://www.w3.org/TR/html-markup/input.text.html#input.text
 * @since  3.2
 */
?>

<style>
    #actualVolume {
        margin: 0 15px;
        padding: 2px 10px;
    }
    .nx-strong {
        font-weight: bold;
    }
</style>
<script>
function updateVolDisplay(val) {
    jQuery('#actualVolume').html(val+"%").hide();
    if(val<31){
        jQuery('#actualVolume').removeClass('alert-warning alert-danger nx-strong');
        jQuery('#actualVolume').addClass('alert-info');
    };
    if(val>=31 && val<65){
        jQuery('#actualVolume').removeClass('alert-info alert-danger');
        jQuery('#actualVolume').addClass('alert-warning nx-strong');
    }
    if(val>64){
        jQuery('#actualVolume').removeClass('alert-info alert-warning');
        jQuery('#actualVolume').addClass('alert-danger nx-strong');
    }
    jQuery('#actualVolume').fadeIn('slow');
};
jQuery(document).ready(function(){
    jQuery('#actualVolume').hide();
    var val = jQuery('input[type=range]').val();
    updateVolDisplay(val);
});
</script>

<?php
class JFormFieldnxVolume extends JFormFieldNumber
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  3.2
	 */
	protected $type = 'nxVolume';

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   3.2
	 */
	protected function getInput()
	{
		// Initialize some field attributes.
		$max      = !empty($this->last) ? ' max="' . $this->last . '"' : '';
		$min      = !empty($this->first) ? ' min="' . $this->first . '"' : '';
		$step     = !empty($this->step) ? ' step="' . $this->step . '"' : '';
		$class    = !empty($this->class) ? ' class="' . $this->class . '"' : '';
		$readonly = $this->readonly ? ' readonly' : '';
		$disabled = $this->disabled ? ' disabled' : '';

		$autofocus = $this->autofocus ? ' autofocus' : '';

		$value = (float) $this->value;
		$value = empty($value) ? $this->first : $value;

		// Initialize JavaScript field attributes.
		$onchange = !empty($this->onchange) ? ' onchange="' . $this->onchange . '"' : '';

		// Including fallback code for HTML5 non supported browsers.
		JHtml::_('jquery.framework');
		JHtml::_('script', 'system/html5fallback.js', false, true);

		return '<input id="slider" type="range" name="' . $this->name . '" id="' . $this->id . '"' . ' value="'
			. htmlspecialchars($value, ENT_COMPAT, 'UTF-8') . '"' . $class . $disabled . $readonly
			. $onchange . $max . $step . $min . $autofocus . ' onchange="updateVolDisplay(this.value);" /><span class="alert" id="actualVolume"></span>';
	}
}
