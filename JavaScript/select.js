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
        }
        else if (select === '') {
            $('#exampleModalConfirm .modal-body span').text('Please select an action');
            $("#exampleModalConfirm").modal('show');
        }
        else if (check === false) {
            $('#exampleModalConfirm .modal-body span').text('Please select a user');
            $("#exampleModalConfirm").modal('show');
        }
        else if (select == 'delete') {
            $("#exampleModalDelete").modal('show');
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
            success: function (datas) {
                $('.select option[value=""]').prop('selected',true)
               const data = JSON.parse(datas)
                    if (data.users){
                        data.users.forEach(item=>{
                            $(`#${item.id}`).attr('status', `${item.status}`);
                        })
                    }
                if (data.error !== null){
                    $('#exampleModalConfirm .modal-body span').text(data.error.message);
                    $("#exampleModalConfirm").modal('show');
                }

                $('input[type="checkbox"]').prop('checked', false);
            }
        })
    });
})