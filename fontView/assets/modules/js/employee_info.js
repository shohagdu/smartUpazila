$('.onlyNumber').on('keydown', function (evt) {
    var key = evt.charCode || evt.keyCode || 0;

    return (key == 8 ||
        key == 9 ||
        key == 46 ||
        // key == 110 ||
        // key == 190 ||
        (key >= 35 && key <= 40) ||
        (key >= 48 && key <= 57) ||
        (key >= 96 && key <= 105));
});
$(document).ready(function() {
    $('input').keyup(function() {
		$('#saveBtnPub').attr('disabled',false);
		$('#std_registration_btn').attr('disabled',false);
		$('#searchingEmpInfo').attr('disabled',false);
		$('#updateBtn').attr('disabled',false);
    });
    $('textarea').keyup(function() {
        $('#saveBtnPub').attr('disabled',false);
		$('#updateBtn').attr('disabled',false);
    });
 
});

var LoadFile = function (event) {
    var output = document.getElementById("img_id");
    document.getElementById("img_div").style.display = "block";
    output.src = URL.createObjectURL(event.target.files[0]);
}
var LoadFile_new = function (event) {
    var output = document.getElementById("img_id_new");
    document.getElementById("img_div_new").style.display = "block";
    output.src = URL.createObjectURL(event.target.files[0]);
}
var LoadFile_all = function (event) {
    var output = document.getElementById("img_id_all");
    document.getElementById("img_div_all").style.display = "block";
    output.src = URL.createObjectURL(event.target.files[0]);
}

function elementId(id_arr) {
    var id = id_arr.split("_");
    return id[id.length - 1];
}

// for active tab

$(document).ready(function () {
    $('.datepickerinfo').datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "1900:2030"
    }).val();

    $('.datepickerLong').datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        yearRange: '1900:2030',
    }).val();
	$('.datepickerLong2').datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        yearRange: '1900:2002',
    }).val();
	
	
	$(".datepickerLong3").datepicker({
		dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		maxDate: "-16Y",
		minDate: "-40Y",
		yearRange: "-40:-16"
	}).val();
	
	
    $('.datepicker').datepicker({
        dateFormat: 'dd-mm-yy',

    }).val();

    if (location.hash) {
        $("a[href='" + location.hash + "']").tab("show");
    }
    $(document.body).on("click", "a[data-toggle]", function (event) {
        location.hash = this.getAttribute("href");
    });


    var physical_disability_val = $("#physical_disability").val();
    if (typeof physical_disability_val !== "undefined") {
        if (physical_disability_val == 1) {
            $("#disability_yes_details").attr('readonly', true);
        } else {
            $("#disability_yes_details").attr('readonly', false);
        }
    }

    var isCheckedBCS = $('#checkedBcsCadre').attr('checked');
    if (isCheckedBCS == 'checked') {
        $(".show_bcs_cadre").show();
    } else {
        $(".show_bcs_cadre").hide();
    }
    var isCheckedSameAddress = $('#save_present_parmanent_address').attr('checked');
    if (isCheckedSameAddress == 'checked') {
        $(".same_present_address").attr('disabled', true);
    } else {
        $(".same_present_address").attr('disabled', false);
    }


    //leave form reset
    // $("#employee_leave_info_form")[0].reset();
    // $("#employee_info_search").hide();
    // $("#saveBtn").show();
    // $("#updateBtn").hide();
    // $("#heading-title-leave").html('Add  leave information ');
    // $("#charge_hand_over_info").hide();
    //
    // $("#leaveTypeTr").html('');
    // $("#show_country_name").html('');
    // $("#designationChargedInfo").html('');

});

function update_date_picker(){
    $(".dynamic_datepicker").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "1900:2030"
    }).val();
}


$(document).on("click", ".result_type", function (e) {
    var element_id = elementId($(this).attr('id'));
    if($(this).is(":checked")) {
        $("#division_"+element_id).show();
        $("#gpa_"+element_id).hide();
    } else {
        $("#division_"+element_id).hide();
        $("#gpa_"+element_id).show();
    }
});


$(document).on("click", ".current_year", function (e) {
    var element_id = elementId($(this).attr('id'));
    if($(this).is(":checked")) {
        $("#year_research").attr('disabled',true);
    } else {
        $("#year_research").attr('disabled',false);
    }
    $("#year_research").val('');
});
$(document).on("click", ".current_working", function (e) {
    var element_id = elementId($(this).attr('id'));
    if($(this).is(":checked")) {
        $("#job_to_date_input_"+element_id).attr('disabled',true);
        $("#job_to_date_input_"+element_id).val('');
    } else {
        $("#job_to_date_input_"+element_id).attr('disabled',false);
        $("#job_to_date_input_"+element_id).val('');
    }
});





$(window).on("popstate", function () {
    var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
    $("a[href='" + anchor + "']").tab("show");
});

function addEmployee() {
    $("#employee_info_id")[0].reset();
    $("#form_output").html('');
    $("#disability_yes_details").attr('readonly', true);
    $(".same_present_address").attr('disabled', false);
    $("#saveBtn").show();
    $("#updateBtn").hide();
    $("#heading-title").html('Add new factuly information ');
}


function deleteEmployeeConfirm(id) {
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
                    url: base_url + "/delete_employee_info",
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

function uploadNewProfileToWebsite(id) {
    swal({
        title: "Are you sure?",
        text: "If you upload your new profile, your old profile will be replaced by new one",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/uploadNewProfile",
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


function saveEmployeeInfo() {
    // swal({
    //     title: "Are you sure?",
    //     text: "Once Save, You will saved this record",
    //     icon: "warning",
    //     buttons: true,
    //     dangerMode: true,
    // })
    //     .then((willDelete) => {
    //         if (willDelete) {
    //
                $.ajax({
                    type: "POST",
                    url: base_url + "/save_employee_info",
                    data: $('#employee_info_id').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#saved_form_output').html(error_html);
                        } else {
                            $('#employee_info_id')[0].reset();
                            $('#saved_form_output').html('');

                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                               window.location = base_url + '/' + data.redirect_page;
                            });
                        }
                    }
                });
        //
        //     } else {
        //         swal("Cancelled Now!");
        //     }
        // });
}


function updateEmployeeInfo() {
    swal({
        title: "Are you sure?",
        text: "Once Update, You will saved this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/save_employee_employement_info",
                    data: $('#employee_info_update_form').serialize(),
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output_employeement').html(error_html);
                        } else {
                            $('#form_output_employeement').html('');

                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                location.reload();
                            });
                        }
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });
}


function updateEducationInfo() {
    $.ajax({
        type: "POST",
        url: base_url + "/save_employee_education",
        data: $('#employee_education_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_education').html(error_html);
            } else {
                $('#form_output_education').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });

}
function addAward() {
    $("#employee_award_form")[0].reset();
    $("#form_output_award_info").html('');
    $("#saveBtnAward").show();
    $("#updateBtnAward").hide();
    $("#heading-title-award").html('Add award information ');
    CKEDITOR.instances.editor_info.setData( '' );
}


function updateAward(id) {
    $("#employee_award_form")[0].reset();
    $("#form_output_award_info").html('');
    $("#saveBtnAward").hide();
    $("#updateBtnAward").show();
    $("#heading-title-award").html('Update award information ');


    $.ajax({
        type: "POST",
        url: base_url + "/get_award_info",
        data: {award_id: id},
        'dataType': 'json',
        success: function (response) {
            if (response.status == 'success') {
                var data=response.data;
                $("#award_type").val(data.award_type);
                $("#award_title").val(data.title);
                $("#year_award").val(data.year);
                $("#country").val(data.country);
                $("#editor_info").val(data.description);
                $("#award_id").val(data.id);
                CKEDITOR.instances.editor_info.setData( data.description );
            }
        }
    });
}


function updateAwardInfo() {
        var award_description_info = CKEDITOR.instances['editor_info'].getData();
		award_description_info = award_description_info.replace(/[&]nbsp[;]/gi," ");
		
        $.ajax({
            type: "POST",
            url: base_url + "/save_employee_award_info",
            data: $('#employee_award_form').serialize()+ '&award_description='+award_description_info,
            'dataType': 'json',
            success: function (data) {
                if (data.error.length > 0) {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) {
                        error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                    }
                    $('#form_output_award_info').html(error_html);
                } else {
                    $('#form_output_award_info').html('');

                    swal({
                        text: data.success,
                        icon: "success",
                    }).then(function () {
                        location.reload();
                    });
                }
            }
        });
}

function addResearchStudent() {
    $("#employee_research_student_form")[0].reset();
    $("#form_output_research_stuent_info").html('');
    $("#saveBtnResearchStudent").show();
    $("#updateBtnResearchStudent").hide();
    $("#heading-title-resarch_student").html('Add Project/Research Supervision information ');
    CKEDITOR.instances.area_research.setData( '' );
    $("#year_research").attr('disabled',false);
}
function updateBtnResearchStudent(id) {
    $("#employee_research_student_form")[0].reset();
    $("#form_output_research_stuent_info").html('');
    $("#saveBtnResearchStudent"). hide();
    $("#updateBtnResearchStudent").show();
    $("#heading-title-resarch_student").html('Update Project/Research Supervision information ');
    $.ajax({
        type: "POST",
        url: base_url + "/get_research_supervision_info",
        data: {supervision_id: id},
        'dataType': 'json',
        success: function (response) {
            if (response.status == 'success') {
                var data=response.data;
                $("#level_of_study").val(data.degree);
                $("#title_research").val(data.title);
                $("#supervisor").val(data.supervisor);
                $("#core_supervisor").val(data.core_supervisor);
                $("#student_name").val(data.student_name);
                if(data.is_current_completion==1) {
                    $('#current_year_1').attr('checked',true); // "checked"
                    $("#year_1").val('');
                    $("#year_1").attr('disabled',true);
                }else{
                    $('#current_working_1').attr('checked',false); // "Unchecked"
                    $("#year_1").val(data.completion_year);
                    $("#year_1").attr('disabled',false);
                }
                $("#research_student_id").val(data.id);
                CKEDITOR.instances.area_research.setData( data.research_area );
            }
        }
    });
}


