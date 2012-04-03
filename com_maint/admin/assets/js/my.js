$().ready(function(){
  $('#jform_client_name').autocomplete({
    serviceUrl: baseUrl+'?format=raw&option=com_maint&view=maint&task=getList&list=name',
    onSelect: function(value, data){
      $('#jform_client_phone').val(data.phone);
      $('#jform_client_mobile').val(data.mobile);
      $('#jform_client_email').val(data.email);
    },
  });

  $('#jform_device_type').autocomplete({
    serviceUrl: baseUrl+'?format=raw&option=com_maint&view=maint&task=getList&list=device',
  });
});
