document.addEventListener('DOMContentLoaded', function () {
    let formulario = document.getElementById('formulario');
    formulario.addEventListener('submit', function (event) {
        event.preventDefault();
        crearLibroAjax();
    });


});
function crearLibroAjax() {

    let editForm = $("#formulario").serialize();
    if ($('#modal').modal('show'));
    axios.post('/books/crearLibroAjax', editForm)
        .then(function (response) {
            console.log(response);
            $('#formulario').trigger("reset");
        }).catch(function (error) {
            console.log(error);
        }).then(function(){
            $('#modal').modal('hide');
        })

}