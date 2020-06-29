const modalAlert = (text, hideHandler) => {
    $('#alertModal').find('.modal-body').html(text);
    $('#alertModal').modal('show');
    setTimeout(() => {
        $('#alertModal').modal('hide');
    },4000);

    $('#alertModal').on('hidden.bs.modal', function (e) {
        if(hideHandler) {
            hideHandler();
        }
    })
}

export default modalAlert;
