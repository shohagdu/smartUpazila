function AddProgramApplication() {
    $("#addProgramApp")[0].reset();
    $("#show_status").hide();
    $("#employee_id").select2('val','');
    $("#saveBtn").show();
    $("#updateBtn").hide();
    $("#heading-title").html('Add ');
}
function updateProgramApplication(id) {
    $("#addProgramApp")[0].reset();
    $("#show_status").hide();
    $("#employee_id").select2('val','');
    $("#saveBtn").hide();
    $("#updateBtn").show();
    $("#heading-title").html('Update ');
}

// $('.timepicker').timepicker({
//     timeFormat: 'h:mm p',
//     interval: 5,
//     minTime: '10',
//     maxTime: '11:00pm',
//     defaultTime: '10',
//     startTime: '10:00am',
//     dynamic: false,
//     dropdown: true,
//     scrollbar: true
// });

function AddProgramArtist() {
    $("#addProgramArtistForm")[0].reset();
    $("#show_status").hide();
    $("#saveBtn").show();
    $("#updateBtn").hide();
    $("#heading-title").html('Add ');
}