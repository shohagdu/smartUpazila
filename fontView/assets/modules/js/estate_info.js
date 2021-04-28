var scnt_add_educational_institute = $('#add_educational_institute_body');
var estate_n =  2;
$('#add_educational_institute').on('click', function () {
    $(`<tr>
        <td>
            <input type="text" placeholder="প্রতিষ্ঠানের নাম" class="form-control"
                   name="educational_institute_name[]"
                   id="educational_institute_name_`+estate_n+`">
        </td>
         <td>
            <input type="text" class="form-control dynamic_datepicker"
                   placeholder=" শুরুর তারিখ"
                   name="educational_institute_start_dt[]"
                   id="educational_institute_start_dt_`+estate_n+`">
        </td>
        <td>
            <input type="text" class="form-control dynamic_datepicker" placeholder=" শেষ তারিখ"
                   name="educational_institute_end_dt[]"
                   id="educational_institute_end_dt_`+estate_n+`">
        </td>
        
        <td><a href="javascript:void(0);"  id="deleteRow_`+ estate_n +`"  class="deleteRow btn btn-warning
        btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i>  Drop</a></td>
    </tr>`).appendTo(scnt_add_educational_institute);
    update_date_picker();
    estate_n++;
    return false;
});
function update_date_picker(){
    $(".dynamic_datepicker").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "1900:2022"
    }).val();
}

$("#checkedBcsCadre").change(function () {
    if ($(this).prop('checked')) {
        $(".show_bcs_cadre").show();
    } else {
        $(".show_bcs_cadre").hide();
    }
});


$(".is_present_allocated_house").change(function () {
    if ($(this).val()==2) {
        $("#present_allocated_house_info_show").show();
    } else {
        $("#present_allocated_house_info_show").hide();
    }
    $('#area_info').val('');
    $('#house_info').html('<option value="">ভবন চিহ্নিত করুন</option>');
    $('#flat_no_info').html('<option value="">ফ্ল্যাট নং চিহ্নিত করুন</option>');
});
$(".is_special_without_pay_leave").change(function () {
    if ($(this).val()==2) {
        $("#is_special_without_pay_leave_details").show();
    } else {
        $("#is_special_without_pay_leave_details").hide();
    }
});
$(".is_agreed_dokhol").change(function () {
    if ($(this).val()==2) {
        $("#is_agreed_dokhol_details").show();
    } else {
        $("#is_agreed_dokhol_details").hide();
    }
});
$(".is_another_educational_institute_info").change(function () {
    if ($(this).val()==2) {
        $("#another_educational_institute_info_details").show();
    } else {
        $("#another_educational_institute_info_details").hide();
    }
});
$(".is_get_basha_seat").change(function () {
    if ($(this).val()==2) {
        $("#is_get_basha_seat_details").show();
    } else {
        $("#is_get_basha_seat_details").hide();
    }
});
$(".is_organize_exist").change(function () {
    if ($(this).val()==2) {
        $("#is_organize_exist_details").show();
    } else {
        $("#is_organize_exist_details").hide();
    }
});
$(".is_apply_rasel_tower").change(function () {
    if ($(this).val()==2) {
        $("#is_apply_rasel_tower_details").show();
    } else {
        $("#is_apply_rasel_tower_details").hide();
    }
});




function saveEmployeeLeaveInfo() {
    $.ajax({
        type: "POST",
        url: base_url + "/save_employee_leave_info",
        data: $('#employee_leave_info_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#saved_form_leave_output').html(error_html);
            } else {
                $('#employee_leave_info_form')[0].reset();
                $('#saved_form_leave_output').html('');
                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    window.location = base_url + '/' + data.redirect_page;
                });
            }
        }
    });
}

