$(document).ready(function () {
    view_record();

    //Insert Record in the Database
    var form = document.getElementById('regForm');
    form.addEventListener('submit', function (e) {
        e.preventDefault();
    });

})
function register() {
    var User = $('#UserName').val();
    var Email = $('#UserEmail').val();
    var Company = $('#company').val();

    if (User == "" || Email == "" || Company == "") {
        $('#message').html('Please Fill in all Fields');
    }
    else {
        $.ajax(
            {
                url: 'controller/insert.php',
                method: 'post',
                data: { UserName: User, UserEmail: Email, UserCompany: Company },
                success: function (data) {
                    $('#message').html(data);
                    $("#regForm")[0].reset();
                    view_record();
                }

            })
    }
}

//Display Table
function view_record(page) {
    $.ajax(
        {
            url: "controller/view.php",
            method: 'post',
            data: { page_no: page },
            success: function (response) {
                response = $.parseJSON(response);
                if (response.status == "success") {
                    $('#table').html(response.html);
                }
            }
        })
}

$(document).on("click", ".pagination li a", function (e) {
    e.preventDefault();
    var pageId = $(this).attr("id");
    view_record(pageId);
});