function updateResearchStudent() {
    var area_research_info = CKEDITOR.instances['area_research'].getData();
    $.ajax({
        type: "POST",
        url: base_url + "/save_employee_research_student",
        data: $('#employee_research_student_form').serialize()+ '&area_research='+area_research_info,
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_research_stuent_info').html(error_html);
            } else {
                $('#form_output_research_stuent_info').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}

function addResearchInterest() {
    $("#employee_research_interest_form")[0].reset();
    $("#form_output_research_interest").html('');
    $("#saveBtnResearchInterest").show();
    $("#updateBtnResearchInterest").hide();
    $("#heading-title-research-interest").html('Add Research Interest information ');
    CKEDITOR.instances.research_description.setData( '' );
}
function updateResearchInterestModal(id) {
    $("#employee_research_interest_form")[0].reset();
    $("#form_output_research_interest").html('');
    $("#saveBtnResearchInterest").hide();
    $("#updateBtnResearchInterest").show();
    $("#heading-title-research-interest").html('Update Research Interest information ');
    $.ajax({
        type: "POST",
        url: base_url + "/get_research_interest_info",
        data: {research_interest_id: id},
        'dataType': 'json',
        success: function (response) {
            if (response.status == 'success') {
                var data=response.data;
                $("#research_subject").val(data.subject);
                $("#research_interest_id").val(data.id);
                CKEDITOR.instances.research_description.setData( data.description );
            }
        }
    });
}


function updateResearchInterest() {
    var research_description_info = CKEDITOR.instances['research_description'].getData();
	
	research_description_info = research_description_info.replace(/[&]nbsp[;]/gi," ");
	research_description_info = research_description_info.replace(/\s+/g,' ');
	//return ;
    $.ajax({
        type: "POST",
        url: base_url + "/save_employee_research_interest",
        data: $('#employee_research_interest_form').serialize()+ '&research_description='+research_description_info,
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_research_interest').html(error_html);
            } else {
                $('#form_output_research_interest').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}

function updateResearchWork() {
    $.ajax({
        type: "POST",
        url: base_url + "/save_employee_research_work",
        data: $('#employee_research_work_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_research_work').html(error_html);
            } else {
                $('#form_output_research_work').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });

}

function addExperience() {
    $("#employee_job_hisotry_form")[0].reset();
    $("#form_output_job_history").html('');
    $("#saveBtnJobHistory").show();
    $("#updateBtnJobHistory").hide();
    $("#heading-title-job-history").html('Add New Experience Information ');
    $("#job_to_date_input_1").attr('disabled',false);
    $('#current_working_1').attr('checked',false); // "Unchecked"
    CKEDITOR.instances.job_description.setData( '' );
}
function updateExperience(id) {
    $("#employee_job_hisotry_form")[0].reset();
    $("#form_output_job_history").html('');
    $("#saveBtnJobHistory").show();
    $("#updateBtnJobHistory").hide();
    $("#heading-title-job-history").html('Update Experience Information ');
    $.ajax({
        type: "POST",
        url: base_url + "/get_job_history_info",
        data: {job_history_id: id},
        'dataType': 'json',
        success: function (response) {
            if (response.status == 'success') {
                var data=response.data;
                $("#exp_title").val(data.title);
                $("#company").val(data.company);
                $("#location").val(data.location);

                $("#job_from_date_input_1").val(data.start_date);
                if(data.is_currently_working==1) {
                    $('#current_working_1').attr('checked',true); // "checked"
                    $("#job_to_date_input_1").val('');
                    $("#job_to_date_input_1").attr('disabled',true);
                }else{
                    $('#current_working_1').attr('checked',false); // "Unchecked"
                    $("#job_to_date_input_1").val(data.end_date);
                    $("#job_to_date_input_1").attr('disabled',false);
                }

                $("#job_hoistory_id").val(data.id);
                CKEDITOR.instances.job_description.setData( data.description );
            }
        }
    });

}

function updateJobHistoryInfo() {
        var job_description_info = CKEDITOR.instances['job_description'].getData();
        $.ajax({
            type: "POST",
            url: base_url + "/save_employee_job_hisotry",
            data: $('#employee_job_hisotry_form').serialize()+ '&description='+job_description_info,
            'dataType': 'json',
            success: function (data) {
                if (data.error.length > 0) {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) {
                        error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                    }
                    $('#form_output_job_history').html(error_html);
                } else {
                    $('#form_output_job_history').html('');

                    swal({
                        text: data.success,
                        icon: "success",
                    }).then(function () {
                        location.reload();
                    });
                }
            }
        });
}
function addPublication() {

    $("#employee_publication_form_info")[0].reset();
    $("#form_output_publication").html('');
    $("#published_update_id").val('');
    $("#saveBtnPub").show();
    $("#updateBtnPub").hide();
    $("#heading-title").html('Add publication information ');

    $("#author_info").hide();
    $("#title_info").hide();
    $("#year_info").hide();
    $("#city_info").hide();
    $("#publisher_info").hide();
    $("#book_title_info").hide();
    $("#book_author_info").hide();
    $("#page_info").hide();
    $("#journal_name_info").hide();
    $("#volume_info").hide();
    $("#issue_info").hide();
    $("#conference_publication_name_info").hide();


    $("#parent_author").show();
    $("#child_author").html('');
}
function updatePublication(id,source_type) {

    $("#employee_publication_form_info")[0].reset();
    $("#form_output_publication").html('');
    $("#saveBtnPub").hide();
    $("#updateBtnPub").show();
    $("#heading-title").html('Update publication information ');

    $("#author_info").hide();
    $("#title_info").hide();
    $("#year_info").hide();
    $("#city_info").hide();
    $("#publisher_info").hide();
    $("#book_title_info").hide();
    $("#book_author_info").hide();
    $("#page_info").hide();
    $("#journal_name_info").hide();

    $("#volume_info").hide();
    $("#issue_info").hide();

    $("#conference_publication_name_info").hide();

    typeOfSource(source_type);

    $("#type_of_source").val(source_type);

    $.ajax({
        type: "POST",
        url: base_url + "/show_publication_info",
        data: {publication_id: id},
        'dataType': 'json',
        success: function (response) {
            if (response.status == 'success') {
               var data=response.data;


               $("#book_author").val(data.book_author);
               $("#book_title").val(data.book_title);
               $("#city").val(data.city);
               $("#conference_publication_name").val(data.conference_publication_name);
               $("#impact_factor").val(data.impact_factor);
               $("#indexed_by").val(data.indexed_by);
               $("#web_url").val(data.web_url);
               $("#journal_name").val(data.journal_name);

               $("#volume").val(data.volume);
               $("#issue").val(data.issue);

               $("#keyword").val(data.keyword);
               $("#page").val(data.page);
               $("#publisher").val(data.publisher);
               $("#title_publication").val(data.title);
               $("#year").val(data.year);
               $("#published_update_id").val(data.id);
               var ajk=100;

                $("#parent_author").hide();
                $("#child_author").html('');

                if(data.author !== null) {
                    var obj_data = jQuery.parseJSON(data.author);
                        $.each(obj_data, function (index, Obj) {
                           $('#child_author').append('<div class="row" id="childRow'+ ajk +'" style="margin-top:10px;"><div class="col-md-8"><input type="text" id="author' + ajk + '" class="form-control" value="' + Obj.authoer + '" placeholder="Author"  name="author[' + ajk + ']"/></div><div class="col-md-2"><label class="checkbox-inline"> <input type="checkbox"  name="self[' + ajk + ']"   id="self_data_' + ajk + '"> Self</label></div><div class="col-md-2"><button type="button"  id="deleteRow_'+ ajk +'"  class="removeAuthor btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i></button></div></div>')
                           if (Obj.is_self == 1) {
                               $("#self_data_" + ajk).attr('checked', true);
                           }
                           ajk++;

                       })

                }else{
                    $("#parent_author").show();
                }
            }
        }
    });

}

function deletePublicationConfirm(id) {
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
                    url: base_url + "/delete_publication_info",
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
function deleteResearchInterestConfirm(id) {
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
                    url: base_url + "/delete_research_interest_info",
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

function deleteExperienceConfirm(id) {
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
                    url: base_url + "/delete_job_experience_info",
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

function deleteAwardConfirm(id) {
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
                    url: base_url + "/delete_award_info",
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

function deleteResearchStudentConfirm(id) {
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
                    url: base_url + "/delete_research_student_info",
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


function deleteInvitedTalkConfirm(id) {
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
                    url: base_url + "/delete_inivted_talk_info",
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

function deleteCollaborationMembershipConfirm(id) {
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
                    url: base_url + "/delete_collaboration_member_talk_info",
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









function typeOfSource(source_id){
    if(source_id==''){
        $("#author_info").hide();
        $("#title_info").hide();
        $("#year_info").hide();
        $("#city_info").hide();
        $("#publisher_info").hide();
        $("#book_title_info").hide();
        $("#book_author_info").hide();
        $("#page_info").hide();
        $("#journal_name_info").hide();
        $("#volume_info").hide();
        $("#issue_info").hide();
        $("#conference_publication_name_info").hide();

    }
    if(source_id==60){

        $("#book_title_info").hide();
        $("#book_author_info").hide();
        $("#page_info").hide();
        $("#journal_name_info").hide();
        $("#volume_info").hide();
        $("#issue_info").hide();
        $("#conference_publication_name_info").hide();

        $("#author_info").show();
        $("#title_info").show();
        $("#year_info").show();
        $("#city_info").show();
        $("#publisher_info").show();
        $("#impact_factor_info").show();


    }else if(source_id==61){


        $("#volume_info").hide();
        $("#issue_info").hide();
        $("#journal_name_info").hide();
        $("#conference_publication_name_info").hide();

        $("#title_info").show();
        $("#author_info").show();
        $("#book_title_info").show();
        $("#book_author_info").show();
        $("#year_info").show();
        $("#page_info").show();
        $("#city_info").show();
        $("#publisher_info").show();
        $("#impact_factor_info").show();




    }else if(source_id==62){
        $("#book_title_info").hide();
        $("#book_author_info").hide();
        $("#city_info").hide();
        $("#publisher_info").hide();
        $("#conference_publication_name_info").hide();

        $("#author_info").show();
        $("#title_info").show();
        $("#journal_name_info").show();
        $("#year_info").show();
        $("#page_info").show();
        $("#volume_info").show();
        $("#issue_info").show();
        $("#impact_factor_info").show();


    }
    else if(source_id==63){
        $("#book_title_info").hide();
        $("#book_author_info").hide();
        $("#journal_name_info").hide();
        $("#volume_info").hide();
        $("#issue_info").hide();
        $("#impact_factor_info").hide();


        $("#author_info").show();
        $("#title_info").show();
        $("#page_info").show();
        $("#year_info").show();
        $("#conference_publication_name_info").show();
        $("#city_info").show();
        $("#publisher_info").show();

    }

}
var ik=1;
$('#add_author').click(function ()
{
    $('#child_author').append('<div class="row" id="childRow'+ ik +'" style="margin-top:10px;"><div class="col-md-8"><input type="text" id="author'+ ik +'" class="form-control" placeholder="Author"  name="author['+ ik +']"/></div><div class="col-md-2"><label class="checkbox-inline"> <input type="checkbox"  name="self['+ ik +']"   id="self'+ ik +'"> Self</label></div><div class="col-md-2"><button type="button"  id="deleteRow_'+ ik +'"  class="removeAuthor btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i></button></div></div>');
    ik++;

});
$(document).on("click", ".removeAuthor", function (e) {
    var element_id = elementId($(this).attr('id'));
    $(this).closest("#childRow"+element_id).remove();
});
function savePublicationInfo() {
	 $("#saveBtnPub").attr('disabled',true);
    swal({
        title: "Are you sure?",
        text: "Once Save, You will saved this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/save_publication_info",
                    data: $('#employee_publication_form_info').serialize(),
                    'dataType': 'json',
                    success: function (data) {
						$("#saveBtnPub").attr('disabled',false);
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#form_output_publication').html(error_html);
                        } else {
                            $('#employee_publication_form_info')[0].reset();
                            $('#form_output_publication').html('');

                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                location.reload();
                            });
                        }
                    }
                });
            } else {
                swal("Cancelled Now!");
            }
        });
}

function updatePublicationInfo() {
    $.ajax({
        type: "POST",
        url: base_url + "/update_publication_info",
        data: $('#employee_publication_form_info').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_publication').html(error_html);
            } else {
                $('#employee_publication_form_info')[0].reset();
                $('#form_output_publication').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });

}

// $(document).ready(function(){
//
//     var editAbstract=CKEDITOR.instances.short_biography;
//
//     editAbstract.on("key",function(e) {
//
//         var maxLength=e.editor.config.maxlength;
//
//         e.editor.document.on("keyup",function() {KeyUp(e.editor,maxLength,"letterCount");});
//         e.editor.document.on("paste",function() {KeyUp(e.editor,maxLength,"letterCount");});
//         e.editor.document.on("blur",function() {KeyUp(e.editor,maxLength,"letterCount");});
//     },editAbstract.element.$);
//
//     //function to handle the count check
//
//
// });
// function KeyUp(editorID,maxLimit,infoID) {
//     var text= CKEDITOR.instances['editor'].getData();
//     if(text.length>maxLimit) {
//         alert("You cannot have more than "+maxLimit+" characters");
//         CKEDITOR.instances['editor'].setData(text.substr(0,maxLimit));
//
//         $("#remainning_charter").text(0);
//         return false;
//     }else {
//         var remainning_char = parseFloat(300) - parseFloat(text.length);
//         $("#remainning_charter").text(remainning_char);
//     }
// }
// CKEDITOR.instances.editor.document.on('blur', function(event) {
//     KeyUp('editor','300','letterCount')
// });
// CKEDITOR.on('instanceCreated', function(e) {
//     if (e.editor.name === editor) { //editorId is the id of the textarea
//
//         e.editor.on('change', function(evt) {
//             alert('jhe');
//             KeyUp('editor','300','letterCount');
//         });
//     }
// });
$(document).ready(function (e) {
    // CKEDITOR.instances['editor'].on('blur', function() {
    //     KeyUp('editor','300','letterCount')
    // });
    // KeyUp('editor','300','letterCount');
    $("#employee_ict_credentials_form").on('submit',(function(e) {
        var ckeditor_id = CKEDITOR.instances['editor'].getData();
		ckeditor_id = ckeditor_id.replace(/[&]nbsp[;]/gi," ");
        var formData = new FormData(this)
        formData.append('short_biography', ckeditor_id);
        e.preventDefault();
        $.ajax({
            url: base_url + "/save_employee_ict_credentials", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            'dataType': 'json',
            success: function(data)   // A function to be called if request succeeds
            {

                if (data.error.length > 0) {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) {
                        error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                    }
                    $('#basic_info_output').html(error_html);
                } else {
                    $('#basic_info_output').html('');
                    swal({
                        text: data.success,
                        icon: "success",
                    }).then(function () {
                        // location.reload();
                        window.location.reload()
                    });
                }
            }
        });
    }));
	
	
	$("#student_info_update_form").on('submit',(function(e) {
       
        var formData = new FormData(this)
        e.preventDefault();
        $.ajax({
            url: base_url + "/update_student_profile_action", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            'dataType': 'json',
            success: function(data)   // A function to be called if request succeeds
            {

                if (data.error.length > 0) {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) {
                        error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                    }
                    $('#student_info_output').html(error_html);
                } else {
                    $('#student_info_output').html('');
                    swal({
                        text: data.success,
                        icon: "success",
                    }).then(function () {
                        // location.reload();
                        window.location.reload()
                    });
                }
            }
        });
    }));
	
	
	
	
	
});



$("#employee_data").DataTable({
    "processing": true,
    "serverSide": true,
    "dataType": 'json',
    "ajax": "all_employee_info_ajax",
    "columns": [
        {"data": "emp_id", name: 'employees.emp_id'},
        {"data": "emp_name",name: 'employees.emp_name'},
        {"data": "faculty_name",name: 'faculty.name'},
        {"data": "department_name",name: 'faculty.bodyid'},
        {"data": "designation_title",name: 'desi_name.designation'},
        {"data": "action", orderable: false, searchable: false}
    ],
    responsive: true
});

$("#employee_salary_assign").DataTable({
    "processing": true,
    "serverSide": true,
    "dataType": 'json',
    "ajax": "employee_salary_assign_ajax",
    "columns": [
        {"data": "employee_id"},
        {"data": "emp_name"},
        {"data": "station_name"},
        {"data": "mobile"},
        {"data": "department_title"},
        {"data": "designation_title"},
        {"data": 'created_time'},
        {"data": "action", orderable: false, searchable: false}
    ],
    responsive: true
});


$(document).on("click", ".deleteRow", function (e) {
    var target = e.target;
    $(target).closest('tr').remove();
});




function AddManualApplication() {
    $("#addManualApp")[0].reset();
    $("#saveBtn").show();
    $("#updateBtn").hide();
    $("#heading-title").html('Add Manual Application ');
    $("#tableDynamic").html('');
}

function AddLoanApplication() {
    $("#addLoanApp")[0].reset();
    $("#saveBtn").show();
    $("#updateBtn").hide();
    $("#heading-title").html('Add Loan Application ');
    $("#tableDynamic").html('');
}

$("#physical_disability").change(function () {
    var physical_disability_val = $(this).val();
    if (physical_disability_val == 1) {
        $("#disability_yes_details").attr('readonly', true);
        $("#disability_yes_details").val('');
    } else {
        $("#disability_yes_details").attr('readonly', false);
        $("#disability_yes_details").focus();
    }
});

$("#present_district").change(function () {
    var district_id = $(this).val();
    $.ajax({
        type: "POST",
        url: base_url + "/show_upazila_by_district",
        data: {district_id: district_id},
        'dataType': 'json',
        success: function (response) {
            $('#present_police_station').html('<option value="">Select Upazila</option>');
            if (response.status == 'success') {
                $.each(response.data, function (index, Obj) {
                    $('#present_police_station').append('<option value="' + index + '">' + Obj + '</option>')
                })
            }
        }
    });
});

$("#parmanent_district").change(function () {
    var district_id = $(this).val();
    $.ajax({
        type: "POST",
        url: base_url + "/show_upazila_by_district",
        data: {district_id: district_id},
        'dataType': 'json',
        success: function (response) {
            $('#parmanent_police_station').html('<option value="">Select Upazila</option>');
            if (response.status == 'success') {
                $.each(response.data, function (index, Obj) {
                    $('#parmanent_police_station').append('<option value="' + index + '">' + Obj + '</option>')
                })
            }
        }
    });

});


$("#checkedBcsCadre").change(function () {
    if ($(this).prop('checked')) {
        $(".show_bcs_cadre").show();
    } else {
        $(".show_bcs_cadre").hide();
    }
});

$("#save_present_parmanent_address").change(function () {
    if ($(this).prop('checked')) {
        $(".same_present_address").attr('disabled', true);
    } else {
        $(".same_present_address").attr('disabled', false);
    }
});
$("#employee_name_search").click(function () {
    $("#employee_name_search").val('');
    $('#employee_id_search').val('');
    $("#employee_info_search").hide();

});




function autocompleteEmployeeInfo(data) {
    if ( data.value.trim() == '') {
        $('#employee_id_search').val('');
        return false;
    }
    var options = {
        minLength: 1,
        source: function (request, response) {
            $.ajax({
                url: base_url + "/searching_employee_info",
                method: 'post',
                dataType: "json",
                autoFocus:true,
                data: {
                    term: request.term,
                },
                success: function (data) {
                    // if(data.length>0) {
                        response(data);
                    // }else{
                    //     $("#employee_info_search").hide();
                    //     $('#employee_id_search').val('');
                    // }

                }
            });
        },
        select: function (event, ui) {
            $( "#spinner" ).hide();
            if(ui.item.value !='') {
                $('#employee_name_search').val(ui.item.value);
                $('#employee_id_search').val(ui.item.id);
                $("#employee_info_search").show();
                $.ajax({
                    type: "POST",
                    url: base_url + "/get_employee_info",
                    data: {employee_id:ui.item.id},
                    'dataType': 'json',
                    success: function (response) {
                        if (response.status=='error') {
                            $("#employee_info_search").hide();
                        } else {
                            var all_data=response.data;
                            if(all_data.image==null){
                                image_url= base_url+'/images/default/betar_default_2.jpg';
                            }else {
                                var image_url = all_data.image_location + all_data.image;
                            }
                            $("#show_image").attr("src", image_url);
                            $("#faculty_member_name").html(all_data.emp_name);
                            $("#faculty_member_faculty").html(all_data.faculty_name);
                            $("#faculty_member_designation").html(all_data.designation_title);
                            $("#faculty_member_department").html(all_data.department_name);
                            $("#faculty_member_mobile").html(all_data.office_mobile);
                            $("#faculty_member_email").html(all_data.office_email);
                        }
                    }
                });

            }else{
                $('#employee_name_search').val('');
                $('#employee_id_search').val('');
                $("#employee_info_search").hide();
            }
            return false;
        }
    };
    $('body').on('keydown.autocomplete', '#employee_name_search', function() {
        $(this).autocomplete(options);
    });
}


// report
function employee_designation_search() {
    $.ajax({
        type: "POST",
        url: base_url + "/search_employee_designation_report",
        data: $('#employee_report_form').serialize(),
        success: function (response) {
            if (response.status=='error') {
                var error='<div class="alert alert-danger">' + response.message + '</div>'
                $('#error_data').html(error);
                $('#show_report_info').html('');
            } else {
                $('#error_data').html('');
                $('#show_report_info').html(response);

            }
        }
    });
}
function employee_department_search() {
    $.ajax({
        type: "POST",
        url: base_url + "/search_employee_department_report",
        data: $('#employee_report_form').serialize(),
        success: function (response) {
            if (response.status=='error') {
                var error='<div class="alert alert-danger">' + response.message + '</div>'
                $('#error_data').html(error);
                $('#show_report_info').html('');
            } else {
                $('#error_data').html('');
                $('#show_report_info').html(response);

            }
        }
    });
}

function employee_edu_degree_search() {
    $.ajax({
        type: "POST",
        url: base_url + "/search_employee_education_report",
        data: $('#employee_report_form').serialize(),
        success: function (response) {
            if (response.status=='error') {
                var error='<div class="alert alert-danger">' + response.message + '</div>'
                $('#error_data').html(error);
                $('#show_report_info').html('');
            } else {
                $('#error_data').html('');
                $('#show_report_info').html(response);

            }
        }
    });
}

$("#faculty_id").change(function () {
    var faculty_id = $(this).val();
    $.ajax({
        type: "POST",
        url: base_url + "/show_faculty_ajax",
        data: {faculty_id: faculty_id},
        'dataType': 'json',
        success: function (response) {
            $('#department_id').html('<option value="">Select Department</option>');
            if (response.status == 'success') {
                $.each(response.data, function (index, Obj) {
                    $('#department_id').append('<option value="' + index + '">' + Obj + '</option>')
                })
            }
        }
    });

});

function updatePassword() {
    swal({
        title: "Are you sure?",
        text: "If you upload your password, your old password will be replaced by new one",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/change_password_action",
                    data: $('#change_password_action_form').serialize(),
                    'dataType': 'json',
                    success: function (response) {
                        if (response.status == 'success') {
                            swal({
                                text: response.message,
                                icon: "success",
                            }).then(function () {
                                location.reload();
                            });
                            $("#change_password_info_output").html('');
                        } else {
                            var error_html = '<div class="alert alert-danger">' + response.message + '</div>';
                            $("#change_password_info_output").html(error_html);
                        }
                    }
                });
            }
        });
}