$("#area_info").change(function () {
    var area_info_id = $(this).val();
    $('#flat_no_info').html('<option value="">ফ্ল্যাট নং চিহ্নিত করুন</option>');
    $.ajax({
        type: "POST",
        url: base_url + "/get_building_info",
        data: {area_info_id: area_info_id},
        'dataType': 'json',
        success: function (response) {
            $('#house_info').html('<option value="">ভবন চিহ্নিত করুন</option>');
            if (response.status == 'success') {
                $.each(response.data, function (index, Obj) {
                    $('#house_info').append('<option value="' + index + '">' + Obj + '</option>')
                })
            }
        }
    });

});
$("#house_info").change(function () {
    var house_info_id = $(this).val();
    $.ajax({
        type: "POST",
        url: base_url + "/get_flat_info",
        data: {house_info_id: house_info_id},
        'dataType': 'json',
        success: function (response) {
            $('#flat_no_info').html('<option value="">ফ্ল্যাট নং চিহ্নিত করুন</option>');
            if (response.status == 'success') {
                $.each(response.data, function (index, Obj) {
                    $('#flat_no_info').append('<option value="' + index + '">' + Obj + '</option>')
                })
            }
        }
    });

});

function deleteEstateApplicationConfirm(id) {
    swal({
        title: "Are you sure?",
        text: "After confirmation, your changes will be saved",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/delete_estate_application_info",
                    data: {id: id},
                    'dataType': 'json',
                    success: function (response) {
                        if (response.status == 'success') {
                            swal({
                                text: response.message,
                                icon: "success",
                            }).then(function () {
                                location.reload();
                            });

                        } else {
                            swal(response.message, {
                                icon: "warning",
                            });
                        }
                    }
                });
            }
        });
}

// user registration information

function searchRegistration(){
    $.ajax({
        type: "POST",
        url: base_url + "/show_employee_info",
        data: $('#student_reg_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.status.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.status.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.status[count] + '</div>';
                }
                $('#searching_reg_output').html(error_html);

            } else {

                if(data.data!=null && $("#employee_category").val() !='T') {
                    var emp_data=data.data;
                    $('#show_eligible_info').html(data.message);
                    $('#reg_output').html('');
                    $("#show_result_info").show();
                    $("#name_en").val(emp_data.name_en);
                    $("#designation_en").val(emp_data.designation_en);
                    $("#Office_name_en").val(emp_data.office_name_en);
                    $("#Office_name_en_code").val(emp_data.office);
                    $("#designation_equivalent").val('');
                    $('#designation_equivalent').html('<option value="">Select Equivalent Designation </option>');
                    $.each(data.designation_equ, function (index, Obj) {
                        $('#designation_equivalent').append('<option value="' + index + '">' + Obj + '</option>')
                    })
                    if($("#employee_category").val()=='F' || $("#employee_category").val()=='S' ){
                        $("#show_third_fourth_class").show();
                    }else{
                        $("#show_third_fourth_class").hide();
                    }
                    if(data.error_status=='Already_exit'){
                        $(".already_exist").hide();
                    }else{
                        $(".already_exist").show();
                    }
                   

                }else{
                    $('#show_eligible_info').html(data.message);
                    $("#show_result_info").hide();
                    $("#show_third_fourth_class").hide();
                }
                $('#searching_reg_output').html('');
            }
        }
    });
}
function studentRegistration () {
    $("#std_registration_btn").attr('disabled',true);
    $.ajax({
        type: "POST",
        url: base_url + "/student_registration_action",
        data: $('#student_reg_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#student_reg_output').html(error_html);
            } else {
                $('#student_reg_output').html('');
                $("#std_registration_btn").attr('disabled',false);
                swal({
                   text: data.success,
                 icon: "success",
                 }).then(function () {
                   window.location = base_url + '/' + data.redirect_page;
                 });
            }
        }
    });
}

function updateEsateInfo () {
    $("#estateUpdateBtn").attr('disabled',true);
    $.ajax({
        type: "POST",
        url: base_url + "/update_estate_application_form_received",
        data: $('#estate_application_form_received').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output').html(error_html);
            } else {
                $('#form_output').html('');
                $("#estateUpdateBtn").attr('disabled',false);
                swal({
                   text: data.success,
                 icon: "success",
                 }).then(function () {
                   window.location = base_url + '/' + data.redirect_page;
                 });
            }
        }
    });
}



