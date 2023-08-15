
$("#checkAll").on('change',function () {
    const isCheckAllChecked = $(this).is(':checked');
    $(".check").prop("checked", isCheckAllChecked);

});
$(document).on('click','.check',function (){
    const isAtLeastOneChecked = $(".check:checked").length >= $('.check').length;
    $("#checkAll").prop("checked", isAtLeastOneChecked);
})




