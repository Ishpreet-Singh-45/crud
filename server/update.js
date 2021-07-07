$(document).ready(function()
{
    var current_url = window.location.href;
    current_url = (current_url.replace("update", "retrieve")).substring(16);
    $.post(current_url, function(data)
    {
        var data = JSON.parse(data);
        $("input[name='update_name']").attr('value', data.Name);
        $("input[name='update_email']").attr('value', data.Email);
        $("input[name='update_contact']").attr('value', data.Contact);
        $("input[name='update_gender']").attr('value', data.Gender);
        $("input[name='update_dob']").attr('value', data.DOB);
        $("input[name='update_city']").attr('value', data.City);
        $("input[name='update_state']").attr('value', data.State);
        $("textarea#current").text("asdaa");
        $("textarea#permanent").text(data.Permanent);

        $("#document").attr('href', "../uploads/Documents/" + data.Document);
        $("#image").attr('href', "../uploads/Images/" + data.Image);

    });
});