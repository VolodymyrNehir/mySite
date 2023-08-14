$('.button').click(function () {
    const select = $(this).closest('.formSelect').find('.select').val();
    const userId = $(".check:checked").closest('tr').map(function () {
        return $(this).attr('id');
    }).get();

    const check = $(".check").is(':checked');
    if (select === '' && check === false) {
        $('#exampleModalConfirm .modal-body span').text('no select and no check');
        $("#exampleModalConfirm").modal('show');

        return;
    }
    if (select === '') {
        $('#exampleModalConfirm .modal-body span').text('no select');
        $("#exampleModalConfirm").modal('show');
        return;
    }
    if (check === false) {
        $('#exampleModalConfirm .modal-body span').text('no check');
        $("#exampleModalConfirm").modal('show');
        return;
    }
    if (select == 'delete') {
        $("#exampleModalDelete").modal('show');
        $('#inputHiddenDelete').val(`${JSON.stringify(userId)}`);
        $('#deleteUser').text(`Are you sure want to delete ${userId.length} users`)
        return;
    }
    $.ajax({
        url: './Controller/updateUsers.php',
        type: 'POST',
        cache: false,
        data: {'form': {'userId': userId, 'select': select}},
        dataType: 'html',
        success: function () {
            userId.forEach(item=>{
                $(`#${item}`).attr('status', `${select}`);
            })
            $('input[type="checkbox"]').prop('checked', false);

        }
    })
});
