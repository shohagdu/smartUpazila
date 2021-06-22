var url  = $('meta[name = path]').attr("content");
var csrf    = $('mata[name = csrf-token]').attr("content");

$(document).ready( function () {
    
    $('#InformationTable').DataTable();
    
} );

function getDistrict(division_id, target_id){

        $.ajaxSetup({
        
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
    
            url: url + "/get_district_info",
            type:"POST",
            dataType:"JSON",
            data:{
                division_id:division_id,
            },
            success:function(response){
                //console.log(response.data);
    
                if (response.status == 'success') {
    
                    var list = "<option value=''>Select</option>";
    
                    response.data.forEach(function(item){
    
                        list += "<option value='"+item.id+"'>"+item.bn_name+"</option>";
    
                    });
    
                    $("#"+target_id).html(list);
    
                }else{
    
                    $("#"+target_id).html("<option value=''>Not Found</option>");
                }
    
            }
    
         });
}

function getUpazila(district_id, target_id){

    $.ajaxSetup({
    
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

        url: url + "/get_upazila_info",
        type:"POST",
        dataType:"JSON",
        data:{
            district_id:district_id,
        },
        success:function(response){
            //console.log(response.data);

            if (response.status == 'success') {

                var list = "<option value=''>Select</option>";

                response.data.forEach(function(item){

                    list += "<option value='"+item.id+"'>"+item.bn_name+"</option>";

                });

                $("#"+target_id).html(list);

            }else{

                $("#"+target_id).html("<option value=''>Not Found</option>");
            }

        }

     });
}