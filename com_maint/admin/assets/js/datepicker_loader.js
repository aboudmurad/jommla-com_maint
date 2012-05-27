		window.addEvent('domready', function(){
			Locale.use('ar-AA');
			new Picker.Date($$('input[id=jform_filter_start]'), {
			    timePicker: false,
			    positionOffset: {x: -10, y: 0},
			    pickerClass: 'datepicker_dashboard',
			    useFadeInOut: !Browser.ie ,
          format: '%Y-%m-%d'
			});
		});

        window.addEvent('domready', function(){
			Locale.use('ar-AA');
			new Picker.Date($$('input[id=jform_filter_end]'), {
			    timePicker: false,
			    positionOffset: {x: -10, y: 0},
			    pickerClass: 'datepicker_dashboard',
			    useFadeInOut: !Browser.ie ,
          format: '%Y-%m-%d'
			});
		});
