// intital setup form templeate js---start
function print_fun(){
    window.print();
}

$(document).ready(function() {
    $('.timepicker').datetimepicker({
        format: 'hh:mm a'
    });
    // DO NOT REMOVE : GLOBAL FUNCTIONS!
    pageSetUp();
    $(".js-status-update a").click(function() {
        var selText = $(this).text();
        var $this = $(this);
        $this.parents('.btn-group').find('.dropdown-toggle').html(selText + ' <span class="caret"></span>');
        $this.parents('.dropdown-menu').find('li').removeClass('active');
        $this.parent().addClass('active');
    });

    /*
    * TODO: add a way to add more todo's to list
    */

    // initialize sortable
    $(function() {
        $("#sortable1, #sortable2").sortable({
            handle : '.handle',
            connectWith : ".todo",
            update : countTasks
        }).disableSelection();
    });

    // check and uncheck
    $('.todo .checkbox > input[type="checkbox"]').click(function() {
        var $this = $(this).parent().parent().parent();

        if ($(this).prop('checked')) {
            $this.addClass("complete");

            // remove this if you want to undo a check list once checked
            //$(this).attr("disabled", true);
            $(this).parent().hide();

            // once clicked - add class, copy to memory then remove and add to sortable3
            $this.slideUp(500, function() {
                $this.clone().prependTo("#sortable3").effect("highlight", {}, 800);
                $this.remove();
                countTasks();
            });
        } else {
            // insert undo code here...
        }

    })
    // count tasks
    function countTasks() {

        $('.todo-group-title').each(function() {
            var $this = $(this);
            $this.find(".num-of-tasks").text($this.next().find("li").size());
        });

    }

    var data = [], totalPoints = 200, $UpdatingChartColors = $("#updating-chart").css('color');
    function getRandomData() {
        if (data.length > 0)
            data = data.slice(1);

        // do a random walk
        while (data.length < totalPoints) {
            var prev = data.length > 0 ? data[data.length - 1] : 50;
            var y = prev + Math.random() * 10 - 5;
            if (y < 0)
                y = 0;
            if (y > 100)
                y = 100;
            data.push(y);
        }

        // zip the generated y values with the x values
        var res = [];
        for (var i = 0; i < data.length; ++i)
            res.push([i, data[i]])
        return res;
    }

    // setup control widget
    var updateInterval = 1500;
    $("#updating-chart").val(updateInterval).change(function() {

        var v = $(this).val();
        if (v && !isNaN(+v)) {
            updateInterval = +v;
            $(this).val("" + updateInterval);
        }

    });

    // setup plot
    var options = {
        yaxis : {
            min : 0,
            max : 100
        },
        xaxis : {
            min : 0,
            max : 100
        },
        colors : [$UpdatingChartColors],
        series : {
            lines : {
                lineWidth : 1,
                fill : true,
                fillColor : {
                    colors : [{
                        opacity : 0.4
                    }, {
                        opacity : 0
                    }]
                },
                steps : false

            }
        }
    };

    // var plot = $.plot($("#updating-chart"), [getRandomData()], options);

    /* live switch */
    $('input[type="checkbox"]#start_interval').click(function() {
        if ($(this).prop('checked')) {
            $on = true;
            updateInterval = 1500;
            update();
        } else {
            clearInterval(updateInterval);
            $on = false;
        }
    });

    function update() {
        if ($on == true) {
            plot.setData([getRandomData()]);
            plot.draw();
            setTimeout(update, updateInterval);

        } else {
            clearInterval(updateInterval)
        }

    }

    var $on = false;

    /* hide default buttons */
    $('.fc-header-right, .fc-header-center').hide();

    // calendar prev
    $('#calendar-buttons #btn-prev').click(function() {
        $('.fc-button-prev').click();
        return false;
    });

    // calendar next
    $('#calendar-buttons #btn-next').click(function() {
        $('.fc-button-next').click();
        return false;
    });

    // calendar today
    $('#calendar-buttons #btn-today').click(function() {
        $('.fc-button-today').click();
        return false;
    });

    // calendar month
    $('#mt').click(function() {
        $('#calendar').fullCalendar('changeView', 'month');
    });

    // calendar agenda week
    $('#ag').click(function() {
        $('#calendar').fullCalendar('changeView', 'agendaWeek');
    });

    // calendar agenda day
    $('#td').click(function() {
        $('#calendar').fullCalendar('changeView', 'agendaDay');
    });

    /*
     * CHAT
     */

    $.filter_input = $('#filter-chat-list');
    $.chat_users_container = $('#chat-container > .chat-list-body')
    $.chat_users = $('#chat-users')
    $.chat_list_btn = $('#chat-container > .chat-list-open-close');
    $.chat_body = $('#chat-body');

    /*
    * LIST FILTER (CHAT)
    */

    // custom css expression for a case-insensitive contains()
    jQuery.expr[':'].Contains = function(a, i, m) {
        return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
    };

    function listFilter(list) {// header is any element, list is an unordered list
        // create and add the filter form to the header

        $.filter_input.change(function() {
            var filter = $(this).val();
            if (filter) {
                // this finds all links in a list that contain the input,
                // and hide the ones not containing the input while showing the ones that do
                $.chat_users.find("a:not(:Contains(" + filter + "))").parent().slideUp();
                $.chat_users.find("a:Contains(" + filter + ")").parent().slideDown();
            } else {
                $.chat_users.find("li").slideDown();
            }
            return false;
        }).keyup(function() {
            // fire the above change event after every letter
            $(this).change();

        });

    }
    $('#dt_basic').DataTable();
    $("#alert_hide_after").delay(5000).slideUp(300);

    // all checked with one click
    $('#checked_all').change(function() {
        var checkboxes = $(this).closest('form').find(':checkbox');
        checkboxes.prop('checked', $(this).is(':checked'));
    });

});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



