<!-- Content Header -->
<section class="content-header">
    <div class="content-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Egreso de produtos.</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item active">Egreso de productos</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<!-- Content Header -->

<!-- Content -->
<section class="content">
    <div class="container">
        <h1>Red Taller!</h1>
        <div class="row">
            <div class="col-2 offset-10">
                <div class="text-center">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modalegreso" id="botonCrear">
                        <i class="bi bi-plus-circle-fill"></i> Crear
                    </button>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="table-responsive">
            <table id="dt_egreso" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Egreso</th>
                        <th>Descripción</th>
                        <th>Número</th>
                        <th>Cantidad Total</th>
                        <th>Costo Total</th>
                        <th>IVA</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Id Tipo de egreso</th>
                        <th>Tipo  de Egreso</th>
                        <th>Id Estado</th>
                        <th>Estado</th>
                        <th>Editar</th>
                        <th>Detalle</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalegreso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Realizar egreso</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" id="formulario" enctype="multipart/form-data" action="modelos/movimiento/egreso/crear.php">
                    <div class="modal-content">
                        <div class="modal-body"> 
                            <label>Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" maxlength="100">
                            <br>
                            <label>Descripción:</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control" maxlength="999">
                            <br>
                            <label>Número:</label>
                            <input type="number" name="ordencompra" id="ordencompra" class="form-control">
                            <br>
                            <label>Cantidad Total:</label>
                            <input type="number" name="cantidadtotal" id="cantidadtotal" class="form-control">
                            <br>
                            <label>Costo Total:</label>
                            <input type="number" name="costototal" id="costototal" class="form-control">
                            <br>
                            <label>IVA:</label>
                            <input type="number" name="iva" id="iva" class="form-control">
                            <br>
                            <label>Tipo:</label>
                            <select name="idstocktipo" id="idstocktipo" class='form-control'>
                            </select>
                            <br>
                            <label>Estado:</label>
                            <select name="idstockestado" id="idstockestado" class='form-control'>
                            </select>
                            <br>
                        </div>
                        <div class="modal-footer">
                        <input type="hidden" name="id" id="id">
                            <input type="hidden" name="operacion" id="operacion">
                            <button type="sumbit" name="action" id="action" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#botonCrear").click(function() {
                $("#formulario")[0].reset();
                $(".modal-title").text("Realizar egreso");
                $("#action").val("Crear");
                $("#operacion").val("Crear");
            });
            $.ajax({
                url: "modelos/stock/tipo/obtener_registros_lista.php",
                method: "POST",
                dataType: "json",
                success: function(data) {
                    console.log('Crear tipo');
                    console.log(data);
                    $("#idstocktipo").empty();
                    $.each(data, function() {
                        $("#idstocktipo").append($("<option />").val(this.id).text(this.nombre));
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            })
            $.ajax({
                url: "modelos/stock/estado/obtener_registros_lista.php",
                method: "POST",
                dataType: "json",
                success: function(data) {
                    console.log('Crear estado');
                    console.log(data);
                    $("#idstockestado").empty();
                    $.each(data, function() {
                        $("#idstockestado").append($("<option />").val(this.id).text(this.nombre));
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            })

            var dataTable = $('#dt_egreso').DataTable({
                "processing": true,
                "ServerSide": true,
                "order": [],
                "ajax": {
                    url: "modelos/stock/egreso/obtener_registros.php",
                    type: "POST"
                },
                "columnsDefs": [{
                    "targets": [0, 3, 4],
                    "orderable": false,
                }, ]

            });
            //Insertar
            $("#formulario").on('submit', function(event) {
                event.preventDefault();
                var id = $("#id").val();
                var nombre = $("#nombre").val();

                if (nombre != '') {
                    $.ajax({
                        url: "modelos/stock/egreso/crear.php",
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            Swal.fire(
                                'Gracias!',
                                'Para continuar has clic en el botón!',
                                'success'
                            );
                            $('#modalegreso').modal("toggle");
                            dataTable.ajax.reload()
                        }
                    })
                } else {
                    alert("Debe rellenar los campos obligatorios!");
                }
            });

            //Editar
            $(document).on('click', '.editar', function() {
                $.ajax({
                    url: "modelos/stock/tipo/obtener_registros_lista.php",
                    method: "POST",
                    dataType: "json",
                    success: function(data) {
                        console.log('Editar tipo');
                        console.log(data);
                        $("#idstocktipo").empty();
                        $.each(data, function() {
                            $("#idstocktipo").append($("<option />").val(this.id).text(this.nombre));
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                })
                $.ajax({
                    url: "modelos/stock/estado/obtener_registros_lista.php",
                    method: "POST",
                    dataType: "json",
                    success: function(data) {
                        console.log('Editar estado');
                        console.log(data);
                        $("#idstockestado").empty();
                        $.each(data, function() {
                            $("#idstockestado").append($("<option />").val(this.id).text(this.nombre));
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                })

                $.ajax({
                    url: "modelos/stock/egreso/obtener_registro.php",
                    method: "POST",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        $("#modalegreso").modal('show');
                        $(".modal-title").text("Editar egreso");
                        $("#nombre").val(data.nombre);
                        $("#descripcion").val(data.descripcion);
                        $("#ordencompra").val(data.ordencompra);
                        $("#cantidadtotal").val(data.cantidadtotal);
                        $("#costototal").val(data.costototal);
                        $("#iva").val(data.iva);
                        $("#idusuario").val(data.idusuario);
                        $("#fechaegreso").val(data.fechaegreso);
                        $("#idstocktipo").val(data.idstocktipo);
                        $("#idstockestado").val(data.idstockestado);
                        $("#id").val(data.id);
                        $("#action").val("Editar");
                        $("#operacion").val('Editar');       
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                })
            });

            //Eliminar
            $(document).on('click', '.borrar', function() {
                var id = $(this).attr("id");
                if (confirm("Esta seguro de eliminar el egreso?" + id)) {
                    $.ajax({
                        url: "modelos/stock/egreso/borrar.php",
                        method: "POST",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            alert(data);
                            dataTable.ajax.reload();
                        }
                    })
                } else {
                    return false;
                }

            });

        });
    </script>
</section>
<!-- Content -->