function updatePasswordDepartment() {
    swal({
        title: "Are you sure?",
        text: "If you upload your password, your old password will be replaced by new one",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/change_password_action_dept",
                    data: $('#employee_change_password_form').serialize(),
                    'dataType': 'json',
                    success: function (response) {
                        if (response.status == 'success') {
                            swal({
                                text: response.message,
                                icon: "success",
                            }).then(function () {
                                location.reload();
                            });
                            $("#change_password_info_output").html('');
                        } else {
                            var error_html = '<div class="alert alert-danger">' + response.message + '</div>';
                            $("#change_password_info_output").html(error_html);
                        }
                    }
                });
            }
        });
}


// leave modules

function addLeave() {
    $("#employee_leave_info")[0].reset();
    $("#form_output").html('');
    $("#saveBtn").show();
    $("#updateBtn").hide();
    $("#heading-title-leave").html('Add factuly leave information ');
    $("#permission_description_info").hide();
    $("#medical_certificate").hide();
    $("#invitation_letter").hide();
    $("#pervious_aboard_leave_info").hide();
}
$("#if_permission_applicable").change(function () {
    if ($(this).prop('checked')) {
        $("#permission_description_info").show();
    } else {
        $("#permission_description_info").hide();
    }
});

$("#medical_leave").change(function () {
    if ($(this).prop('checked')) {
        $("#medical_certificate").show();
    } else {
        $("#medical_certificate").hide();
    }
});

$("#invitation_leave").change(function () {
    if ($(this).prop('checked')) {
        $("#invitation_letter").show();
    } else {
        $("#invitation_letter").hide();
    }
});

$("#pervious_aboard_leave").change(function () {
    if ($(this).prop('checked')) {
        $("#pervious_aboard_leave_info").show();
    } else {
        $("#pervious_aboard_leave_info").hide();
    }
});

$(document).on("change", ".change_degree_name", function (e) {
    var element_id = elementId($(this).attr('id'));
    var degree_value=$(this).val();
    if(degree_value==71){
        $("#division_"+element_id).val('Awarded');
        $("#division_"+element_id).attr('readonly',true);
    }else{
        $("#division_"+element_id).val('');
        $("#division_"+element_id).attr('readonly',false);
    }

});

function addLeaveAdmin() {
    $("#employee_leave_info_form")[0].reset();
    $("#employee_info_search").hide();
    $("#saveBtn").show();
    $("#charge_hand_over_info").hide();
    $("#leaveTypeTr").html('');
    $("#show_country_name").html('');
    $("#designationChargedInfo").html('');
    // $("#designation_charge_1").val('');
    // $("#hand_over_to_1").val('');
    // $("#hand_over_to_id_1").val('');
}
$("#is_charge_hand_over").change(function () {
    if ($(this).prop('checked')) {
        $("#charge_hand_over_info").show();
    } else {
        $("#charge_hand_over_info").hide();
    }
    $("#designationChargedInfo").html('');
    $("#designation_charge_1").val('');
    $("#hand_over_to_1").val('');
    $("#hand_over_to_id_1").val('');
});

$("#cancelled_leave").change(function () {
    if ($(this).prop('checked')) {
        $("#cancelled_leave_info").show();
    } else {
        $("#cancelled_leave_info").hide();
    }
    $("#remove_noc_ref_no").val('Regi/Admn.-');
    $("#remove_noc_ref_date").val('');
    $("#cancelled_reason").val('');
});
$("#partical_leave_info").change(function () {
    if ($(this).prop('checked')) {
        $("#show_partical_leave_info").show();
    } else {
        $("#show_partical_leave_info").hide();
    }
});

$(document).on("keyup.autocomplete",".country_name",function(){
    var element_id = elementId($(this).attr('id'));
    var country_name=$(this).val();
    var options = {
        minLength: 1,
        source: function (request, response) {
            $.ajax({
                url: base_url + "/searching_country_info",
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
                    //     $('#country_name_'+element_id).val('');
                    //     $('#country_name_id_'+element_id).val('');
                    // }
                }
            });
        },
        select: function (event, ui) {
            if(ui.item.value !='') {
                $('#country_name_'+element_id).val(ui.item.value);
                $('#country_name_id_'+element_id).val(ui.item.id);
            }else{
                $('#country_name_'+element_id).val('');
                $('#country_name_id_'+element_id).val('');
            }
            return false;
        }
    };
    $('body').on('keyup.autocomplete', "#country_name_"+element_id, function() {
        $(this).autocomplete(options);
    });
});

