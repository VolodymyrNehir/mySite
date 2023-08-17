$(function () {
    $('.button').on('click',function () {
        const select = $(this).closest('.formSelect').find('.select').val();
        const userId = $(".check:checked").closest('tr').map(function () {
            return $(this).attr('id');
        }).get();

        const check = $(".check").is(':checked');
        if (select === '' && check === false) {
            $('#exampleModalConfirm .modal-body span').text('Please select a user and an action');
            $("#exampleModalConfirm").modal('show');

            return;
        }
        if (select === '') {
            $('#exampleModalConfirm .modal-body span').text('Please select an action');
            $("#exampleModalConfirm").modal('show');
            return;
        }
        if (check === false) {
            $('#exampleModalConfirm .modal-body span').text('Please select a user');
            $("#exampleModalConfirm").modal('show');
            return;
        }
        if (select == 'delete') {
            $("#exampleModalDelete").modal('show');
            $('#inputHiddenDelete').val(`${JSON.stringify(userId)}`);
            if (userId.length > 1) {
                $('#deleteUser').text(`Are you sure want to delete ${userId.length} users`)
            } else {
                const firstName = $(`#${userId} .firstName`).text();
                const lastName = $(`#${userId} .lastName`).text();
                $('#deleteUser').text(`Are you sure want to delete ${firstName} ${lastName}`)
            }

            return;
        }
        $.ajax({
            url: './Controller/updateUsers.php',
            type: 'POST',
            cache: false,
            data: {'form': {'userId': userId, 'select': select}},
            success: function () {
                userId.forEach(item => {
                    $(`#${item}`).attr('status', `${select}`);
                })
                $('input[type="checkbox"]').prop('checked', false);

            }
        })
    });
})