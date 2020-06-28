const modalAlert = (text) => {
    $('#alertModal').find('.modal-body').html(text);
    $('#alertModal').modal('show');
    setTimeout(() => {
        $('#alertModal').modal('hide');
    },5000);
}

export default modalAlert;
