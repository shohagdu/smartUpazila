

var basePath = 'http://localhost/duwebadmin/'

$(document).ready(function () {
   // $('.select21').select2();

   $(document).on('change','#body_id_for_glance',function(){

      var type = $(this).val();

      console.log('the cow is a domestic anima11l')

      var url  = basePath +"glanceByBodyType?body_id="+type;
     
      $.get(url, function (data) {

        console.log(data)
        $('#dynamic-glance').html(data);
        // $('.select2').select2();
      });

  });


});


