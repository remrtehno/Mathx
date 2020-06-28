const modalAlert = (text) => {
    $('#alertModal').find('.modal-body').html(text);
    $('#alertModal').modal('show');
    setTimeout(() => {
        $('#alertModal').modal('hide');
    },4000);
}

export default modalAlert;
