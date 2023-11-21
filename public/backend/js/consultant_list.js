$(".toggle-password").click(function () {

    var input = $(this).closest('.input-group').find('input');

    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});
$(".imgBrowse").change(function (e) {
    e.preventDefault();
    var file = $(this).closest('.primary_file_uploader').find('.imgName');
    var filename = $(this).val().split('\\').pop();
    file.val(filename);
});

$(document).on('click', '.editconsultant', function () {
    let consultant_id = $(this).data('item-id');
    let url = $('#url').val();
    url = url + '/admin/get-user-data/' + consultant_id
    let token = $('.csrf_token').val();

    $.ajax({
        type: 'POST',
        url: url,
        data: {
            '_token': token,
        },
        success: function (consultant) {
            $('#consultantId').val(consultant.id);
            $('#consultantName').val(consultant.name);
            $('#consultantAbout').summernote("code", consultant.about);
            $('#consultantDob').val(consultant.dob);
            $('#consultantPhone').val(consultant.phone);
            $('#consultantEmail').val(consultant.email);
            $('#consultantImage').val(consultant.image);
            $('#consultantFacebook').val(consultant.facebook);
            $('#consultantTwitter').val(consultant.twitter);
            $('#consultantLinkedin').val(consultant.linkedin);
            $('#consultantInstragram').val(consultant.instagram);
            $('#degree').val(consultant.degree);
            $('#institution').val(consultant.institution);
            $('#start_date').val(consultant.start_date);
            $('#end_date').val(consultant.end_date);
            $("#editconsultant").modal('show');
        },
        error: function (data) {
            toastr.error('Something Went Wrong', 'Error');
        }
    });


});


$(document).on('click', '.deleteconsultant', function () {
    let id = $(this).data('id');
    $('#consultantDeleteId').val(id);
    $("#deleteconsultant").modal('show');
})


$(document).on('click', '#add_consultant_btn', function () {
    $('#addName').val('');
    $('#addAbout').html('');
    $('#startDate').val('');
    $('#addPhone').val('');
    $('#addEmail').val('');
    $('#addPassword').val('');
    $('#addCpassword').val('');
    $('#addFacebook').val('');
    $('#addTwitter').val('');
    $('#addLinked').val('');
    $('#addInstagram').val('');
});