// intital setup form templeate js---end


function AddSetupInfo() {
    $("#type_setup_form")[0].reset();
    $("#title").val('');
    $("#setting_id").val('');
    $("#is_active").val(1);
    $("#saveBtn").show();
    $("#updateBtn").hide();
    $("#heading-title").html('Add ');
    $("#form_output").html('');
}
function UpdateSetupInfo(id,title,is_active) {
    $("#type_setup_form")[0].reset();
    $("#title").val(title);
    $("#setting_id").val(id);
    $("#is_active").val(is_active);
    $("#saveBtn").hide();
    $("#updateBtn").show();
    $("#heading-title").html('Update ');
    $("#form_output").html('');

}
function UpdateSubCtgSetupInfo(id,title,is_active,parent_id) {
    $("#type_setup_form")[0].reset();
    $("#title").val(title);
    $("#setting_id").val(id);
    $("#product_ctg").val(parent_id);
    $("#is_active").val(is_active);
    $("#saveBtn").hide();
    $("#updateBtn").show();
    $("#heading-title").html('Update ');
    $("#form_output").html('');

}
function default_setup() {
    swal({
        text: "You can't update, Because it's default setup",
        icon: "warning",
    });
}
function saveSetupInfo() {
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
                url: base_url + "/save_setup_type",
                data: $('#type_setup_form').serialize(),
                'dataType': 'json',
                success: function (data) {
                    if (data.error.length > 0) {
                        var error_html = '';
                        for (var count = 0; count < data.error.length; count++) {
                            error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                        }
                        $('#form_output').html(error_html);
                    } else {
                        $('#type_setup_form')[0].reset();
                        $('#exampleModal').modal('toggle');
                        $('#form_output').html('');

                        swal({
                            text: data.success,
                            icon: "success",
                        }).then(function () {
                            window.location =  base_url +'/'+ data.redirect_page;
                        });
                    }
                }
            });
        }
    });
}
function deleteSetupConfirm(id,redirect_page) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, You will not be able to recover this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "POST",
                url: base_url + "/setup_type_delete",
                data: {id: id,redirect_page:redirect_page},
                'dataType': 'json',
                success: function (response) {
                    if (response.status == 'success') {
                        swal({
                            text: response.message,
                            icon: "success",
                        }).then(function() {
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

// Exam controller automation setup

$(".programCtg").change(function () {
    var programCtg = $(this).val();
    $.ajax({
        type: "POST",
        url: base_url + "/show_program_level",
        data: {programCtg: programCtg},
        'dataType': 'json',
        success: function (response) {
            $('#program_level_1').html('<option value="">Select Program Level</option>');
            if (response.status == 'success') {
                $.each(response.data, function (index, Obj) {
                    $('#program_level_1').append('<option value="' + index + '">' + Obj + '</option>')
                })
            }
        }
    });

});

$(document).on("change", ".programCtg", function (e) {
    var element_id = elementId($(this).attr('id'));
    var programCtg = $(this).val();
    $.ajax({
        type: "POST",
        url: base_url + "/show_program_level",
        data: {programCtg: programCtg},
        'dataType': 'json',
        success: function (response) {
            $('#program_level_'+element_id).html('<option value="">Select Program Level</option>');
            if (response.status == 'success') {
                $.each(response.data, function (index, Obj) {
                    $('#program_level_'+element_id).append('<option value="' + index + '">' + Obj + '</option>')
                })
            }
        }
    });

});

$(document).ready(function (e) {
    $("#exam_save_dept_program_info_data_form").on('submit',(function(e) {
        $("#loader").show();
        e.preventDefault();
        var formData = new FormData(this)
        $.ajax({
            url: base_url + "/exam_save_dept_program_info", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data)   // A function to be called if request succeeds
            {
                if (data!='') {
                    $("#loader").hide();
                    $('#show_all_info').html(data);
                } else {


                }
            }
        });
    }));
	
	$("#dept_program_form").on('submit',(function(e) {
		
        $("#loader").show();
        e.preventDefault();
        var formData = new FormData(this)
		var program_description = CKEDITOR.instances['program_description'].getData();
			program_description = program_description.replace(/[&]nbsp[;]/gi," ");
			formData.append('program_description', program_description);
        $.ajax({
            url: base_url + "/exam_save_dept_program_info", // Url to which the request is send
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
                $('#form_output_program_info').html(error_html);
            } else {
                $('#form_output_program_info').html('');

                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });
            }
				/*
                if (data!='') {
                    $("#loader").hide();
                    $('#form_output_program_info').html(data);
                } else {


                }
				*/
				
            }
        });
    }));
	
	
	
	
	
	

});

