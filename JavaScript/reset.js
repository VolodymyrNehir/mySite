$(function () {
    $('.butReset').on('click', function () {
        $('#inputHiddenEdit').val('');
        $('#addEditForm input[type=text], #addEditForm select').val('');
        $('.switchStatus input').prop('checked', false)
        $('#exampleModalLabel').text('Add user')
        $('.buttonAdd').text('Add user');
        $('.lastNameError, .firstNameError, .roleError, .errorWindow').text('');

    })
})