function formReceivedOffice(id,application_id,emp_name,emp_id) {
    $('#estate_application_form_received')[0].reset();
    $("#estate_app_id").val(id);
    $("#application_no").val(application_id);
    $("#emp_name").val(emp_name);
    $("#emp_id").val(emp_id);
}

function saveEstateApply() {
    $("#updateBtn").attr('disabled',true);
    $.ajax({
        type: "POST",
        url: base_url + "/save_estate_teacher_info",
        data: $('#save_estate_teacher_info_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            $("#updateBtn").attr('disabled',false);
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#flat_allotment_info_output').html(error_html);
            } else {
                $('#save_estate_teacher_info_form')[0].reset();
                $('#flat_allotment_info_output').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    window.location = base_url + '/' + data.redirect_page;
                });
            }
        }
    });
}

function updateEstateApply() {
    $("#updateBtn").attr('disabled',true);
    $.ajax({
        type: "POST",
        url: base_url + "/update_estate_info",
        data: $('#save_estate_teacher_info_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            $("#updateBtn").attr('disabled',false);
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#flat_allotment_info_output').html(error_html);
            } else {
                $('#save_estate_teacher_info_form')[0].reset();
                $('#flat_allotment_info_output').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    window.location = base_url + '/' + data.redirect_page;
                });
            }
        }
    });
}

$(document).on("keyup.autocomplete",".estate_application_no",function(){

    var options = {
        minLength: 1,
        source: function (request, response) {
            $.ajax({
                url: base_url + "/searching_estate_application_info",
                method: 'post',
                dataType: "json",
                autoFocus:true,
                data: {
                    term: request.term,
                },
                success: function (data) {
                    // console.log(data);
                    // if(data.length>0) {
                    response(data);
                    // }else{
                    //     $('#hand_over_to_'+element_id).val('');
                    //     $('#hand_over_to_id_'+element_id).val('');
                    // }
                }
            });
        },
        select: function (event, ui) {
            if(ui.item.value !='') {
                $('#secondary_app_no').val(ui.item.value);
                $('#secondary_app_id').val(ui.item.id);
            }else{
                $('#secondary_app_no').val('');
                $('#secondary_app_id').val('');
            }
            return false;
        }
    };
    $('body').on('keyup.autocomplete', "#secondary_app_no", function() {
        $(this).autocomplete(options);
    });
});

$(".joinApply").change(function () {
    if ($(this).val()==2) {
        $("#secondary_info_when_join_apply").show();
    } else {
        $("#secondary_info_when_join_apply").hide();
    }

});

function estateApplicationWithDraw(id) {
    swal({
        title: "Are you sure? Withraw",
        text: "After Withraw, This Application move to Waiting for Received",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/withdrawEstateApplication",
                    data: {id: id},
                    'dataType': 'json',
                    success: function (response) {
                        if (response.status == 'success') {
                            swal({
                                text: response.message,
                                icon: "success",
                            }).then(function () {
                                location.reload();
                            });

                        } else {
                            swal(response.message, {
                                icon: "warning",
                            });
                        }
                    }
                });
            }
        });
}


function saveOccupancyRegister() {
    $("#updateBtn").attr('disabled',true);
    $.ajax({
        type: "POST",
        url: base_url + "/save_flat_occupancy_register",
        data: $('#flat_occupancy_register_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            $("#updateBtn").attr('disabled',false);
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#info_output').html(error_html);
            } else {
                $('#flat_occupancy_register_form')[0].reset();
                $('#info_output').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    window.location = base_url + '/' + data.redirect_page;
                });
            }
        }
    });
}

function updateOccupancyRegister() {
    $("#updateBtn").attr('disabled',true);
    $.ajax({
        type: "POST",
        url: base_url + "/update_flat_occupancy_register",
        data: $('#flat_occupancy_register_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            $("#updateBtn").attr('disabled',false);
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#info_output').html(error_html);
            } else {
                $('#flat_occupancy_register_form')[0].reset();
                $('#info_output').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    window.location = base_url + '/' + data.redirect_page;
                });
            }
        }
    });
}

