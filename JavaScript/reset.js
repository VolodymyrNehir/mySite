$(function () {
    $('.butReset').on('click', function () {
        $('#inputHiddenEdit').val(null);
        $('#addEditForm input[type=text], #addEditForm select').val('');
        $('.switchCheck input').prop('checked', false)
        $('#exampleModalLabel').text('Add user')
        $('.buttonAdd').text('Add user');
        $('.lastNameError, .firstNameError, .roleError, .errorWindow').text('');

    })
})