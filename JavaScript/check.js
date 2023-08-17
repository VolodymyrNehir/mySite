$(function () {
    $(document).on('change', '#checkAll', function () {
        const isCheckAllChecked = $(this).is(':checked');
        $(".check").prop("checked", isCheckAllChecked);
    })


    $(document).on('change', '.check', function () {
        const isAtLeastOneChecked = $(".check:checked").length == $('.check').length;
        $("#checkAll").prop("checked", isAtLeastOneChecked);

    })


})


