$(function () {
    $(document).on('click', '.buttonDelete', function () {
        const userId = $(this).closest('tr').attr('id');
        $("#exampleModalConfirm").modal('show');
        $('#inputHiddenDelete').val(JSON.stringify([userId]))
        const lastName = $(`#${userId} .lastName`).text();
        const firstName = $(`#${userId} .firstName`).text();
        $('#infoUser').text(`Are you sure want to delete ${lastName} ${firstName}`)
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
            dataType: 'json',
            success(data) {
                userId.forEach(item => {
                    if (data.status === true){
                        $(`#${item}`).remove();
                        $('.select option[value=""]').prop('selected', true)
                    }
                })
                const isAtLeastOneChecked = $(".check:checked").length == $('.check').length;
                $("#checkAll").prop("checked", isAtLeastOneChecked);
            }
        })
    })
})