function addProgramInfo(){
	$("#dept_program_form")[0].reset();
    $("#program_id").val('');
    $("#btnName").html('Save');
    $("#heading-title").html('Add ');
    $("#form_output_program_info").html('');
	CKEDITOR.instances.program_description.setData( '' );
}
function updateProgramInfo(id){

	$("#dept_program_form")[0].reset();
    $("#program_id").val('');
    $("#btnName").html('Update');
    $("#heading-title").html('Add ');
    $("#form_output_program_info").html('');
	$.ajax({
        type: "POST",
        url: base_url + "/get_program_info",
        data: {id:id},
        'dataType': 'json',
        success: function (response) {
		
            if (response.status=='success') {
               	console.log(response.data);
				var data=response.data;
				var programLebel=data.programLevelInfo;
				//console.log(programLevelInfo);
				if(programLebel!=''){
					$.each(programLebel, function (index, Obj) {
						$('#program_level_1').append('<option value="' + index + '">' + Obj + '</option>')
					})
				}
				$('#program_ctg_1').val(data.program_ctg);
				$('#program_level_1').val(data.program_level);
				$('#program_type_1').val(data.program_type);
				$('#program_duration_months_1').val(data.duration_months);
				$('#program_name_1').val(data.program_name);
				
				$('#old_image').val(data.feature_image);
				CKEDITOR.instances.program_description.setData( data.program_description );
				
				$('#authority_1').val(data.issuing_authority);
				$('#finance_type_1').val(data.finance_type);
				$('#program_id').val(data.id);
				if(data.feature_image==null){
					var image_url= base_url+'/images/default/default-avatar.png';
				}else {
					var image_url = base_url +'/'+data.feature_image;
				}
				$("#img_id").attr("src", image_url);
            } else {
             
            }
        }
    });
}

