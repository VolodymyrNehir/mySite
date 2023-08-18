$(function () {
    $('.buttonAdd').on('click', function () {
        const userId = $('#inputHiddenEdit').val();
        const lastName = $('#lastName').val();
        const firstName = $('#firstName').val();
        const status = $('.flexSwitchCheckChecked input').is(':checked');
        const role = $('#roleAdd').val();
        const select = $(this).closest('#addEditForm').find('#roleAdd').val();
        $('.firstNameError').text('')
        $('.lastNameError').text('')
        $('.roleError').text('');
        $.ajax({
            url: './Controller/addUser.php',
            type: 'POST',
            cache: false,
            data: {'userId': userId, 'lastName': lastName, 'firstName': firstName, 'status': status, 'role': role},
            success: function (data) {
                console.log(data)
                const jsonData = JSON.parse(data);
                console.log(jsonData)
                if (jsonData.status == 'false') {
                $('.firstNameError').text(jsonData.error.message.firstName).css('color', 'red');
                $('.lastNameError').text(jsonData.error.message.lastName).css('color', 'red');
                $('.roleError').text(jsonData.error.message.role).css('color', 'red');
                $('.errorWindow').text(jsonData.error.message.noFound).css('color', 'red');
            } else if(userId !== '"null"')
        {
            $(`#${userId} .lastName`).text(`${jsonData.user.lastName}`);
            $(`#${userId} .firstName`).text(`${jsonData.user.firstName}`);
            $(`#${userId}`).attr('status', `${jsonData.user.status}`);
            $(`#${userId} .role`).text(`${jsonData.user.role}`);
            $("#exampleModal").modal('hide');
        }
    else
        {
            let checked
            if ($(checkAll).prop('checked')) {
                checked = 'checked'
            }
            $('tbody').append(`
    <tr id="${jsonData.user.id}" status="${jsonData.user.status}">
        <th><input type="checkbox" class="check" ${checked}></th>
        <td>
            <span scope="col" class="firstName">${jsonData.user.firstName}</span>
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

$(document).on('click', '.btnEdit', function () {
    $('.errorForm').text('');
    $('#exampleModalLabel').text('Edit user');
    $('.buttonAdd').text('Save user');
    const userId = $(this).closest('tr').attr('id');
    const status = $(`#${userId} `).attr('status');
    $('#inputHiddenEdit').val(`${userId}`)
    $('.flexSwitchCheckChecked input').prop('checked', `${status}` === 'true')

    $('#lastName').val($(`#${userId} .lastName`).text())
    $('#firstName').val($(`#${userId} .firstName`).text())
    $('#roleAdd').val($(`#${userId} .role`).text())
    $('#statusAdd').val($(`#${userId} .status`).text())
    $("#exampleModal").modal('show');
})

})