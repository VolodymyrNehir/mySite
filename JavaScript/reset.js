$(function () {
    $('.butReset').on('click', function () {
        $('#inputHiddenEdit').val(`"null"`);
        $('#addEditForm input[type=text], #addEditForm select').val('');
        $('.flexSwitchCheckChecked input').prop('checked', false)
        $('#exampleModalLabel').text('Add user')
        $('.buttonAdd').text('Add user');
        $('.errorForm, .errorWindow').text('');
    })
})