function examUpdateDeptProgramData() {
    $.ajax({
        type: "POST",
        url: base_url + "/exam_save_dept_program_info",
        data: $('#exam_save_dept_program_info_data_form').serialize(),
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
    $("#exam_save_dept_program_student_data_form").on('submit',(function(e) {
        $("#loader").show();
        e.preventDefault();
        var formData = new FormData(this)
        $.ajax({
            url: base_url + "/exam_save_dept_program_student_data", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data)   // A function to be called if request succeeds
            {
                if (data!='') {
                    $("#loader").hide();
                    $("#browse_file").val('');
                    $('#show_all_info').html(data);
                } else {


                }
            }
        });
    }));
	
	$("#save_program_course_form").on('submit',(function(e) {
        $("#loader").show();
        e.preventDefault();
        var formData = new FormData(this)
        $.ajax({
            url: base_url + "/save_program_courses_data", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data)   // A function to be called if request succeeds
            {
                if (data!='') {
                    $("#loader").hide();
                    $("#browse_file").val('');
                    $('#show_all_info').html(data);
                } else {


                }
            }
        });
    }));
	
	
	
	

});




function goBack() {
    window.history.back();
}




function updateUserAccessControl() {
    $.ajax({
        type: "POST",
        url: base_url + "/save_user_access_control",
        data: $('#userAccessControl').serialize(),
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

function AddSetupCtgInfo() {
    $("#ctg_details_form")[0].reset();
    $("#title").val('');
    $("#setting_id").val('');
    $("#is_active").val(1);
    $("#saveBtn").show();
    $("#updateBtn").hide();
    $("#heading-title").html('Add ');
    $("#form_output").html('');
    CKEDITOR.instances.ctgDetails.setData( '' );
}
function saveCtgDetailsInfo() {
    var ctgDetails = CKEDITOR.instances['ctgDetails'].getData();
    ctgDetails = ctgDetails.replace(/[&]nbsp[;]/gi," ");
    $.ajax({
        type: "POST",
        url: base_url + "/save_category_details",
        data: $('#ctg_details_form').serialize()+ '&ctgDetails='+ctgDetails,
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

function UpdateCtgDetailsInfo(id) {
    $("#ctg_details_form")[0].reset();
    $("#title").val('');
    $("#setting_id").val('');
    $("#is_active").val(1);
    $("#saveBtn").show();
    $("#updateBtn").hide();
    $("#heading-title").html('Update ');
    $("#form_output").html('');
    CKEDITOR.instances.ctgDetails.setData( '' );

    $.ajax({
        type: "POST",
        url: base_url + "/get_ctg_details_info",
        data: {id: id},
        'dataType': 'json',
        success: function (response) {
            if (response.status == 'success') {
                console.log(response.data);
                var data=response.data;
                $('#body_id').val(data.body_id).trigger('change');
                //$("#body_id").val(data.body_id);
                $("#ctg_id").val(data.ctg_id);
                $("#title").val(data.title_info);
                $("#is_active").val(data.is_active);


                $("#setting_id").val(data.id);
                CKEDITOR.instances.ctgDetails.setData(data.details);
            }
        }
    });

}
function deleteCtgDetailsInfo(id) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, You will not be able to recover this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/delete_category_details",
                    data: {id: id},
                    'dataType': 'json',
                    success: function (response) {
                        if (response.status == 'success') {
                            swal({
                                text: response.message,
                                icon: "success",
                            }).then(function() {
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

function updateTimeHigherEduExamController(facultyID){
    $('.show_report_info').html('');
    $.ajax({
        type: "POST",
        url: base_url + "/showAllDeptmentTimeHigerExamController",
        data: {facultyId:facultyID},
        success: function (response) {
            if (response !='') {
                $('.showAllDepartment').html(response);
            } else {
                $('.show_report_info').html('');

            }
        }
    });
}
function updateTimeHigherEduExamControl(){
    $.ajax({
        type: "POST",
        url: base_url + "/timeHigherEducationExamControlAction",
        data: $('#timeHigerEducationForm').serialize(),
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

function showTimeHigerEduInfo(id,deptID){ 

    $('.showAllDepartment').html('');
    $.ajax({
        type: "POST",
        url: base_url + "/showAllDeptmentTimeHiger",
        data: {id:id,deptID:deptID},
        success: function (response) {
			 $('.showAllDepartment').html('');
            if (response !='') {
                $('.showAllDepartment').html(response);
            } else {
                $('.showAllDepartment').html('');

            }
        }
    });
}

$("#facultyNameTimesHigher").change(function () {
    $('.showTimesHigherDeptInfo').html('');
    var facultyID = $(this).val();
    $.ajax({
        type: "POST",
        url: base_url + "/showTimesHigerDeptInfoByAdmin",
        data: {facultyID: facultyID},
        success: function (response) {
            if(response!='') {
                $('.showTimesHigherDeptInfo').html(response);
            }else{
                $('.showTimesHigherDeptInfo').html('');
            }

        }
    });

});


// Email & Local admin information updata
function addNewEmailAdmin () {
    $("#deptAdminInfoForm")[0].reset();
    $("#form_output").html('');
}

$(document).ready(function (e) {
    $("#deptAdminInfoForm").on('submit',(function(e) {
        var formData = new FormData(this)
        e.preventDefault();
        $.ajax({
            url: base_url + "/deptAdminInfoAction", // Url to which the request is send
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
                    $('#form_output').html(error_html);
                } else {
                    $('#form_output').html('');
                    swal({
                        text: data.success,
                        icon: "success",
                    }).then(function () {
                        location.reload();
                    });
                }
            }
        });
    }));
});


function updateBodyAdminInfo(id) {
    $("#deptAdminInfoForm")[0].reset();
    $('#form_output').html('');
    $.ajax({
        type: "POST",
        url: base_url + "/get_body_admin_info",
        data: {id: id},
        'dataType': 'json',
        success: function (response) {
            if (response.status == 'success') {
                var data=response.data;
                $('#deptID').val(data.body_id).trigger('change');
                $("#employee_id_search").val(data.employee_id);
                $("#emp_id").val(data.emp_id);
                $("#employee_mobile_no").val(data.mobile);
                $("#employee_email").val(data.email);
                $("#dept_email").val(data.admin_email);
                $("#adminType").val(data.admin_type);
                $("#employee_name_search").val(data.employee_name+' - '+data.emp_id);
                $("#old_attachment_file").val(data.attachment_file);
                $("#update_id").val(data.id);

            }
        }
    });
}

$("#facultyNameDeptAdmin,#admin_type_1,#admin_type_2").change(function () {
    $('.showData').html('');
    $.ajax({
        type: "POST",
        url: base_url + "/searchDeptAdminInfo",
        data: $('#searchDeptAdminInfo').serialize(),
        success: function (response) {
            if (response !='') {
                $('.showData').html(response);
            } else {
                $('.showData').html('');

            }
        }
    });
});
$("#admin_type_1,#admin_type_2").click(function () {
    $('.showData').html('');
    $.ajax({
        type: "POST",
        url: base_url + "/searchDeptAdminInfo",
        data: $('#searchDeptAdminInfo').serialize(),
        success: function (response) {
            if (response !='') {
                $('.showData').html(response);
            } else {
                $('.showData').html('');

            }
        }
    });
});