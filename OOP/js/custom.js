function select_all(obj) {
    if ($(obj).is(":checked")) {
        $(".check_multiple").prop('checked', true);
    } else {
        $(".check_multiple").prop('checked', false);
    }
}

function check_select() {
    var count = $(".check_multiple:checked").length;

    if (count > 0) {
        return true;
    } else {
        alert('Please select record(s) to delete');
        return false;
    }
}