$(document).on("keyup.autocomplete",".hand_over_to",function(){
    var element_id = elementId($(this).attr('id'));
    var options = {
        minLength: 1,
        source: function (request, response) {
            $.ajax({
                url: base_url + "/searching_employee_info",
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
                $('#hand_over_to_'+element_id).val(ui.item.value);
                $('#hand_over_to_id_'+element_id).val(ui.item.id);
            }else{
                $('#hand_over_to_'+element_id).val('');
                $('#hand_over_to_id_'+element_id).val('');
            }
            return false;
        }
    };
    $('body').on('keyup.autocomplete', "#hand_over_to_"+element_id, function() {
        $(this).autocomplete(options);
    });
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
}function updateEmployeeLeaveInfo() {
    $("#saveBtn").attr('disabled',true);
    $.ajax({
        type: "POST",
        url: base_url + "/update_employee_leave_info",
        data: $('#employee_leave_info_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                $("#saveBtn").attr('disabled',false);
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
function deleteLeaveConfirm(id) {
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
                    url: base_url + "/delete_leave_info",
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


function searchLeaveInfo() {
    $.ajax({
        type: "POST",
        url: base_url + "/search_leave_info",
        data: $('#employee_leave_info_search').serialize(),
        success: function (data) {
            $('#show_leave_info').html(data);
        }
    });
}


$(document).on("change", ".from_dt", function (e) {
    // alert('hello');
    var element_id = elementId($(this).attr('id'));
    var from = $("#from_date_"+element_id).val();
    var to = $("#to_date_"+element_id).val();
    var newfromdate = from.split("-").reverse().join("-");
    var newtodate = to.split("-").reverse().join("-");
    dt1 = new Date(newfromdate);
    dt2 = new Date(newtodate);
    if(Date.parse(dt1) > Date.parse(dt2) && (dt2!='')){
        alert("Invalid Date Range! Start date must be smaller than end date.");
        $("#from_date_"+element_id).val('');
        $("#count_days_"+element_id).val('');
    }
});
$(document).on("change", ".to_dt", function (e) {
    var element_id = elementId($(this).attr('id'));
    var from = $("#from_date_"+element_id).val();
    var to = $("#to_date_"+element_id).val();
    if(from==''){
        alert("Invalid Date Range! From Date is required");
        $("#to_date_"+element_id).val('');
        $("#count_days_"+element_id).val('');
    }else {
        var newfromdate = from.split("-").reverse().join("-");
        var newtodate = to.split("-").reverse().join("-");
        dt1 = new Date(newfromdate);
        dt2 = new Date(newtodate);
        var days = Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate())) / (1000 * 60 * 60 * 24));

        if (Date.parse(dt1) > Date.parse(dt2) && (dt2 != '')) {
            alert("Invalid Date Range! End date must be greater than start date.");
            $("#to_date_" + element_id).val('');
            $("#count_days_" + element_id).val('');
        } else {
            var days_count = parseInt(days) + 1;
            $("#count_days_" + element_id).val(days_count)
        }
    }
});

function changePassword(employee_id) {
    $("#employee_change_password_form")[0].reset();
    $.ajax({
        type: "POST",
        url: base_url + "/get_employee_info",
        data: {employee_id: employee_id},
        'dataType': 'json',
        success: function (response) {
            if (response.status == 'success') {
                var data=response.data;
                $("#faculty_member_name").val(data.emp_name);
                $("#email").val(data.office_email);
                $("#employee_id").val(data.employee_id);
                $("#change_password_info_output").html('');
            }
        }
    });
}

function addMembershipCollaboration() {
    $("#employee_collaboration_membership_form")[0].reset();
    $("#form_output_collaboration_membership").html('');
    $("#saveBtnCollaboration").show();
    $("#updateBtnCollaboration").hide();
    $("#heading-title-collaboration-membership").html('Add Collaboration Membership information ');
    $("#collaboration_expire_year").attr('disabled',false);
}
function editBtnMembershipCollaborationShow(id) {
    $("#employee_collaboration_membership_form")[0].reset();
    $("#form_output_collaboration_membership").html('');
    $("#saveBtnCollaboration").hide();
    $("#updateBtnCollaboration").show();
    $("#heading-title-collaboration-membership").html('Updated Collaboration Membership information  ');

    $.ajax({
        type: "POST",
        url: base_url + "/get_collaboration_member_info",
        data: {collaboration_member_id: id},
        'dataType': 'json',
        success: function (response) {
            if (response.status == 'success') {
                var data = response.data;
                console.log(data);
                $("#collaboration_membership_name").val(data.colla_membership_title);
                $("#collaboration_type").val(data.type);
                $("#collaboration_year").val(data.year);
                if (data.is_live_time == 1){
                    $("#liveTime").attr('checked', true);
                    $("#collaboration_expire_year").attr('disabled',true);
                } else{
                    $("#liveTime").attr('checked',false);
                    $("#collaboration_expire_year").attr('disabled',false);
                    $("#collaboration_expire_year").val(data.expire_date);
                }
                $("#collaboration_member_id").val(data.id);

            }
        }
    });
}

$(document).ready(function (e) {
    $("#employee_cv_info_form").on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this)
        $.ajax({
            url: base_url + "/save_employee_cv_data", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            'dataType': 'json',
            success: function(data)   // A function to be called if request succeeds
            {

                if (data.error.length > 0) {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) {
                        error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                    }
                    $('#form_output_cv_info').html(error_html);
                } else {
                    $('#form_output_cv_info').html('');
                    swal({
                        text: data.success,
                        icon: "success",
                    }).then(function () {
                        // location.reload();
                        window.location.reload()
                    });
                }
            }
        });
    }));

});

$(document).on("click", "#liveTime", function (e) {
    if($(this).is(":checked")) {
        $("#collaboration_expire_year").attr('disabled',true)
    } else {
        $("#collaboration_expire_year").attr('disabled',false);
    }
    $("#collaboration_expire_year").val('')
});

function addInvitationTalk() {
    $("#employee_invited_talk_info_form")[0].reset();
    $("#form_output_invited_talk").html('');
    $("#saveBtnInvitedTalk").show();
    $("#updateBtnInvitedTalk").hide();
    $("#heading-title-invited-talk").html('Add Invited Talk  ');
    CKEDITOR.instances.invitedTalkDetails.setData( '' );
}
function updateBtnInvitedTalkShow(id) {
    $("#employee_invited_talk_info_form")[0].reset();
    $("#form_output_invited_talk").html('');
    $("#saveBtnInvitedTalk").hide();
    $("#updateBtnInvitedTalk").show();
    $("#heading-title-invited-talk").html('Updated Invited Talk  ');

    $.ajax({
        type: "POST",
        url: base_url + "/get_invited_talk_info",
        data: {invited_talk_id: id},
        'dataType': 'json',
        success: function (response) {
            if (response.status == 'success') {
                var data=response.data;
                $("#invited_talk_id").val(data.id);
                CKEDITOR.instances.invitedTalkDetails.setData( data.description );
            }
        }
    });
}


function updateInvitedTalk() {
    var Invited_talk = CKEDITOR.instances['invitedTalkDetails'].getData();
	Invited_talk = Invited_talk.replace(/[&]nbsp[;]/gi," ");
    if(Invited_talk==''){
        $('#form_output_invited_talk').html('<div class="alert alert-danger">Invited Talk is required</div>');
        return ;
    }else{
        $('#form_output_invited_talk').html('');
    }
    $.ajax({
        type: "POST",
        url: base_url + "/save_employee_invited_talk",
        data: $('#employee_invited_talk_info_form').serialize()+ '&Invited_talk='+Invited_talk,
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_invited_talk').html(error_html);
            } else {
                $('#form_output_invited_talk').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });

}

function updateCollaborationMember() {
    $.ajax({
        type: "POST",
        url: base_url + "/save_employee_collaboration_member",
        data: $('#employee_collaboration_membership_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_collaboration_membership').html(error_html);
            } else {
                $('#form_output_collaboration_membership').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });

}


function updatePayslipInfo () {
    $.ajax({
        type: "POST",
        url: base_url + "/update_payslip_info_action",
        data: $('#update_payslip_info_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#payslip_info_output').html(error_html);
            } else {
                $('#payslip_info_output').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });

}

// for fine arts faculty
function addFineArtsExhibition() {
    $("#addFineArtsExhibitionInfoForm")[0].reset();
    $("#form_output_exhibition").html('');
    $("#saveBtnFineArtsExhibition").show();
    $("#updateBtnFineArtsExhibition").hide();
    $("#heading-title-fine-arts-exhibition").html('Add Exhibition information ');
    $("#exhibition_group").hide();
    $("#exh_country").select2("val", '');
}
function updateFineArtsExhibition(data) {
    $("#addFineArtsExhibitionInfoForm")[0].reset();
    $("#form_output_exhibition").html('');
    $("#saveBtnFineArtsExhibition").hide();
    $("#updateBtnFineArtsExhibition").show();
    $("#heading-title-fine-arts-exhibition").html('Update Exhibition information ');
    $("#exhibition_group").hide();
    if(data!=''){
        var data = JSON.parse(data);
        if(data.exh_category==2){
            $("#exhibition_group").show();
            $("#exh_art_work_title").val(data.exh_art_work_title);
            $("#exh_medium").val(data.exh_medium);
            $("#exh_size").val(data.exh_size);
            $("#exh_year").val(data.exh_year);
        }
        $("#exh_category").val(data.exh_category);

        $("#exh_type").val(data.exh_type);
        $("#exh_title").val(data.exh_title);
        $("#exh_venue").val(data.exh_venue);
        $("#exh_curator").val(data.exh_curator);
        $("#exh_organizer").val(data.exh_organizer);
        $("#exh_city").val(data.exh_city);
        $("#exh_country").select2("val", data.exh_country);
        $("#year_exhibition").val(data.year_exhibition);
        $("#exh_description").val(data.exh_description);
        $("#exhibition_id").val(data.id);
    }else{
        var data='';
    }
}
function updateFineArts() {
    $.ajax({
        type: "POST",
        url: base_url + "/save_fine_arts_exhibition",
        data: $('#addFineArtsExhibitionInfoForm').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_exhibition').html(error_html);
            } else {
                $('#form_output_exhibition').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });

}

