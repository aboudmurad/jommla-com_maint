<?php
defined('JPATH_PLATFORM') or die ;

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JHtml::_('behavior.mootools');

class JFormFieldEhCalendar extends JFormField {
	public $type = 'EhCalendar';


	protected function getInput() {

		$time = $this->element['time'] == "true" ? "true" : "false";
		$locale = $this->element['locale'];

		$class = $this->element['class'];

		$doc = JFactory::getDocument();
		// Add Js
		$doc->addScript(JURI::base(true) . '/components/com_maint/assets/js/datepicker/Locale.'.$locale.'.DatePicker.js');
		$doc->addScript(JURI::base(true)  . '/components/com_maint/assets/js/datepicker/Picker.js');
		$doc->addScript(JURI::base(true)  . '/components/com_maint/assets/js/datepicker/Picker.Attach.js');
		$doc->addScript(JURI::base(true)  . '/components/com_maint/assets/js/datepicker/Picker.Date.js');
		$doc->addScriptDeclaration("
		window.addEvent('domready', function(){
			Locale.use('$locale');
			new Picker.Date($$('input[id=$this->id]'), {
			    timePicker: $time,
			    positionOffset: {x: -10, y: 0},
			    pickerClass: 'datepicker_dashboard',
			    useFadeInOut: !Browser.ie ,
          format: '%Y-%m-%d %T'
			});
		});
		");
        
        if (!$this->value && $this->element['addDefault']) {
            $this->value = date("Y-m-d H:i:s");
        }

		// add css
		$doc->addStyleSheet(JURI::base(true)  . '/components/com_maint/assets/css/datepicker/datepicker_dashboard/datepicker_dashboard.css');

		$input ='<input type="text" name="'.$this->name . '" value="'.$this->value.'" id="'.$this->id.'" class="'.$class.'" required="'.$this->required.'" />';

		return $input;
	}

}
