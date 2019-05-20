document.addEventListener('DOMContentLoaded', function () {
    let formulario = document.getElementById('formulario');
    formulario.addEventListener('submit', function (event) {
        event.preventDefault();
        crearLibroAjax();
        despuesDeCrearAlerta();
    });


});
function crearLIbroAjax() {

    let editForm = $("#formulario").serialize();
    if ($('#modal').modal('show'));
    axios.post('/tanks/crearLibroAjax', editForm)
        .then(function (response) {
            console.log(response);
            $('#formulario').trigger("reset");
        }).catch(function (error) {
            console.log(error);
        }).then(function(){
            $('#modal').modal('hide');
        })

}

function despuesDeCrearAlerta() {

    let editForm = $('#formulario').serialize();
    axios.post('/tanks/crearLibroAjax', editForm)
        .then(function (response) {
            if ($('#alert').hasClass('hide')) {
                $('#alert').removeClass('hide')
                $('#alert').addClass('show');
            };
            $('#modalCrear').modal('show')
            console.log(response);
        }).catch(function (error) {
            console.log(error);
        }).then(function(){
            $('#alert').modal('hide');
        })
}