$(function () {
    $('.buttonAdd').on('click', function () {
        const userId = $('#inputHiddenEdit').val();
        const lastName = $('#lastName').val().trim();
        const firstName = $('#firstName').val().trim();
        let status = $('.switchCheck input').is(':checked');
        const role = $('#roleAdd').val();
        const lastNameError = $('.lastNameError')
        const firstNameError = $('.firstNameError')
        const roleError = $('.roleError')
        const roleArr = ["Admin", "User"];
        if (status === true) {
            status = 1
        } else {
            status = 2
        }

        lastNameError.text('')
        firstNameError.text('')
        roleError.text('')

        if (lastName === '') {
            lastNameError.text(' Please fill in your last name').css('color', 'red');
        }

        if (firstName === '') {
            firstNameError.text(' Please fill in your first name').css('color', 'red');
        }

        if (role === '') {
            roleError.text(' Please select a role').css('color', 'red');
        }

        if (lastNameError.text() !== '' || firstNameError.text() !== '' || roleError.text() !== '') {
            return
        }
        console.log(userId)

        $.ajax({
            url: './Controller/addUpUsers.php',
            type: 'POST',
            cache: false,
            data: {'userId': userId, 'lastName': lastName, 'firstName': firstName, 'status': status, 'role': role},
            dataType: 'JSON',
            success: function (data) {
                if (data.status === false && data.error) {
                    for (const value of data.error) {
                        $(`.${value.field}Error`).text(value.message).css('color', 'red');
                    }
                } else if (userId) {
                    $(`#${data.user.id} .lastName`).text(`${data.user.lastName}`);
                    $(`#${data.user.id} .firstName`).text(`${data.user.firstName}`);
                    $(`#${data.user.id}`).attr('status', `${status}`);
                    $(`#${data.user.id} .role`).text(`${roleArr[role - 1]}`);
                    $("#exampleModal").modal('hide');
                } else {
                    let checked = ':checked';
                    if ($('#checkAll').is('checked')) {
                        checked = 'checked'
                    }

                    $('tbody').append(`
    <tr id="${data.user.id}" status="${status}">
        <th><input type="checkbox" class="check" ${checked}></th>
        <td>
            <span scope="col" class="firstName">${data.user.firstName}</span>
            <span class="lastName">${data.user.lastName}</span>
        </td>
        <td class="role">${roleArr[role -1]}</td>
        <td>
            <div class="status">
                <div class="colo">
                </div>
            </div>
        </td>
        <td>
            <div class="status">
                <div class="butt ">
                    <button class="buttonEdit"><i>Edit</i></button>
                    <button class="buttonDelete"><i class="bi bi-trash3"></i></button>
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


    $(document).on('click', '.buttonEdit', function () {
        $('.lastNameError, .firstNameError, .roleError').text('');
        $('#exampleModalLabel').text('Edit user');
        $('.buttonAdd').text('Save user');
        const userId = $(this).closest('tr').attr('id');
        const status = $(`#${userId} `).attr('status');
        $('#inputHiddenEdit').val(userId)
        $('.switchCheck input').prop('checked', `${status}` === '1')
        $('#lastName').val($(`#${userId} .lastName`).text())
        $('#firstName').val($(`#${userId} .firstName`).text())
        let role = 0;
        if ($(`#${userId} .role`).text() === 'Admin'){
             role = 1;
        } else {
            role = 2;
        }
        $('#roleAdd').val(role);
        $('#statusAdd').val($(`#${userId} .status`).text())
        $("#exampleModal").modal('show');
    })

})