function deleteFineArtsExhibition(id,employee_id) {
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
                    url: base_url + "/delete_fine_arts_exhibition",
                    data: {id: id,employee_id:employee_id},
                    'dataType': 'json',
                    success: function (response) {
                        console.log(response);
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
$("#exh_category").change(function () {
    var ctg_val = $(this).val();
    if (ctg_val == 1) {
        $("#exhibition_group").hide();
    } else {
        $("#exhibition_group").show();
    }
});




$("#workshop_role").change(function () {
    var role_val = $(this).val();
    if (role_val == 1) {
        $("#conductor_name_info").hide();
    } else {
        $("#conductor_name_info").show();
    }
});



function addWorkshopCamp() {
    $("#addFineArtsWorkshopForm")[0].reset();
    $("#form_output_workshop").html('');
    $("#saveBtnFineArtsWorkshop").show();
    $("#updateBtnFineArtsWorkshop").hide();
    $("#heading-title-fine-arts-workshop").html('Add workshop/camp information ');
}

function updateWorkshopCamp(data) {
    $("#addFineArtsWorkshopForm")[0].reset();
    $("#form_output_workshop").html('');
    $("#saveBtnFineArtsWorkshop").show();
    $("#updateBtnFineArtsWorkshop").hide();
    $("#heading-title-fine-arts-workshop").html('Update workshop/camp information ');
    if(data!=''){
        var data = JSON.parse(data);
        console.log(data);
        $("#workshop_type").val(data.workshop_type);
        $("#workshop_role").val(data.workshop_role);
        $("#workshop_title").val(data.workshop_title);
        $("#workshop_venue").val(data.workshop_venue);
        $("#workshop_organizer").val(data.workshop_organizer);
        $("#workshop_from_date").val(data.workshop_from_date);
        $("#workshop_to_date").val(data.workshop_to_date);
        $("#workshop_description").val(data.workshop_description);
        $("#workshop_id").val(data.id);
    }else{
        var data='';
    }
}
function updateWorkshopInfo() {
    $.ajax({
        type: "POST",
        url: base_url + "/save_workshshop_camp",
        data: $('#addFineArtsWorkshopForm').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_workshop').html(error_html);
            } else {
                $('#form_output_workshop').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}
function deleteWorkshopCamp(id,employee_id) {
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
                    url: base_url + "/delete_workshop_info",
                    data: {id: id,employee_id:employee_id},
                    'dataType': 'json',
                    success: function (response) {
                        console.log(response);
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



function addSeminarSymposium() {
    $("#addSeminarSymposiumInfoForm")[0].reset();
    $("#form_output_seminar_symposium").html('');
    $("#child_author_fine_art").html('');
    $("#saveBtnFineArtsSeminar").show();
    $("#updateBtnFineArtsSeminar").hide();
    $("#heading-title-fine-arts-seminar").html('Add Seminar/Symposium information ');
}
function updateSeminarSymposiumData(data) {
    console.log(data);
    $("#addSeminarSymposiumInfoForm")[0].reset();
    $("#form_output_seminar_symposium").html('');
    $("#child_author_fine_art").html('');
    $("#saveBtnFineArtsSeminar").hide();
    $("#updateBtnFineArtsSeminar").show();
    $("#heading-title-fine-arts-seminar").html('Update Seminar/Symposium information ');
    if(data!=''){
        var data = JSON.parse(data);
        var author_info_data=data.author_info;
        var fik_data=100;
        $("#parent_author_fine_arts").html('');
        if(author_info_data!='') {
            $.each(author_info_data, function (key, value) {
                $('#child_author_fine_art').append(`<div class="row" id="childRow${fik_data}" style="margin-top:10px;"><div class="col-md-7"><input type="text" id="author${fik_data}" class="form-control" placeholder="Author " value="${value.name}" name="author[${fik_data}]"/></div><div class="col-md-3"> <select class="form-control"  name="self[${fik_data}]"   id="self${fik_data}"> <option value="2">Co-author</option><option value="1">Self</option></select></div><div class="col-md-2" ><button type="button"  id="deleteRow_${fik_data}"  class="removeAuthor btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i></button></div></div>`);
                $("#self" + fik_data).val(value.author_type);
                fik_data++;
            });
        }
        $("#seminar_type").val(data.seminar_type);
        $("#seminar_title").val(data.seminar_title);
        $("#seminar_title_of_event").val(data.seminar_title_of_event);
        $("#seminar_organizer").val(data.seminar_organizer);
        $("#seminar_venue").val(data.seminar_venue);
        $("#seminar_city").val(data.seminar_city);
        $("#seminar_country").select2("val", data.seminar_country);
        $("#seminar_from_date").val(data.seminar_from_date);
        $("#seminar_to_date").val(data.seminar_to_date);
        $("#seminar_description").val(data.exh_description);
        $("#seminar_id").val(data.id);
    }else{
        var data='';
    }
}

var fik=1;
$('#add_author_fine_art').click(function ()
{
    $('#child_author_fine_art').append(`<div class="row" id="childRow${fik}" style="margin-top:10px;"><div class="col-md-7"><input type="text" id="author${fik}" class="form-control" placeholder="Author " name="author[${fik}]"/></div><div class="col-md-3"> <select class="form-control"  name="self[${fik}]"   id="self${fik}"> <option value="2">Co-author</option><option value="1">Self</option></select></div><div class="col-md-2" ><button type="button"  id="deleteRow_${fik}"  class="removeAuthor btn btn-warning btn-flat btn-sm"><i class="glyphicon glyphicon-remove"></i></button></div></div>`);
    fik++;

});


function updateSeminarSymposium() {
    $.ajax({
        type: "POST",
        url: base_url + "/save_seminar_symposium",
        data: $('#addSeminarSymposiumInfoForm').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_seminar_symposium').html(error_html);
            } else {
                $('#form_output_seminar_symposium').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}

function delete_seminar_symposium(id,employee_id) {
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
                    url: base_url + "/delete_seminar_symposium",
                    data: {id: id,employee_id:employee_id},
                    'dataType': 'json',
                    success: function (response) {
                        console.log(response);
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



// department information update

function updateAchievementInfo() {
     $.ajax({
        type: "POST",
        url: base_url + "/save_dept_achievement_info",
        data: $('#dept_achievement_info_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_achievement_info').html(error_html);
            } else {
                $('#form_output_achievement_info').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}
function updateAcademicProgramInfo() {
    $.ajax({
        type: "POST",
        url: base_url + "/save_academic_program_info",
        data: $('#save_academic_program_info_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_achievement_info').html(error_html);
            } else {
                $('#form_output_achievement_info').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}
function updateDeptAwardTeacher() {
    $.ajax({
        type: "POST",
        url: base_url + "/save_award_teacher_info",
        data: $('#save_award_teacher_info_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_award_teacher').html(error_html);
            } else {
                $('#form_output_award_teacher').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}
function updateDeptAwardStudent() {
    $.ajax({
        type: "POST",
        url: base_url + "/save_award_student_info",
        data: $('#save_award_student_info_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_award_student').html(error_html);
            } else {
                $('#form_output_award_student').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}
function updateDeptSchollarInfo() {
    $.ajax({
        type: "POST",
        url: base_url + "/save_dept_schollarship",
        data: $('#save_dept_schollarship_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_award_student').html(error_html);
            } else {
                $('#form_output_award_student').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}

function updateDeptProgramInfo() {
    $.ajax({
        type: "POST",
        url: base_url + "/save_dept_program_info",
        data: $('#save_dept_program_info_data_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_award_student').html(error_html);
            } else {
                $('#form_output_award_student').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}



$(document).ready(function (e) {
    // CKEDITOR.instances['editor'].on('blur', function() {
    //     KeyUp('editor','300','letterCount')
    // });
    // KeyUp('editor','300','letterCount');
    $("#save_dept_basic_info_form").on('submit',(function(e) {
        var description_bn = CKEDITOR.instances['description_bn'].getData();
        description_bn = description_bn.replace(/[&]nbsp[;]/gi," ");
        var description_en = CKEDITOR.instances['description_en'].getData();
        description_en = description_en.replace(/[&]nbsp[;]/gi," ");

        var formData = new FormData(this)
        formData.append('description_en', description_en);
        formData.append('description_bn', description_bn);
        e.preventDefault();
        $.ajax({
            url: base_url + "/save_dept_basic_info", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            'dataType': 'json',
            success: function(data)   // A function to be called if request succeeds
            {
                if (data.error.length > 0) {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) {
                        error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                    }
                    $('#basic_info_output').html(error_html);
                } else {
                    $('#basic_info_output').html('');
                    swal({
                        text: data.success,
                        icon: "success",
                    }).then(function () {
                        // location.reload();
                        window.location.reload()
                    });
                }
            }
        });
    }));

    $("#image_gallary_info_form").on('submit',(function(e) {
        var formData = new FormData(this);
        e.preventDefault();
        $.ajax({
            url: base_url + "/save_gallary_image_info",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            'dataType': 'json',
            success: function(data)
            {
                if (data.error.length > 0) {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) {
                        error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                    }
                    $('#form_output_image_info').html(error_html);
                } else {
                    $("#image_gallary_info_form")[0].reset();
                    $('#form_output_image_info').html('');
                    swal({
                        text: data.success,
                        icon: "success",
                    }).then(function () {
                        window.location.reload()
                    });
                }
            }
        });
    }));






    //hall information update
    $("#save_hall_basic_info_form").on('submit',(function(e) {
        var description_bn = CKEDITOR.instances['description_bn'].getData();
        description_bn = description_bn.replace(/[&]nbsp[;]/gi," ");
        var description_en = CKEDITOR.instances['description_en'].getData();
        description_en = description_en.replace(/[&]nbsp[;]/gi," ");

        var formData = new FormData(this)
        formData.append('description_en', description_en);
        formData.append('description_bn', description_bn);
        e.preventDefault();
        $.ajax({
            url: base_url + "/save_hall_basic_info", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            'dataType': 'json',
            success: function(data)   // A function to be called if request succeeds
            {
                if (data.error.length > 0) {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) {
                        error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                    }
                    $('#basic_info_output').html(error_html);
                } else {
                    $('#basic_info_output').html('');
                    swal({
                        text: data.success,
                        icon: "success",
                    }).then(function () {
                        // location.reload();
                        window.location.reload()
                    });
                }
            }
        });
    }));

    $("#save_hall_image_gallary_info_form").on('submit',(function(e) {
        var formData = new FormData(this);
        e.preventDefault();
        $.ajax({
            url: base_url + "/save_hall_image_gallary_info",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            'dataType': 'json',
            success: function(data)
            {
                if (data.error.length > 0) {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) {
                        error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                    }
                    $('#save_hall_image_gallary_info_form').html(error_html);
                } else {
                    $("#save_hall_image_gallary_info_form")[0].reset();
                    $('#form_output_image_info').html('');
                    swal({
                        text: data.success,
                        icon: "success",
                    }).then(function () {
                        window.location.reload()
                    });
                }
            }
        });
    }));

    //Faculty information update
    $("#save_faculty_basic_info_form").on('submit',(function(e) {
        var description_bn = CKEDITOR.instances['description_bn'].getData();
        description_bn = description_bn.replace(/[&]nbsp[;]/gi," ");
        var description_en = CKEDITOR.instances['description_en'].getData();
        description_en = description_en.replace(/[&]nbsp[;]/gi," ");

        var formData = new FormData(this)
        formData.append('description_en', description_en);
        formData.append('description_bn', description_bn);
        e.preventDefault();
        $.ajax({
            url: base_url + "/save_faculty_basic_info", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            'dataType': 'json',
            success: function(data)   // A function to be called if request succeeds
            {
                if (data.error.length > 0) {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) {
                        error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                    }
                    $('#basic_info_output').html(error_html);
                } else {
                    $('#basic_info_output').html('');
                    swal({
                        text: data.success,
                        icon: "success",
                    }).then(function () {
                        // location.reload();
                        window.location.reload()
                    });
                }
            }
        });
    }));

    $("#save_dean_office_image_gallary_info_form").on('submit',(function(e) {
        $(".saveUpdateBtn").attr("disabled", true);
        var formData = new FormData(this);
        e.preventDefault();
        $.ajax({
            url: base_url + "/save_dean_office_image_gallary_info",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            'dataType': 'json',
            success: function(data)
            {
                if (data.error.length > 0) {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) {
                        error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                    }
                    $('#form_output_image_info').html(error_html);
                    $(".saveUpdateBtn").attr("disabled", false);
                } else {
                    $("#save_dean_office_image_gallary_info_form")[0].reset();
                    $('#form_output_image_info').html('');
                    $(".saveUpdateBtn").attr("disabled", false);
                    swal({
                        text: data.success,
                        icon: "success",
                    }).then(function () {
                        window.location.reload()
                    });
                }
            }
        });
    }));
	
	// research center basic information udate
	$("#save_research_center_basic_info_form").on('submit',(function(e) {


        var welcome_message = CKEDITOR.instances['welcome_message'].getData();
        welcome_message = welcome_message.replace(/[&]nbsp[;]/gi," ");

        



        // ekhlas start

        var director_message = CKEDITOR.instances['director_message'].getData();
        director_message = director_message.replace(/[&]nbsp[;]/gi," ");


        var chairman_message = CKEDITOR.instances['chairman_message'].getData();
        chairman_message = chairman_message.replace(/[&]nbsp[;]/gi," ");
    

        // ekhlas end
		
        var welcome_message_bn = CKEDITOR.instances['welcome_message_bn'].getData();
        welcome_message_bn = welcome_message_bn.replace(/[&]nbsp[;]/gi," ");
		$("#rBasicInfoUpdateBtn").attr('disabled',true);

        // console.log(chairman_message,director_message);
        // return false;
		

        var formData = new FormData(this)
        formData.append('welcome_message', welcome_message);
        formData.append('chairman_message', chairman_message);
        formData.append('director_message', director_message);
        formData.append('welcome_message_bn', welcome_message_bn);
        e.preventDefault();
        $.ajax({
            url: base_url + "/save_rcenter_basic_info", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            'dataType': 'json',
            success: function(data)   // A function to be called if request succeeds
            {
				$("#rBasicInfoUpdateBtn").attr('disabled',false);
                if (data.error.length > 0) {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) {
                        error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                    }
                    $('#basic_info_output').html(error_html);
                } else {
                    $('#basic_info_output').html('');
                    swal({
                        text: data.success,
                        icon: "success",
                    }).then(function () {
                        // location.reload();
                        window.location.reload()
                    });
                }
            }
        });
    }));
	
	$("#rs_center_image_gallary_info_form").on('submit',(function(e) {
        $(".saveBtnImage").attr("disabled", true);
        var formData = new FormData(this);
        e.preventDefault();
        $.ajax({
            url: base_url + "/rs_center_image_gallary_info",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            'dataType': 'json',
            success: function(data)
            {
                if (data.error.length > 0) {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) {
                        error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                    }
                    $('#form_output_image_info').html(error_html);
                    $(".saveBtnImage").attr("disabled", false);
                } else {
                    $("#rs_center_image_gallary_info_form")[0].reset();
                    $('#form_output_image_info').html('');
                    $(".saveBtnImage").attr("disabled", false);
                    swal({
                        text: data.success,
                        icon: "success",
                    }).then(function () {
                        window.location.reload()
                    });
                }
            }
        });
    }));
	
	// Department Profile Info
    $("#save_dept_profile_info_form").on('submit',(function(e) {
        var chairman_message = CKEDITOR.instances['chairman_message'].getData();
        chairman_message = chairman_message.replace(/[&]nbsp[;]/gi," ");
        /*
        var vision_mission = CKEDITOR.instances['vision_mission'].getData();
        vision_mission = vision_mission.replace(/[&]nbsp[;]/gi," ");
        var contact_info = CKEDITOR.instances['contact_info'].getData();
        contact_info = contact_info.replace(/[&]nbsp[;]/gi," ");
*/

        var formData = new FormData(this)
        formData.append('chairman_message', chairman_message);
       // formData.append('vision_mission', vision_mission);
      //  formData.append('contact_info', contact_info);
        e.preventDefault();
        $.ajax({
            url: base_url + "/save_dept_profile_info", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            'dataType': 'json',
            success: function(data)   // A function to be called if request succeeds
            {
                if (data.error.length > 0) {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) {
                        error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                    }
                    $('#basic_info_output').html(error_html);
                } else {
                    $('#basic_info_output').html('');
                    swal({
                        text: data.success,
                        icon: "success",
                    }).then(function () {
                        // location.reload();
                        window.location.reload()
                    });
                }
            }
        });
    }));


     $("#save_dept_about_info_form").on('submit',(function(e) {
         var history = CKEDITOR.instances['history'].getData();
         history = history.replace(/[&]nbsp[;]/gi," ");

        var vision_mission = CKEDITOR.instances['vision_mission'].getData();
        vision_mission = vision_mission.replace(/[&]nbsp[;]/gi," ");



        var formData = new FormData(this)
         formData.append('history', history);
        formData.append('vision_mission', vision_mission);

        e.preventDefault();
        $.ajax({
            url: base_url + "/save_dept_about_info", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            'dataType': 'json',
            success: function(data)   // A function to be called if request succeeds
            {
                if (data.error.length > 0) {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) {
                        error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                    }
                    $('#basic_info_output').html(error_html);
                } else {
                    $('#basic_info_output').html('');
                    swal({
                        text: data.success,
                        icon: "success",
                    }).then(function () {
                        // location.reload();
                        window.location.reload()
                    });
                }
            }
        });
    }));
	
	
	 // employee Email Log Information.....

    $("#uploadEmailRequestGsuiteLogForm").on('submit',(function(e) {
        var formData = new FormData(this)
        e.preventDefault();
        $.ajax({
            url: base_url + "/upload_email_request_Gsuite_log", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data)   // A function to be called if request succeeds
            {
                if (data!='') {
                    // $("#loader").hide();
                    $("#upload_file").val('');
                    $('#show_all_info').html(data);
                } else {


                }
            }
        });
    }));
	
	

});

function addImageGallary() {
    $("#image_gallary_info_form")[0].reset();
    $("#form_output_image_info").html('');
    $("#img_id_new").attr('src', base_url +'/images/default/default-avatar.png');
    $("#saveBtnImage").show();
    $("#updateBtnImage").hide();
    $(".heading-title-gallary").html('কার্যক্রম/প্রোগ্রামের নতুন ছবি ও তথ্য এন্টি ');
    $("#opeation_type").val('add');
}
function UpdateImageGallaryDept(id,title,image_link) {
   if(title!='') {
       var title_edited = title.replace(/^"|"$/g, '');
   }
    $("#image_gallary_info_form")[0].reset();
    $("#form_output_image_info").html('');
    $("#picture_title").val(title_edited);
    $("#old_picture").val(image_link);
    $("#img_id_new").attr('src', base_url +'/fontView/assets/department_photo_gallary/'+image_link);
    $("#image_id").val(id);
    $("#saveBtnImage").hide();
    $("#updateBtnImage").show();
    $(".heading-title-gallary").html('কার্যক্রম/প্রোগ্রামের ছবি তথ্য পরিবর্তন ');
    $("#opeation_type").val('update');
}
function deletePhotoGallaryConfirm(id) {
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
                    url: base_url + "/delete_dept_gallary_info",
                    data: {id: id},
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                           alert(error_html);
                        } else {
                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                window.location.reload();
                            });
                        }
                    }
                });
            }
        });
}

// hall informatin
function addImageGallaryHall() {
    $("#save_hall_image_gallary_info_form")[0].reset();
    $("#form_output_image_info").html('');
    $("#saveBtnImage").show();
    $("#updateBtnImage").hide();
    $(".heading-title-gallary").html('প্রোগ্রামের ছবি ');
    $("#img_id_new").attr('src', base_url +'/images/default/default-avatar.png');
    $("#opeation_type").val('add');
}
function UpdateImageGallaryHall(id,title,image_link) {
    var title_edited='';
    if(title!='') {
        var title_edited = title.replace(/^"|"$/g, '');
    }
    $("#save_hall_image_gallary_info_form")[0].reset();
    $("#form_output_image_info").html('');
    $("#picture_title").val(title_edited);
    $("#old_picture").val(image_link);
    $("#img_id_new").attr('src', base_url +'/fontView/assets/gallary/hall/'+image_link);
    $("#image_id").val(id);
    $("#saveBtnImage").hide();
    $("#updateBtnImage").show();
    $(".heading-title-gallary").html('প্রোগ্রামের ছবি তথ্য পরিবর্তন ');
    $("#opeation_type").val('update');
}
function deletePhotoGallaryConfirmHall(id) {
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
                    url: base_url + "/delete_hall_gallary_info",
                    data: {id: id},
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            alert(error_html);
                        } else {
                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                window.location.reload();
                            });
                        }
                    }
                });
            }
        });
}

