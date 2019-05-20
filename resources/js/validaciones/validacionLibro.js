$(function(){ //jquery
    //document.addEventListener("DOMContentLoaded", function(event){ JavaScript Puro/ Vainilla
    asociarEventos();
});

function asociarEventos(){
    $('#formulario').submit(function (event) {
        event.preventDefault();
        validarFormulario();
    });

    $("#title").change(function(event){
        validacionTitulo();

    })

    $("#email").change(function(event){
        validacionEmail();
    })

    $("#publisher").change(function(event){
      validacionPublisher();
    })

    $("#customCheck").change(function(event){
        validarCondiciones();
    })

    $('#formularioEditar').submit(function (event) {
        event.preventDefault();
        editarFormulario();
    });


    $("button[data-accion='mostrar_modal']").click(
        function(event){
            event.preventDefault();
            $("#confirmarEliminar").attr("data-elemento-borrar",$(event.target).attr('data-elemento'));
            $("#modalEliminar").modal('show');
    });

    $("#confirmarEliminar").click(function(event){
        event.preventDefault();
        borrarFormulario();
    });

    $("a[data-accion='show']").click(function (event) {
        event.preventDefault();
        let idBook = $(event.target).attr('data-book');
        mostrarFormulario(idBook);
    });

    $("#busqueda").keypress(function (event){
        event.preventDefault();
        busquedaAjax();
    })

}


function marcarInputCorrecto(input){
    input.addClass("is-valid");

}

function marcarInputErroneo(input){
    input.addClass("is-invalid");
}

function validacionTitulo(){
    $("#title").removeClass("is-valid is-invalid");
    $("#erroresTitle").empty();
    let correcto = false;
    let expresion = /[a-zA-Z]+$/g;
    let valor = $("#title").val().trim();
    if(expresion.test(valor)){
        marcarInputCorrecto($("#title"));
        correcto = true;
    }else{
        marcarInputErroneo($("#title"));
        $("#erroresTitle").append("<span>El título solo permite letras minúsculas y mayúsculas<span>");
    }

    return correcto;
}

function validacionEmail(){
    $("#email").removeClass("is-valid is-invalid");
    $("#erroresEmail").empty();
    let correcto = false;
    let expresion = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
    let valor = $("#email").val().trim();
    if (expresion.test(valor)){
      marcarInputCorrecto($("#email"));
      correcto = true;
    }else{
      marcarInputErroneo($("#email"));
      $("#erroresEmail").append("<span>El email es necesario que lleve @ <span>")
    }
    return correcto;

}

function validacionPublisher(){
  $("#publisher").removeClass("is-valid is-invalid");
  let correcto = false;
  let opcion = document.getElementById("publisher").value;
  let divErrores = document.getElementById("erroresPublisher");
  $(divErrores).empty();


  if(opcion===""){
      divErrores.append("Selecciona una opción");
      $("#publisher").addClass("is-invalid");
  }else{
      $("#publisher").addClass("is-valid");
      correcto = true;
  }
  return correcto;

}

function validarCondiciones(){
    $("#customCheck").removeClass("is-valid is-invalid");
    let correcto = false;
    let aceptar = document.getElementById("customCheck");
    let divErrores = document.getElementById("erroresCondiciones");
    $(divErrores).empty();


    if (!aceptar.checked){
        divErrores.append("Seleccione la casilla para continuar");
        $("#customCheck").addClass("is-invalid");
    }else{
        $("#customCheck").addClass("is-valid");
        correcto = true;
    }

    return correcto;
}

function validarFormulario(){
    $('#modalCarga').modal('show');

    let esTituloCorrecto = validacionTitulo();
    let esEmailCorrecto = validacionEmail();
    let esPublisherCorrecto = validacionPublisher();
    let esCondicionCorrecto = validarCondiciones();

    if (esTituloCorrecto && esEmailCorrecto && esPublisherCorrecto && esCondicionCorrecto){
        let datosFormulario = $("#formulario").serialize();
        axios.post("/books/createAjax",datosFormulario)
        .then(function(response){
            $("#modalCorrecto .modal-body p").html(response.data);
            $("#modalCorrecto").modal("show");
        }).catch(function(){
            $('#modalError').modal('show');
        }).then(function(){
           $('#modal').modal('hide');
           $('#modalCarga').modal('hide');
        })
        

    }else{
        $('#modalCarga').modal('hide');
        $('#modal').modal('show');
    }
        
}

function editarFormulario(){
    let editForm = $("#formularioEditar").serialize();
    let idBook = $("#formularioEditar").attr("data-book");

    $('#modalCarga').modal('show');
    axios.put(`/books/editAjax/${idBook}`, editForm)
        .then(function (response) {
            $("#modalCorrecto .modal-body p").html(response.data);
            $("#modalCorrecto").modal("show");
        }).catch(function(){
            $('#modalError').modal('show');
        }).then(function(){
            $('#modalCarga').modal('hide');
        })

}

function borrarFormulario(){
    let idBook =  $("#confirmarEliminar").attr('data-elemento-borrar');
    $('#modalEliminar').modal('hide');
    $('#modalCarga').modal('show');
    axios.delete(`/books/deleteAjax/${idBook}`)
        .then(function (response) {
            $("#modalCorrecto .modal-body p").html(response.data);
            $(`#libro${idBook}`).remove();
        }).catch(function () {
            $('#modalError').modal('show');
        }).then(function () {
            $('#modalCarga').modal("hide");
        });
}

function mostrarFormulario(idBook){

$('#modalCarga').modal("show");
    axios.get(`/books/showAjax/${idBook}`)
        .then(function (response) {
            $('#modalCarga').modal("hide");
            $('#modalShow').modal('show');
            $('#info').html(response.data);
            
        }).catch(function () {
            $('#modalError').modal('show');
        }).then(function () {
            $('#modalCarga').modal("hide");
        });
}

function busquedaAjax(){
    let searchForm = $("#searchForm").serialize();
    $('#busqueda').val();
    axios.post('/books/searchAjax', searchForm)
        .then(function (response) {
            let divMostrarBusqueda = $("#mostrarBusqueda");

            divMostrarBusqueda.empty();
            divMostrarBusqueda.html(response.data);
            console.log(response);
            spinnerShow();
        }).catch(function (error) {
            $('#modalError').modal('show');
            console.log(error);
        }).then(function () {
            spinnerHide()
        });
}

$(function (){
    
    $('#myTabPill a').on('show.bs.tab', function (e){
        let vista = $(e.target).attr("id");
        axios.get(`/miPerfil/${vista}`)
        .then(function (response){
            $("#tabContent").html(response.data);
        })
        .catch(function () {
            $('#modalError').modal('show');
        });
    });
});








