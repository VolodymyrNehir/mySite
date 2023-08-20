$(function () {
    $(document).on('click', '.btn2', function () {
        const userId = $(this).closest('tr').attr('id');
        $("#exampleModalDelete").modal('show');
        $('#inputHiddenDelete').val(`["${userId}"]`)
        const lastName = $(`#${userId} .lastName`).text();
        const firstName = $(`#${userId} .firstName`).text();
        $('#deleteUser').text(`Are you sure want to delete ${lastName} ${firstName}`)
    })
    $('.btnDelete').on('click', function () {
        $("#exampleModalDelete").modal('hide')
        const userId = JSON.parse($('#inputHiddenDelete').val());
        $.ajax({
            url: './Controller/deleteUser.php',
            type: 'POST',
            cache: false,
            data: {"userId": userId},
            success(data) {
                const statusCod = JSON.parse(data)
                userId.forEach(item => {
                    statusCod.forEach(values=>{
                        if (values.status == 'false'){
                            $('#exampleModalConfirm .modal-body span').text($(`#${item} .lastName`).text() +' '+ $(`#${item} .lastName`).text() +' '+ values.error.message);
                            $("#exampleModalConfirm").modal('show');
                        }
                        $(`#${item}`).remove();
                    })
                })
            }
        })
    })
})