function updateHalLHouseTutorInfo() {
    $.ajax({
        type: "POST",
        url: base_url + "/save_house_tutor",
        data: $('#save_house_tutor_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_award_student').html(error_html);
            } else {
                $('#form_output_award_student').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}

function updateHallSchollarInfo() {
    $.ajax({
        type: "POST",
        url: base_url + "/save_hall_schollarship",
        data: $('#save_hall_schollarship_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_award_student').html(error_html);
            } else {
                $('#form_output_award_student').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}


// deans office

function updateDeansOfficeAwardStudent() {
    $.ajax({
        type: "POST",
        url: base_url + "/save_faculty_award_student_info",
        data: $('#save_faculty_award_student_info_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_award_student').html(error_html);
            } else {
                $('#form_output_award_student').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}

function updateDeansOfficeAwardTeacher() {
    $.ajax({
        type: "POST",
        url: base_url + "/save_faculty_award_teacher_info",
        data: $('#save_faculty_award_teacher_info_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_award_student').html(error_html);
            } else {
                $('#form_output_award_student').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}

function updateDeansOfficeAchievementInfo() {
    $.ajax({
        type: "POST",
        url: base_url + "/save_deans_office_achievement_info",
        data: $('#deans_office_achievement_info_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_achievement_info').html(error_html);
            } else {
                $('#form_output_achievement_info').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}

function addImageGallaryFaculty() {
    $("#save_dean_office_image_gallary_info_form")[0].reset();
    $("#form_output_image_info").html('');
    $("#img_id_new").attr('src', base_url +'/images/default/default-avatar.png');
    $("#saveBtnImage").show();
    $("#updateBtnImage").hide();
    $(".heading-title-gallary").html('কার্যক্রম/প্রোগ্রামের নতুন ছবি ও তথ্য এন্টি ');
    $("#opeation_type").val('add');
}
function deletePhotoGallaryConfirmFaculty(id) {
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
                    url: base_url + "/delete_faculty_gallary_info",
                    data: {id: id},
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            alert(error_html);
                        } else {
                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                window.location.reload();
                            });
                        }
                    }
                });
            }
        });
}

function UpdateImageGallary(id,title,image_link) {
    if(title!='') {
        var title_edited = title.replace(/^"|"$/g, '');
    }
    $("#save_dean_office_image_gallary_info_form")[0].reset();
    $("#form_output_image_info").html('');
    $("#picture_title").val(title_edited);
    $("#old_picture").val(image_link);
    $("#img_id_new").attr('src', base_url +'/fontView/assets/gallary/faculty/'+image_link);
    $("#image_id").val(id);
    $("#saveBtnImage").hide();
    $("#updateBtnImage").show();
    $(".heading-title-gallary").html('কার্যক্রম/প্রোগ্রামের ছবি তথ্য পরিবর্তন ');
    $("#opeation_type").val('update');
}

function all_employee_info_search() {
    $.ajax({
        type: "POST",
        url: base_url + "/search_all_employee_recrod",
        data: $('#search_employee_recrod_form').serialize(),
        success: function (response) {
            if (response.status=='error') {
                var error='<div class="alert alert-danger">' + response.message + '</div>'
                $('#error_data').html(error);
                $('#show_report_info').html('');
            } else {
                $('#error_data').html('');
                $('#show_report_info').html(response);

            }
        }
    });
}

function completeInfo(type,id) {
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
                    url: base_url + "/complete_info_update",
                    data: {id: id,type:type},
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

function searchAcademicCalenderInfo() {
    $.ajax({
        type: "POST",
        url: base_url + "/searchin_academic_calender_info_search",
        data: $('#academic_calender_info_search').serialize(),
        success: function (data) {
            $('#show_academic_info').html(data);
        }
    });
}


function corono_online_app_search() {
    $.ajax({
        type: "POST",
        url: base_url + "/search_corona_application",
        data: $('#search_corona_application_form').serialize(),
        success: function (response) {
            if (response.status=='error') {
                var error='<div class="alert alert-danger">' + response.message + '</div>'
                $('#error_data').html(error);
                $('#show_report_info').html('');
            } else {
                $('#error_data').html('');
                $('#show_report_info').html(response);

            }
        }
    });
}
$("#faculty_id_by_id").change(function () {
    var faculty_id = $(this).val();
    $.ajax({
        type: "POST",
        url: base_url + "/show_faculty_ajax_by_id",
        data: {faculty_id: faculty_id},
        'dataType': 'json',
        success: function (response) {
            $('#department_id').html('<option value="">Select Department</option>');
            if (response.status == 'success') {
                $.each(response.data, function (index, Obj) {
                    $('#department_id').append('<option value="' + index + '">' + Obj + '</option>')
                })
            }
        }
    });

});

$(document).on("keyup.autocomplete","#student_name_search",function(){
    var searcing_corona_app_info=$(this).val();
    var options = {
        minLength: 1,
        source: function (request, response) {
            $.ajax({
                url: base_url + "/searching_corona_application_info",
                method: 'post',
                dataType: "json",
                autoFocus:true,
                data: {
                    term: request.term,
                },
                success: function (data) {
                    console.log(data);
                    response(data);
                }
            });
        },
        select: function (event, ui) {
            if(ui.item.value !='') {
                $('#student_name_search').val(ui.item.value);
                $('#student_id_search').val(ui.item.id);
            }else{
                $('#student_name_search').val('');
                $('#student_id_search').val('');
            }
            return false;
        }
    };
    $('body').on('keyup.autocomplete', "#student_name_search", function() {
        $(this).autocomplete(options);
    });
});

function ApprovedCoronaApplication(id) {
    var return_message="Successfully Approved this Application";
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
                    url: base_url + "/approved_corona_application",
                    data: {id: id,return_message:return_message},
                    'dataType': 'json',
                    success: function (response) {
                        if (response.status == 'success') {
                            swal({
                                text: response.message,
                                icon: "success",
                            }).then(function () {
                               // location.reload();
                                corono_online_app_search();
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
function deniedCoronaApplication(id) {
    var return_message="Successfully Denied this Application";
    swal({
        title: "Are you sure?",
        text: "After Denied, your changes will be saved",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/denied_corona_application",
                    data: {id: id,return_message:return_message},
                    'dataType': 'json',
                    success: function (response) {
                        if (response.status == 'success') {
                            swal({
                                text: response.message,
                                icon: "success",
                            }).then(function () {
                               // location.reload();
                                corono_online_app_search();
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

function showAllDeptProgram(deptId,programName) {
    $("#form_output").html('');
    $("#heading-title").html(programName);
    $.ajax({
        type: "POST",
        url: base_url + "/show_dept_wise_program_info",
        data: {deptId: deptId},
        'dataType': 'json',
        success: function (response) {
            if (response.status == 'success') {
                var data=response.data;
                if(data !== null) {
                    var p_sl=1;
                    $('#dynamicDeptProgram').html('');
                    var scntDynamicDeptProgram = $('#dynamicDeptProgram');
                    $.each(data, function (index, Obj) {
                        $(`<tr>
                            <td>${p_sl} </td>
                            <td>${Obj.program_ctg}</td>
                            <td>${Obj.program_lavel}</td>
                            <td>${Obj.program_type}</td>
                            <td>${Obj.program_name}</td>
                            <td>${Obj.duration_months}</td>
                            <td>${Obj.issuing_authority}</td>
                            <td>${Obj.finance_type}</td>
                        </tr>`).appendTo(scntDynamicDeptProgram);
                       p_sl++;
                     })
                }
            }
        }
    });

}


$(document).ready(function (e) {
     $("#upload_email_info_form").on('submit',(function(e) {
        //$("#loader").show();
        e.preventDefault();
        var formData = new FormData(this)
        $.ajax({
            url: base_url + "/upload_email_info_info", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data)   // A function to be called if request succeeds
            {
                if (data!='') {
                   // $("#loader").hide();
                    $("#upload_file").val('');
                    $('#show_all_info').html(data);
                } else {


                }
            }
        });
    }));
});

$(document).on("click", ".deleteProgramUpdate", function (e) {
    var program_id = elementId($(this).attr('id'));
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
                    url: base_url + "/examDeleteProgramInfo",
                    data: {program_id:program_id},
                    'dataType': 'json',
                    success: function (response) {
						console.log(response);
						if (response.status=='error') {
							if (response.error.length > 0) {
								var error_html = '';
								for (var count = 0; count < response.error.length; count++) {
									error_html += '<div class="alert alert-danger">' + response.error[count] + '</div>';
								}
								swal(response, {
									icon: "warning",
								});
							}else{
								swal(response.error[0], {
									icon: "warning",
								});
							}
						} else {
							swal({
                                text: response.success,
                                icon: "success",
                            }).then(function () {
                                location.reload();
                            });

						}
						
                    
                    }
                });
            }
        });
    
});

function deptEmailFormatUpdate() {
	swal({
        title: "Are you sure?",
        text: "After confirmation, your changes will be saved, you can't reset it.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
					type: "POST",
					url: base_url + "/save_dept_email_format",
					data: $('#dept_email_format_form').serialize(),
					'dataType': 'json',
					success: function (data) {
						if (data.error.length > 0) {
							var error_html = '';
							for (var count = 0; count < data.error.length; count++) {
								error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
							}
							$('#form_output_info').html(error_html);
						} else {
							$('#form_output_info').html('');

							swal({
								text: data.success,
								icon: "success",
							}).then(function () {
								location.reload();
							});
						}
					}
				});
            }
        });
		
    
}


// research Center

function addImageGallaryRSCenter() {
    $("#rs_center_image_gallary_info_form")[0].reset();
    $("#form_output_image_info").html('');
    $("#img_id_all").attr('src', base_url +'/images/default/default-avatar.png');
    $("#saveBtnImage").show();
    $("#updateBtnImage").hide();
    $(".heading-title-gallary").html('Add Slider Image ');
    $("#opeation_type").val('add');
}



function updateProgramActivity() {
	var program_activity = CKEDITOR.instances['program_activity'].getData();
	program_activity = program_activity.replace(/[&]nbsp[;]/gi," ");
	var program_activity_bn = CKEDITOR.instances['program_activity_bn'].getData();
	program_activity_bn = program_activity_bn.replace(/[&]nbsp[;]/gi," ");

	$("#updateProgramActivityBtn").attr('disabled',true);
    $.ajax({
        type: "POST",
        url: base_url + "/save_program_activity_info",
        data: $('#save_research_center_info_program_activity_form').serialize()+'&'+$.param({ 'program_activity': program_activity,'program_activity_bn':program_activity_bn }),
        'dataType': 'json',
        success: function (data) {
			$("#updateProgramActivityBtn").attr('disabled',false);
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_program_activity').html(error_html);
            } else {
                $('#form_output_program_activity').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}

function updateRearchCenterContactInfo() {
	var contact_info = CKEDITOR.instances['contact_info'].getData();
	contact_info = contact_info.replace(/[&]nbsp[;]/gi," ");
	var contact_info_bn = CKEDITOR.instances['contact_info_bn'].getData();
	contact_info_bn = contact_info_bn.replace(/[&]nbsp[;]/gi," ");
	$("#updateRearchCenterContactBtn").attr('disabled',false);
	
    $.ajax({
        type: "POST",
        url: base_url + "/save_program_contact_info",
        data: $('#save_research_center_info_contact_form').serialize()+'&'+$.param({ 'contact_info_bn': contact_info_bn,'contact_info':contact_info }),
        'dataType': 'json',
        success: function (data) {
			$("#updateRearchCenterContactBtn").attr('disabled',false);
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_program_activity').html(error_html);
            } else {
                $('#form_output_program_activity').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}

function updateRearchCenterPurposeInfo() {
	var purpose = CKEDITOR.instances['purpose'].getData();
	purpose = purpose.replace(/[&]nbsp[;]/gi," ");
	var purpose_bn = CKEDITOR.instances['purpose_bn'].getData();
	purpose_bn = purpose_bn.replace(/[&]nbsp[;]/gi," ");
	$("#updateRearchCenterPurposeBtn").attr('disabled',true);
    $.ajax({
        type: "POST",
        url: base_url + "/save_program_purpose_info",
        data: $('#save_program_research_center_info_purpose_form').serialize()+'&'+$.param({ 'purpose': purpose,'purpose_bn':purpose_bn }),
        'dataType': 'json',
        success: function (data) {
			$("#updateRearchCenterPurposeBtn").attr('disabled',false);
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_program_activity').html(error_html);
            } else {
                $('#form_output_program_activity').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}




function UpdateImageGallaryRcenter(id,title,image_link,displayPosition,isActive) {
   if(title!='') {
       var title_edited = title.replace(/^"|"$/g, '');
   }
    $("#rs_center_image_gallary_info_form")[0].reset();
    $("#form_output_image_info").html('');
    $("#picture_title").val(title_edited);
    $("#old_picture").val(image_link);
	
    $("#display_position").val(displayPosition);
    $("#is_active").val(isActive);
	
    $("#img_id_all").attr('src', base_url +'/fontView/assets/rsearch_center_image/slider/'+image_link);
    $("#image_id").val(id);
    $("#saveBtnImage").hide();
    $("#updateBtnImage").show();
    $(".heading-title-gallary").html('Update Slider Image');
    $("#opeation_type").val('update');
}
function deleteRCenterSliderConfirm(id) {
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
                    url: base_url + "/delete_rcenter_slider_info",
                    data: {id: id},
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                           alert(error_html);
                        } else {
                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                window.location.reload();
                            });
                        }
                    }
                });
            }
        });
}

function updateRearchCenterInfoProfile() {
	
	var rc_profile = CKEDITOR.instances['rc_profile'].getData();
	rc_profile = rc_profile.replace(/[&]nbsp[;]/gi," ");
	
	var rc_profile_bn = CKEDITOR.instances['rc_profile_bn'].getData();
	rc_profile_bn = rc_profile_bn.replace(/[&]nbsp[;]/gi," ");
	$("#updateRearchCenterInfoProfileBtn").attr('disabled',true);
	
    $.ajax({
        type: "POST",
        url: base_url + "/save_program_research_center_info_profile",
        data: $('#save_program_research_center_info_profile_form').serialize()+'&'+$.param({ 'rc_profile': rc_profile,'rc_profile_bn':rc_profile_bn }),
        'dataType': 'json',
        success: function (data) {
			$("#updateRearchCenterInfoProfileBtn").attr('disabled',false);
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_profile').html(error_html);
            } else {
                $('#form_output_profile').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}
function updateRearchCenterVissionInfo() {
	
	var vission = CKEDITOR.instances['vission'].getData();
	vission = vission.replace(/[&]nbsp[;]/gi," ");
	var vission_bn = CKEDITOR.instances['vission_bn'].getData();
	vission_bn = vission_bn.replace(/[&]nbsp[;]/gi," ");
	$("#updateRearchCenterVissionInfoBtn").attr('disabled',true);
	
	
	
    $.ajax({
        type: "POST",
        url: base_url + "/save_research_center_vission_info",
        data: $('#save_research_center_vission_info_form').serialize()+'&'+$.param({ 'vission': vission,'vission_bn':vission_bn }),
        'dataType': 'json',
        success: function (data) {
			$("#updateRearchCenterVissionInfoBtn").attr('disabled',false);
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_vission').html(error_html);
            } else {
                $('#form_output_vission').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}
function updateRearchCenterMissionInfo() {
	var mission = CKEDITOR.instances['mission'].getData();
	mission = mission.replace(/[&]nbsp[;]/gi," ");
	var mission_bn = CKEDITOR.instances['mission_bn'].getData();
	mission_bn = mission_bn.replace(/[&]nbsp[;]/gi," ");

	$("#updateRearchCenterMissionInfoBtn").attr('disabled',true);
    $.ajax({
        type: "POST",
        url: base_url + "/save_research_center_mission_info",
        data: $('#save_program_research_center_info_mission_form').serialize()+'&'+$.param({ 'mission': mission,'mission_bn':mission_bn }),
        'dataType': 'json',
        success: function (data) {
			$("#updateRearchCenterMissionInfoBtn").attr('disabled',true);
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#form_output_vission').html(error_html);
            } else {
                $('#form_output_vission').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}
function updateTimeHigherEducation() {
    $.ajax({
        type: "POST",
        url: base_url + "/timeHigherEducationAction",
        data: $('#timeHigherEducationForm').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#output_info').html(error_html);
            } else {
                $('#output_info').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });

}
function createEmailRequest() {
    $.ajax({
        type: "POST",
        url: base_url + "/employee_email_request_action",
        data: $('#emailRequestForm').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#output_info').html(error_html);
            } else {
                $('#output_info').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });

}
function EditEmployeeEmailRequest(id,status='') {
    $.ajax({
        type: "POST",
        url: base_url + "/get_employee_emails_request_info",
        data: {id: id},
        'dataType': 'json',
        success: function (response) {
            if (response.status=='success') {
                var data=response.data;
                $("#first_name").val(data.first_name);
                $("#last_name").val(data.last_name);
                $("#faculty_name").val(data.faculty_name);
                $("#department").val(data.department_name);
                $("#designation").val(data.designation_title);

                $("#domainName").html('@'+data.email_domain);
                $("#personal_email").val(data.personal_email);
                $("#mobile").val(data.mobile);
                $("#home_address").val(data.home_address);
                $("#update_id").val(data.id);
				$("#empID").val(data.empID);
				$("#expected_email").val('');
                if(data.suggested_email!=''){
                   var  suggested_email_exp= data.suggested_email.split("@");
                   if(suggested_email_exp[0] !=''){
                       $("#expected_email").val(suggested_email_exp[0]);
                   }
                }
                if(status!=''){
                    $("#statusUpdate").val(status);
                }
            }
        }
    });

}

function searchEmailRequestInfo() {
    $.ajax({
        type: "POST",
        url: base_url + "/search_employee_email_request_search",
        data: $('#employee_email_request_search').serialize(),
        success: function (data) {
            $('#show_leave_info').html(data);
        }
    });
}

function showEmployeeEmailRequest(id,status='') {
    $.ajax({
        type: "POST",
        url: base_url + "/get_employee_emails_request_info",
        data: {id: id},
        'dataType': 'json',
        success: function (response) {
            if (response.status=='success') {
                var data=response.data;
				console.log(data);
                $("#employeeEmpID").html(data.employeeEmpID);
                $("#first_name").html(data.first_name);
                $("#last_name").html(data.last_name);
                $("#faculty_name").html(data.faculty_name);
                $("#department").html(data.department_name);
                $("#designation").html(data.designation_title);

                $("#domainName").html('@'+data.email_domain);
                $("#personal_email").html(data.personal_email);
                $("#mobile").html(data.mobile);
                $("#home_address").html(data.home_address);
                $("#update_id").val(data.id);
                $("#expected_email").html(data.suggested_email);
                if(status!=''){
                    $("#statusUpdate").val(status);
                }
            }
        }
    });
}

function createEmailRequestAdmin() {
    $.ajax({
        type: "POST",
        url: base_url + "/employee_email_request_action_admin",
        data: $('#emailRequestForm').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#output_info').html(error_html);
            } else {
                $('#output_info').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });

}

// Department Contact  Information..
function updateContactInfo() {
    $.ajax({
        type: "POST",
        url: base_url + "/updateContactInfoAction",
        data: $('#save_contact_info_form').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#info_output').html(error_html);
            } else {
                $('#info_output').html('');
                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}


// Vaccine Request
function createVaccineRequest() {
    $.ajax({
        type: "POST",
        url: base_url + "/employee_vaccine_request_action",
        data: $('#vaccineRequestForm').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#output_info').html(error_html);
            } else {
                $('#output_info').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}


function EditEVaccineRequest(id) {
    $("#vaccineRequestForm")[0].reset();
    $.ajax({
        type: "POST",
        url: base_url + "/get_employee_vaccine_request_info",
        data: {id: id},
        'dataType': 'json',
        success: function (response) {
            if (response.status=='success') {
                var data=response.data;
                $("#emp_name").val(data.emp_name);
                $("#faculty_name").val(data.faculty_name);
                $("#department").val(data.department_name);
                $("#designation").val(data.designation_title);
                $("#emp_id").val(data.payslip_emp_id);
                $("#date_of_birth").val(data.birth_date_title);
                $("#gender").val(data.gender);
                $("#office_email").val(data.office_email);
                $("#mobile").val(data.mobile);
                if(data.nid_type==1) {
                    $("#nid_type_male").attr('checked', true);
                    $("#nid_type_female").attr('checked', false);
                }else{
                    $("#nid_type_male").attr('checked', false);
                    $("#nid_type_female").attr('checked', true);
                }

                $("#nid_no").val(data.nid_no);
                $("#confirm_nid_no").val(data.nid_no);
                $("#present_address").val(data.present_address);
                $("#update_id").val(data.id);

            }
        }
    });
}

$(document).on("click", ".nidType", function (e) {
    var nidType = $(this).val();
    $("#nidValidation").css({"color": "red", "font-weight": "bold"});
    if(nidType==1){
        $("#nidValidation").html('National ID Card Number Must be 13 to 17 Digit');
    }else{
        $("#nidValidation").html('National ID Card Number Must be 10 Digit');
    }
});


function showEmployeeVaccineRequest(id,status='') {
    $("#RequestForm")[0].reset();
    $.ajax({
        type: "POST",
        url: base_url + "/get_employee_vaccine_request_info",
        data: {id: id},
        'dataType': 'json',
        success: function (response) {
            if (response.status=='success') {
                var data=response.data;
                console.log(data);
                $("#first_name").html(data.emp_name);
                $("#last_name").html(data.last_name);
                $("#faculty_name").html(data.faculty_name);
                $("#department").html(data.department_name);
                $("#designation").html(data.designation_title);
                $("#email").html(data.email);
                $("#mobile").html(data.mobile);
                $("#home_address").html(data.present_address);
                if(data.nid_type==1){
                    var nIDType='Old NID';
                }else{
                    var nIDType='Digital NID';
                }
                $("#nationalIdType").html(nIDType);
                $("#nationalId").html(data.nid_no);

                $("#update_id").val(data.id);
                if(status!=''){
                    $("#statusUpdate").val(status);
                }
            }
        }
    });
}

function createCovidRequestAdmin() {
    $.ajax({
        type: "POST",
        url: base_url + "/employee_vaccine_request_action_admin",
        data: $('#RequestForm').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#output_info').html(error_html);
            } else {
                $('#output_info').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}

function searchCovidRequestInfo() {
    $.ajax({
        type: "POST",
        url: base_url + "/search_vaccine_request_action",
        data: $('#request_search').serialize(),
        success: function (data) {
            $('#show_info').html(data);
        }
    });
}

// Email Request 9 Feb 2021

function updateEmployeeEmailRequestInfo(id,status) {
    swal({
        title: "Are you sure?",
        text: "If you submitted your request, you can not update your request",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/employee_email_request_action_admin",
                    data: {update_id: id,statusUpdate:status},
                    'dataType': 'json',
                    success: function (data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                            }
                            $('#output_info').html(error_html);
                        } else {
                            $('#output_info').html('');

                            swal({
                                text: data.success,
                                icon: "success",
                            }).then(function () {
                                location.reload();
                            });
                        }

                    }
                });
            }
        });
}


// update 10 Feb 2021

function updateVaccineStatus() {
    $.ajax({
        type: "POST",
        url: base_url + "/employee_vaccine_request_action_admin_merge",
        data: $('#request_info_merge').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#output_info').html(error_html);
            } else {
                $('#output_info').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}


function createVaccineRequestStd() {
    $.ajax({
        type: "POST",
        url: base_url + "/std_vaccine_request_action",
        data: $('#vaccineRequestForm').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#output_info').html(error_html);
            } else {
                $('#output_info').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}



function EditVaccineStdRequest(id) {
    $("#vaccineRequestForm")[0].reset();
    $("#output_info").html('');
    $.ajax({
        type: "POST",
        url: base_url + "/get_employee_vaccine_std_request_info",
        data: {id: id},
        'dataType': 'json',
        success: function (response) {
            if (response.status=='success') {
                var data=response.data;

                $("#emp_name").val(data.emp_name);
                $("#hallName").val(data.hall_name_title);
                $("#program").val(data.program_title);
                $("#department").val(data.department_name);
                $("#designation").val(data.designation_title);
                $("#emp_id").val(data.std_reg_no);
                $("#student_id").val(data.student_id);
                $("#date_of_birth").val(data.birth_date_title);
                $("#gender").val(data.gender);
                $("#office_email").val(data.office_email);
                $("#mobile").val(data.mobile);
                $("#confirm_mobile").val(data.mobile);
                $("#hall_resident_type").val(data.hall_resident_type);
                if(data.haveNID==1) {
					$("#haveNID_nid").attr('checked', true);
					$("#haveNID_birth").attr('checked', false);
					
					$(".showHaveNID").show();
					$(".showBirthCertificate").hide();
					if(data.nid_type==1) {
						$("#nidType_old").attr('checked', true);
						$("#nidType_new").attr('checked', false);
					}else{
						$("#nidType_old").attr('checked', false);
						$("#nidType_new").attr('checked', true);
					}
				}else{
					$("#haveNID_nid").attr('checked', false);
					$("#haveNID_birth").attr('checked', true);
					
					$(".showHaveNID").hide();
					$(".showBirthCertificate").show();
					
					$("#birth_certificate_no").val(data.birth_certificate_no);
					$("#confirm_birth_certificate_no").val(data.birth_certificate_no);
				}
				
				if(data.hall_resident_type==2){
					$(".show_room_no").hide();
				}else{
					$(".show_room_no").show();
					$("#room_no").val(data.room_no);
				}
				
                $("#nid_no").val(data.nid_no);
                $("#confirm_nid_no").val(data.nid_no);



                $("#hall_id").val(data.hall_id);
                $("#current_year").val(data.current_year);
                $("#current_semester").val(data.current_semester);
                $("#class_roll_no").val(data.class_roll_no);
                if(data.present_upazilas!='') {
                    $.each(data.present_upazilas, function (index, Obj) {
                        $('#present_police_station').append('<option value="' + index + '">' + Obj + '</option>')
                    })
                }
                $('#present_district').select2().select2('val',data.present_district);
                $("#present_police_station").val(data.present_police_station);
                $("#update_id").val(data.id);

            }
        }
    });
}

function searchCovidRequestInfoStd() {
    $.ajax({
        type: "POST",
        url: base_url + "/std_search_vaccine_request_action_admin",
        data: $('#request_search').serialize(),
        success: function (data) {
            $('#show_info').html(data);
        }
    });
}

function showStdVaccineRequest(id,status='') {
    $("#RequestForm")[0].reset();
    $.ajax({
        type: "POST",
        url: base_url + "/get_employee_vaccine_std_request_info",
        data: {id: id},
        'dataType': 'json',
        success: function (response) {
            if (response.status=='success') {
                var data=response.data;
                $("#first_name").html(data.emp_name);
                $("#hall_name").html(data.hall_name_title);
                $("#department").html(data.department_name);
                $("#programName").html(data.program_title);
                $("#email").html(data.email);
                $("#mobile").html(data.mobile);
                $("#home_address").html(data.present_address);
                if(data.haveNID==1){
					$(".showHaveNID").show();
					$(".showBirthCertificate").hide();
					$("#HaveNIDStatus").html('Yes');
					
					if(data.nid_type==1){
						var nIDType='Old NID';
					}else{
						var nIDType='Digital NID';
					}
					$("#nationalIdType").html(nIDType);
					$("#nationalId").html(data.nid_no);
				}else{
					$("#HaveNIDStatus").html('No');
					$(".showHaveNID").hide();
					$(".showBirthCertificate").show();
					$("#birth_certificate_no").html(data.birth_certificate_no);
				}
				if(data.hall_resident_type==1){
					$("#howHallInfo").html('আবাসিক'+' Room No '+data.room_no);
				}else if(data.hall_resident_type==2){
					$("#howHallInfo").html('অনাবাসিক');
				}else if(data.hall_resident_type==3){
					$("#howHallInfo").html('দ্বৈতাবাসিক'+' Room No '+data.room_no);
				}

                $("#update_id").val(data.id);
                if(status!=''){
                    $("#statusUpdate").val(status);
                }
            }
        }
    });
}

function ApprovedCoronaStdApplication(id,status,return_message) {
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
                    url: base_url + "/approved_corona_registration_application",
                    data: {id: id,return_message:return_message,application_step:status},
                    'dataType': 'json',
                    success: function (response) {
                        if (response.status == 'success') {
                            swal({
                                text: response.message,
                                icon: "success",
                            }).then(function () {
                                location.reload();
                                //corono_online_app_search();
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

function corono_reg_app_search() {
    $.ajax({
        type: "POST",
        url: base_url + "/search_reg_corona_application",
        data: $('#search_corona_application_form').serialize(),
        success: function (response) {
            if (response.status=='error') {
                var error='<div class="alert alert-danger">' + response.message + '</div>'
                $('#error_data').html(error);
                $('#show_report_info').html('');
            } else {
                $('#error_data').html('');
                $('#show_report_info').html(response);

            }
        }
    });
}

$(document).ready(function() {
    var studentCoronavirusWithNiD= $('#studentCoronavirusWithNiD').DataTable({
        "serverSide": true,
        "ajax": {
            url: base_url+"/covidvaccine_without_email_with_nid_report_action",
            method: "get",
            data: function (d) {
                d.faculty_id_by_id = $('#faculty_id_by_id').val(),
                    d.department_id = $('#department_id').val(),
                    d.search_hall_id = $('#search_hall_id').val(),
                    d.is_active = $('#is_active').val(),
                    d.haveNID = $('#haveNID').val(),
                    d.gender = $('#gender').val(),
                    d.isDuStd = $('#isDuStd').val(),
                    d.haveRemarks = $('#haveRemarks').val(),
                    d.solvedStatus = $('#solvedStatus').val()
            }
        },
        language: {
            processing: "<img src='fontView/assets/img/ajax-loader.gif' />"
        },
        processing: true,
        columns: [
            {data: 'name', name: 'name'},
            {data: 'registration_no', name: 'registration_no'},
            {data: 'is_du_std', name: 'is_du_std'},
            {data: 'remarks', name: 'remarks'},
            {data: 'NidBirthType', name: 'NidBirthType'},
            {data: 'NidBirthNo', name: 'NidBirthNo'},
            {data: 'mobile', name: 'mobile'},
            {data: 'upazilaName', name: 'upazilaName'},

            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        "columnDefs" : [{
            'targets': [4],
            'orderable': false
        }],
    });
    $('#department_id,#is_active,#search_hall_id,#haveNID,#gender,#isDuStd,#haveRemarks,#solvedStatus').change(function(){
        studentCoronavirusWithNiD.draw();
    });
});

$("#uploadVerifiedStdForm").on('submit',(function(e) {
    $("#loader").show();
    var formData = new FormData(this);
    e.preventDefault();
    $.ajax({
        url: base_url + "/verifiedStdByDeptAction",
        type: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData:false,
        // 'dataType': 'json',
        success: function(data)
        {
            $("#loader").hide();
            if (data!='') {
                $("#uploadVerifiedStdForm")[0].reset();
                $('#form_output').html('');
                $('.show_data').html(data);
            }
        }
    });
}));


function approvedStdVaccineRequest(id,status='') {
    $("#approvedRequestForm")[0].reset();
    $("#showhaveNiD").hide();
    $("#haveBirthCertificate").hide();
    $("#loader").show();
    $(".response_show").hide();
    $('#updateBtn').attr('disabled',false);
    $('#output_info').html('');

    $.ajax({
        type: "POST",
        url: base_url + "/get_single_approved_application_without_login",
        data: {id: id},
        'dataType': 'json',
        success: function (response) {
            if (response.status=='success') {
                $("#loader").hide();
                $(".response_show").show();

                var data=response.data;
                $("#registraionNo").val(data.registration_no);
                $("#classRoll").val(data.class_roll_no);

                $("#firstName").val(data.std_name);
                $("#lastName").val(data.std_last_name);
                $("#emailAddress").val(data.personal_email);
                $("#mobileNo").val(data.mobile);
                $("#programLevel").val(data.program_level);
                $("#programName").val(data.program_id);

                $("#departName").val(data.department_title);
                $("#hallName").val(data.hall_id);
                // $("#academicSession").val(data.registration_session);
                $("#current_year").val(data.current_year);
                $("#semester").val(data.current_semester);
                $("#haveNiD").val(data.haveNID);
                if(data.haveNID==1) {
                    $("#haveNiD").show();
                    $("#haveBirthCertificate").hide();
                    $("#nationalID").val(data.nid_no);
                }else {
                    $("#haveNiD").hide();
                    $("#haveBirthCertificate").show();
                    $("#birthCertificateNo").val(data.birth_certificate_no);
                }
                $("#solveStatus").val(data.solvedStatus);
                $("#remarks").val(data.remarks);
                $("#update_id").val(data.id);

            }
        }
    });
}

function updateCovidRequestWithoutLoginAdmin() {
    $('#updateBtn').attr('disabled',true);
    $.ajax({
        type: "POST",
        url: base_url + "/updateCovidRequestWithoutLoginAdmin",
        data: $('#approvedRequestForm').serialize(),
        'dataType': 'json',
        success: function (data) {
            $('#updateBtn').attr('disabled',false);
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('#output_info').html(error_html);
            } else {
                $('#output_info').html('');
                $("#approvedRequestForm")[0].reset();
                $('#myModal').modal('toggle');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    $('#studentCoronavirusWithNiD').DataTable().ajax.reload();
                });
            }
        }
    });
}