
$(function () {
    $('.buttonAdd').on('click', function () {
        const userId = $('#inputHiddenEdit').val();
        const lastName = $('#lastName').val();
        const firstName = $('#firstName').val();
        const status = $('.flexSwitchCheckChecked input').is(':checked');
        const role = $('#roleAdd').val();
        const select = $(this).closest('#addEditForm').find('#roleAdd').val();
        if (select === '') {
            $('#exampleModalConfirm .modal-body span').text('Please select a role');
            $("#exampleModalConfirm").modal('show');
            return;
        }
        $.ajax({
            url: './Controller/addUser.php',
            type: 'POST',
            cache: false,
            data: {'userId': userId, 'lastName': lastName, 'firstName': firstName, 'status': status, 'role': role},
            dataType: 'html',
            success: function (data) {
                const jsonData = JSON.parse(data);
                if (jsonData.status == 'false') {
                    $('.errorWindow').text(jsonData.error.message).css('color', 'red');
                } else if (userId !== '"null"') {
                    $(`#${userId} .lastName`).text(`${jsonData.user.lastName}`);
                    $(`#${userId} .firstName`).text(`${jsonData.user.firestName}`);
                    $(`#${userId}`).attr('status', `${jsonData.user.status}`);
                    $(`#${userId} .role`).text(`${jsonData.user.role}`);
                    $("#exampleModal").modal('hide');
                } else {
                    $('tbody').append(`
    <tr id="${jsonData.user.id}" status="${jsonData.user.status}">
        <th><input type="checkbox" class="check"></th>
        <td>
            <span scope="col" class="firstName">${jsonData.user.firestName}</span>
            <span class="lastName">${jsonData.user.lastName}</span>
        </td>
        <td class="role">${jsonData.user.role}</td>
        <td>
            <div class="status">
                <div class="colo">
                </div>
            </div>
        </td>
        <td>
            <div class="status">
                <div class="butt ">
                    <button class="btn1 btnEdit "><img src="icons/edit.svg" alt="edit"></button>
                    <button class="btn2"><img src="icons/svgviewer-output%20(3).svg" alt="trash"></button>
                </div>
            </div>
        </td>
    </tr>`
                    )
                    $("#exampleModal").modal('hide');
                }

            }

        })

    })
})
    $(document).on('click','.btnEdit',function (){
        $('#exampleModalLabel').text('Edit user');
        const userId = $(this).closest('tr').attr('id');
        const status = $(`#${userId} `).attr('status');
        $('#inputHiddenEdit').val(`${userId}`)
        $('.flexSwitchCheckChecked input').prop('checked', `${status}` === 'true')

        $('#lastName').each(function () {
            $(this).val($(`#${userId} .lastName`).text())
        })
        $('#firstName').each(function () {
            $(this).val($(`#${userId} .firstName`).text())
        })
        $('#roleAdd').each(function () {
            $(this).val($(`#${userId} .role`).text())
        })
        $('#statusAdd').each(function () {
            $(this).val($(`#${userId} .status`).text())
        })
        $("#exampleModal").modal('show');
    })