function changeHouseInfo() {
    $.ajax({
        type: "POST",
        url: base_url + "/get_flat_info_form",
        data: $('#flat_info_form').serialize(),
        success: function (data) {
            if(data!=''){
                $("#show_flat_info").html(data);
            }else{
                $("#show_flat_info").html('');
            }
        }
    });
}

function add_flat_setup_info() {
    $('#save_flat_info_form')[0].reset();
    $("#btnTitle").html("Save");
    $("#flat_id").val('');
}
function show_flat_setup_info(data) {
    if(data!=''){
        $('#save_flat_info_form')[0].reset();
        var info=JSON.parse(data);
        var buliding_id=info.building_id;
        var area_id=$("#area_info").val();
        $("#show_area_info").val(area_id);
        $("#flat_name").val(info.flat_name);
        $("#sqr_feet").val(info.sqr_feet);
        $("#total_room").val(info.total_room);
        $("#show_floor_info").val(info.floor);
        $("#flat_ctg").val(info.category);
        $("#is_active").val(info.is_active);
        $("#flat_id").val(info.id);
        $("#btnTitle").html("Update");
        $.ajax({
            type: "POST",
            url: base_url + "/get_building_info",
            data: {area_info_id: area_id},
            'dataType': 'json',
            success: function (response) {
                $('#show_house_info').html('<option value="">ভবন চিহ্নিত করুন</option>');
                if (response.status == 'success') {
                    $.each(response.data, function (index, Obj) {
                        $('#show_house_info').append('<option value="' + index + '">' + Obj + '</option>')
                    });
                    $("#show_house_info").val(buliding_id);
                }
            }
        });
    }
}


function saveFlatInfo() {
    $("#updateBtn").attr('disabled',true);
    $.ajax({
        type: "POST",
        url: base_url + "/save_flat_info",
        data: $('#save_flat_info_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            $("#updateBtn").attr('disabled',false);
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#info_output').html(error_html);
            } else {
                $('#save_flat_info_form')[0].reset();
                $('#info_output').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    window.location = base_url + '/' + data.redirect_page;
                });
            }
        }
    });
}
$("#show_area_info").change(function () {
    var area_info_id = $(this).val();
    $.ajax({
        type: "POST",
        url: base_url + "/get_building_info",
        data: {area_info_id: area_info_id},
        'dataType': 'json',
        success: function (response) {
            $('#show_house_info').html('<option value="">ভবন চিহ্নিত করুন</option>');
            if (response.status == 'success') {
                $.each(response.data, function (index, Obj) {
                    $('#show_house_info').append('<option value="' + index + '">' + Obj + '</option>')
                })
            }
        }
    });

});

function searching_estate_rank_info() {
    $.ajax({
        type: "POST",
        url: base_url + "/searching_estate_rank_info_data",
        data: $('#searching_estate_rank_info_form').serialize(),
        success: function (data) {
            if(data!=''){
                $("#show_applicant_rank_list").html(data);
            }else{
                $("#show_applicant_rank_list").html('');
            }
        }
    });
}
function generate_estate_point_cal() {
    $.ajax({
        type: "POST",
        url: base_url + "/generate_estate_point_calculation",
        data: $('#estate_point_calculation_form').serialize(),
        success: function (data) {
            if(data!=''){
                $("#show_applicant_rank_list").html(data);
            }else{
                $("#show_applicant_rank_list").html('');
            }
        }
    });
}

$('#applicant_type').change(function() {
    var applicant_type_val= this.value;
    $("#basha_type").html("<option value=''>Select</option>");
    if (applicant_type_val == 'faculty'  ) {
        $("#basha_type").html("<option value=''>Select</option><option value='1'>তিন রুমের ফ্ল্যাট </option><option value='2'>চার রুমের ফ্ল্যাট </option>");

    }else if ( applicant_type_val == 'ThirdGeneral' || applicant_type_val == 'ThirdTechnical' || applicant_type_val == 'ForthGeneral' || applicant_type_val == 'ForthTechnical'   ) {
        $("#basha_type").html("<option value=''>Select</option><option value='1'>বাসা</option><option value='2'>সিট</option>");

    }

});

