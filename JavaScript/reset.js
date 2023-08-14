
$('.butReset').on('click', function () {
    $('#inputHiddenEdit').val(`"null"`);
    $('#addEditForm input[type=text]').val('');
    $('#addEditForm select').val('')
    $('.flexSwitchCheckChecked input').prop('checked', false)
    $('#exampleModalLabel').text('Add user')
    $('.errorWindow').text('')

})