$(function () {
    $('.buttonAdd').on('click', function () {
        const userId = $('#inputHiddenEdit').val();
        const lastName = $('#lastName').val();
        const firstName = $('#firstName').val();
        const status = $('.flexSwitchCheckChecked input').is(':checked');
        const role = $('#roleAdd').val();
        $('.firstNameError').text('')
        $('.lastNameError').text('')
        $('.roleError').text('');
        $.ajax({
            url: './Controller/addUser.php',
            type: 'POST',
            cache: false,
            data: {'userId': userId, 'lastName': lastName, 'firstName': firstName, 'status': status, 'role': role},
            success: function (response) {
                const data = JSON.parse(response);
                if (data.status == 'false' && data.error) {
                    for (const value of data.error) {
                        $(`.${value.field}Error`).text(value.message).css('color', 'red');
                    }
                } else if (userId !== '"null"') {
                    $(`#${data.user.id} .lastName`).text(`${data.user.lastName}`);
                    $(`#${data.user.id} .firstName`).text(`${data.user.firstName}`);
                    $(`#${data.user.id}`).attr('status', `${data.user.status}`);
                    $(`#${data.user.id} .role`).text(`${data.user.role}`);
                    $("#exampleModal").modal('hide');
                } else {
                    let checked = ':checked';
                    if ($('#checkAll').prop('checked')) {
                        checked = 'checked'
                    }
                    $('tbody').append(`
    <tr id="${data.user.id}" status="${data.user.status}">
        <th><input type="checkbox" class="check" ${checked}></th>
        <td>
            <span scope="col" class="firstName">${data.user.firstName}</span>
            <span class="lastName">${data.user.lastName}</span>
        </td>
        <td class="role">${data.user.role}</td>
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