// covid 19 Registration
$(document).on("change", "#hall_resident_type", function (e) {
    var residentType = $(this).val();
    if(residentType==2){
        $(".show_room_no").hide();
    }else{
        $(".show_room_no").show();
    }

});



function getAge(dateString) {
    var now = new Date();
    var today = new Date(now.getYear(),now.getMonth(),now.getDate());

    var yearNow = now.getYear();
    var monthNow = now.getMonth();
    var dateNow = now.getDate();

    var dob = new Date(dateString.substring(6,10),
        dateString.substring(0,2)-1,
        dateString.substring(3,5)
    );

    var yearDob = dob.getYear();
    var monthDob = dob.getMonth();
    var dateDob = dob.getDate();
    var age = {};
    var ageString = "";
    var yearString = "";
    var monthString = "";
    var dayString = "";


    yearAge = yearNow - yearDob;

    if (monthNow >= monthDob)
        var monthAge = monthNow - monthDob;
    else {
        yearAge--;
        var monthAge = 12 + monthNow -monthDob;
    }

    if (dateNow >= dateDob)
        var dateAge = dateNow - dateDob;
    else {
        monthAge--;
        var dateAge = 31 + dateNow - dateDob;

        if (monthAge < 0) {
            monthAge = 11;
            yearAge--;
        }
    }

    age = {
        years: yearAge,
        months: monthAge,
        days: dateAge
    };

    if ( age.years > 1 ) yearString = " years";
    else yearString = " year";
    if ( age.months> 1 ) monthString = " months";
    else monthString = " month";
    if ( age.days > 1 ) dayString = " days";
    else dayString = " day";


    if ( (age.years > 0) && (age.months > 0) && (age.days > 0) )
        ageString = age.years + yearString + ", " + age.months + monthString + ", and " + age.days + dayString + " old.";
    else if ( (age.years == 0) && (age.months == 0) && (age.days > 0) )
        ageString = "Only " + age.days + dayString + " old!";
    else if ( (age.years > 0) && (age.months == 0) && (age.days == 0) )
        ageString = age.years + yearString + " old. Happy Birthday!!";
    else if ( (age.years > 0) && (age.months > 0) && (age.days == 0) )
        ageString = age.years + yearString + " and " + age.months + monthString + " old.";
    else if ( (age.years == 0) && (age.months > 0) && (age.days > 0) )
        ageString = age.months + monthString + " and " + age.days + dayString + " old.";
    else if ( (age.years > 0) && (age.months == 0) && (age.days > 0) )
        ageString = age.years + yearString + " and " + age.days + dayString + " old.";
    else if ( (age.years == 0) && (age.months > 0) && (age.days == 0) )
        ageString = age.months + monthString + " old.";
    else ageString = "Oops! Could not calculate age!";

    return ageString;
}

function ageCalculation(val){
    var ageInfo=getAge(val);
    $("#showAge").html(ageInfo);
    $("#showAge").css('color:','red');
    $("#showAge").css({"color":"red","font-weight":"bold","font-size":"11px","padding-top":"2px"});
}


$('input[type=radio][name=haveNID]').change(function() {
    $("#nid_no").val('');
    $("#confirm_nid_no").val('');
    $("#birth_certificate_no").val('');
    $("#confirm_birth_certificate_no").val('');
    $("#nidValidation").html('');

    if (this.value == 1) {
        $(".showHaveNID").show();
        $(".showBirthCertificate").hide();
    }
    else if (this.value == 2) {
        $(".showHaveNID").hide();
        $(".showBirthCertificate").show();
    }else{
        $(".showHaveNID").hide();
        $(".showBirthCertificate").hide();
    }
});

