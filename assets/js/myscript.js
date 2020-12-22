$('.delete_lead').on("click", function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to delete this data!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {

            swal.fire("", "Menu has been deleted!", "success");
            setTimeout(
                function () {
                    window.location.replace(url);
                }, 1500);

        } else {
            Swal.fire('Data not deleted!');
        }
    });
});
function success() {
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Your work has been saved',
        showConfirmButton: false,
        timer: 1500
    })
}