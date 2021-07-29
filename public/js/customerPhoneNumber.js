$(document).ready(function () {
    $('#addPhone').on('click', function () {
        var phone = '<input type="text" class="form-control mt-1" name="phone[]">';
        $('#phone').append(phone);
    });

    $('#deletePhone').on('click', function () {
        $('#phone input:last-child').remove();
    });
});