function updateCaptcha () {
    $.ajax({
        type: "GET",
        url: base_url + "/update_captcha_action",
        success: function (data) {
            $('.captcha span').html(data);
            $('#captcha').val('');
            $('#output_info').html('');
            $("#updateBtn").attr('disabled',false);

        }
    });
}function onlyUpdateCaptcha () {
    $.ajax({
        type: "GET",
        url: base_url + "/update_captcha_action",
        success: function (data) {
            $('.captcha span').html(data);
            $('#captcha').val('');
            $("#updateBtn").attr('disabled',false);

        }
    });
}

function saveVaccineRequestStd() {
    $("#updateBtn").attr('disabled',true);
    $.ajax({
        type: "POST",
        url: base_url + "/save_vaccine_request_std",
        data: $('#student_vaccine_reg_form').serialize(),
        'dataType': 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            $("#updateBtn").attr('disabled',false);
            if (data.error.length > 0) {
                var error_html = '';
                onlyUpdateCaptcha();
                console.log(data.error);
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="col-sm-6"> <div class="alert alert-danger">' + data.error[count] + '</div></div>';
                }
                $('#output_info').html(error_html);
            } else {
                $('#student_vaccine_reg_form')[0].reset();
                $('#output_info').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    window.location = base_url + '/' + data.redirect_page;
                });
            }
        }
    });
}

$(document).ready(function () {

    $(".datepickerLong3").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        maxDate: "-16Y",
        minDate: "-40Y",
        yearRange: "-40:-16"
    }).val();
});

$("#present_district_reg").change(function () {
    var district_id = $(this).val();
    $.ajax({
        type: "POST",
        url: base_url + "/show_upazila_by_district",
        data: {district_id: district_id},
        'dataType': 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            $('#present_police_station_reg').html('<option value="">Select Upazila/Thana </option>');
            if (response.status == 'success') {
                $.each(response.data, function (index, Obj) {
                    $('#present_police_station_reg').append('<option value="' + index + '">' + Obj + '</option>')
                })
            }
        }
    });
});

$(document).on("click", ".nidType", function (e) {
    var nidType = $(this).val();
    $("#nidValidation").css({"color": "red", "font-weight": "bold"});
    if(nidType==1){
        $("#nidValidation").html('National ID Card Number Must be 13 to 17 Digit');
    }else{
        $("#nidValidation").html('National ID Card Number Must be 10 Digit');
    }
});


function nextStdRegistrationInfo(){
    $(".showApplicantInfo").hide();
    $.ajax({
        type: "POST",
        url: base_url + "/searching_vaccine_request_std",
        data: $('#student_vaccine_reg_form').serialize(),
        'dataType': 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            $("#updateBtn").attr('disabled',false);
            $(".searchingRegInfo").hide();
            $("#registration_no").attr('readonly',true);
            $("#registration_session").attr('readonly',true);

            if (data.status=='success') {
                $('#output_info').html('');
                $(".showApplicantInfo").show();
                $(".showExistInfo").hide();

            }else if (data.status=='exist_student') {
                $('#output_info').html('');
                $('#howErrorInfo').html('');
                $(".showApplicantInfo").hide();
                $(".showExistInfo").show();
            } else {
                $(".searchingRegInfo").show();
                $('#output_info').html('');
                $('#howErrorInfo').html('<div class="alert alert-danger">' + data.message + '</div>');
                $(".showApplicantInfo").hide();
                $(".showExistInfo").hide();
                $("#registration_no").attr('readonly',false);
                $("#registration_session").attr('readonly',false);
            }
        }
    });
}


// Employee Category inforamtion update
$("#employee_category").change(function () {
    var ctgID = $(this).val();
    $('#designation_equivalent').html('<option value="">Designation Equivalent</option>');
    $.ajax({
        type: "POST",
        url: base_url + "/getEmployeeEquValient",
        data: {empCtgID: ctgID},
        'dataType': 'json',
        success: function (response) {
            $('#designation_equivalent').html('<option value="">Designation Equivalent</option>');
            if (response.status == 'success') {
                console.log(response.data);
                $.each(response.data, function (index, Obj) {
                    $('#designation_equivalent').append('<option value="' + index + '">' + Obj + '</option>')
                })
            }
        }
    });

});


