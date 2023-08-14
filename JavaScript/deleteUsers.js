$('.btn2').on('click', function () {
    const userId = $(this).closest('tr').attr('id');
    $("#exampleModalDelete").modal('show');
    $('#inputHiddenDelete').val(`["${userId}"]`)
    const lastName = $(`#${userId} .lastName`).text();
   const firstName = $(`#${userId} .firstName`).text();
   const op = $('#inputHiddenDelete').val();
   console.log(op);
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
        dataType: "html",
        success() {
            userId.forEach(item => {
                $(`#${item}`).remove();
            })
        }
    })
})