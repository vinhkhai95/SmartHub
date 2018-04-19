
/**
 * Invoke URL: confirmEdit('index.php?action=list', 'product');
 * @param {String} redirectUrl
 * @param {String} itemName
 * @returns {undefined}
 */
function confirmEdit(redirectUrl, itemName) {
    swal({
        title: 'Are you sure?',
        text: "Do you want to change the information?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Change It!'
    }).then(function () {
        window.location = redirectUrl;
    }).done();
}
/**
 * Invoked URL: confirmDelete('index.php?action=list', 'product');
 * @param {String} redirectUrl
 * @param {String} itemName
 * @returns {undefined}
 */
function confirmDelete(redirectUrl, itemName) {
    swal({
        title: 'Are you sure?',
        text: "Do you want to delete the " + itemName + "?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete It!'
    }).then(function () {
        window.location = redirectUrl;
    });
}


function autoAlert(msg) {
    //auto close the alert in 2 second
    swal({
        title: 'Success!',
        text: msg,
        timer: 4000
    });
}