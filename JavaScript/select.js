$(function () {
    $('.button').on('click', function () {
        const select = $(this).closest('.formSelect').find('.select').val();
        const btnDelete = $("#exampleModalConfirm .btnDelete");
        const confirmSpan = $('#exampleModalConfirm .modal-body span');
        const exampleModalConfirm = $("#exampleModalConfirm");
        const confirmH5 = $("#exampleModalConfirm h5");
        const userId = $(".check:checked").closest('tr').map(function () {
            return $(this).attr('id');
        }).get();
        confirmH5.text('Error');
        btnDelete.css('display', 'none')
        const check = $(".check").is(':checked');
        if (select === '' && check === false) {
            confirmSpan.text('Please select a user and an action');
            exampleModalConfirm.modal('show');
        } else if (select === '') {
            confirmSpan.text('Please select an action');
            exampleModalConfirm.modal('show');
        } else if (check === false) {
            confirmSpan.text('Please select a user');
            exampleModalConfirm.modal('show');
        } else if (select == 'delete') {
            confirmH5.text('Delete');
            exampleModalConfirm.modal('show');
            btnDelete.css('display', 'block');
            $('#inputHiddenDelete').val(`${JSON.stringify(userId)}`);
            if (userId.length > 1) {
                $('#deleteUser').text(`Are you sure want to delete ${userId.length} users`)
            } else {
                const firstName = $(`#${userId} .firstName`).text();
                const lastName = $(`#${userId} .lastName`).text();
                $('#deleteUser').text(`Are you sure want to delete ${firstName} ${lastName}`)

            }
            return
        }
        $.ajax({
            url: './Controller/updateUsers.php',
            type: 'POST',
            cache: false,
            data: {'checkInfo': {'userId': userId, 'select': select}},
            dataType: 'JSON',
            success: function (data) {
                $('.select option[value=""]').prop('selected', true)
                if (data.users) {
                    data.users.forEach(item => {
                        $(`#${item.id}`).attr('status', `${item.status}`);
                    })
                }
                if (data.error !== null) {
                    confirmSpan.text(data.error.message);
                    exampleModalConfirm.modal('show');
                }

                $('input[type="checkbox"]').prop('checked', false);
            }
        })
    });
})