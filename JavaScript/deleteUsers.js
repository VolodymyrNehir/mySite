$(function () {
    $(document).on('click', '.btn2', function () {
        const userId = $(this).closest('tr').attr('id');
        $("#exampleModalConfirm").modal('show');
        $('#inputHiddenDelete').val(JSON.stringify([userId]))
        const lastName = $(`#${userId} .lastName`).text();
        const firstName = $(`#${userId} .firstName`).text();
        $('#deleteUser').text(`Are you sure want to delete ${lastName} ${firstName}`)
        $("#exampleModalConfirm .btnDelete").css('display', 'block');
        $("#exampleModalConfirm h5").text('Delete')
    })
    $('.btnDelete').on('click', function () {
        $("#exampleModalConfirm").modal('hide')
        const userId = JSON.parse($('#inputHiddenDelete').val());
        $.ajax({
            url: './Controller/deleteUser.php',
            type: 'POST',
            cache: false,
            data: {"userId": userId},
            dataType: 'JSON',
            success(data) {
                userId.forEach(item => {
                    if (data.status === true){
                        $(`#${item}`).remove();
                    }
                })
                const isAtLeastOneChecked = $(".check:checked").length == $('.check').length;
                $("#checkAll").prop("checked", isAtLeastOneChecked);
            }
        })
    })
})