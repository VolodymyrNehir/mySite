
$("#checkAll").change(function () {
    const isCheckAllChecked = $(this).is(':checked');
    $(".check").prop("checked", isCheckAllChecked);

});

$(".check").change(function () {
    const isAtLeastOneChecked = $(".check:checked").length >= $('.check').length;
    $("#checkAll").prop("checked", isAtLeastOneChecked);
});