<!-- Content Header -->
<section class="content-header">
    <div class="content-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Mantenedor de productos.</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item active">Productos</li>
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
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modalProducto" id="botonCrear">
                        <i class="bi bi-plus-circle-fill"></i> Crear
                    </button>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="table-responsive">
            <table id="dt_productos" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre del producto</th>
                        <th>Descripcion del producto</th>
                        <th>CodBarra</th>
                        <th>Imagen</th>
                        <th>IdUsuario</th>
                        <th>IdFicha</th>
                        <th>IdTipoCantidad</th>
                        <th>Estado</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" id="formulario" enctype="multipart/form-data" action="modelos/producto/crear.php">
                    <div class="modal-content">
                        <div class="modal-body">
                            <label>Nombre del producto:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" readonly>
                            <br>
                            <label>Categoría:</label>
                            <select name="idCategoria" id="idCategoria">
                            </select>
                            <label>Tipo:</label>
                            <select name="idTipo" id="idTipo">
                            </select>
                            <label>Material:</label>
                            <select name="idMaterial" id="idMaterial">
                            </select>
                            </select>
                            <label>Modelo:</label>
                            <select name="idModelo" id="idModelo">
                            </select>
                            </select>
                            <label>Variación:</label>
                            <select name="idVariacion" id="idVariacion">
                            </select>
                            <br>
                            <label>Descripción del producto:</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control">
                            <br>
                            <label>Código de Barra:</label>
                            <input type="text" name="codBarra" id="codBarra" class="form-control">
                            <br>
                            <label for="imagen">Seleccione una imagen:</label>
                            <input type="file" name="imagen_producto" id="imagen_producto" class="form-control">
                            <span id="imagen"></span>
                            <br>
                            <label>Usuario:</label>
                            <input type="text" name="idUsuario" id="idUsuario" class="form-control">
                            <br>
                            <label>Ficha:</label>
                            <input type="text" name="idFicha" id="idFicha" class="form-control">
                            <br>
                            <label>Tipo de cantidad:</label>
                            <input type="text" name="idTipoCantidad" id="idTipoCantidad" class="form-control">
                            <br>
                            <label>Estado:</label>
                            <select name="idEstado" id="idEstado">
                            </select>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="img" id="img">

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
        //Carga lista de estado
        $(document).on('click', '#botonCrear', function() {
            $.ajax({
                url: "modelos/estado/mae_estado/obtener_registros.php",
                method: "POST",
                dataType: "json",
                success: function(data) {
                    $("#idEstado").empty();
                    $.each(data, function() {
                        $("#idEstado").append($("<option />").val(this.id).text(this.nombre));
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            })
        });

        $(document).ready(function() {
            $("#botonCrear").click(function() {
                $("#formulario")[0].reset();
                $(".modal-title").text("Crear Producto");
                $("#action").val("Crear");
                $("#operacion").val("Crear");
                $("#imagen_subida").html("");
            });
            var dataTable = $('#dt_productos').DataTable({
                "processing": true,
                "ServerSide": true,
                "order": [],
                "ajax": {
                    url: "modelos/producto/mae_producto/obtener_registros.php",
                    type: "POST"
                },
                "columnsDefs": [{
                    "targets": [0, 3, 4],
                    "orderable": false,
                }, ]

            });

            //Categoría, Tipo, Material, Modelo, Variación, Estado, etc.
            $(document).on('click', '#botonCrear', function() {
                //Variación 
                $.ajax({
                    url: "modelos/producto/variacion/obtener_registros_lista.php",
                    method: "POST",
                    dataType: "json",
                    success: function(data) {
                        $("#idVariacion").empty();
                        $.each(data, function() {
                            $("#idVariacion").append($("<option />").val(this.id).text(this.nombre));
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                })
                //Modelo 
                $.ajax({
                    url: "modelos/producto/modelo/obtener_registros_lista.php",
                    method: "POST",
                    dataType: "json",
                    success: function(data) {
                        $("#idModelo").empty();
                        $.each(data, function() {
                            $("#idModelo").append($("<option />").val(this.id).text(this.nombre));
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                })
                //Material 
                $.ajax({
                    url: "modelos/producto/material/obtener_registros_lista.php",
                    method: "POST",
                    dataType: "json",
                    success: function(data) {
                        $("#idMaterial").empty();
                        $.each(data, function() {
                            $("#idMaterial").append($("<option />").val(this.id).text(this.nombre));
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                })
                //Tipo 
                $.ajax({
                    url: "modelos/producto/tipo/obtener_registros_lista.php",
                    method: "POST",
                    dataType: "json",
                    success: function(data) {
                        $("#idTipo").empty();
                        $.each(data, function() {
                            $("#idTipo").append($("<option />").val(this.id).text(this.nombre));
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                })
                //Categoria
                $.ajax({
                    url: "modelos/producto/categoria/obtener_registros_lista.php",
                    method: "POST",
                    dataType: "json",
                    success: function(data) {
                        $("#idCategoria").empty();
                        $.each(data, function() {
                            $("#idCategoria").append($("<option />").val(this.id).text(this.nombre));
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                })
                //Estado
                $.ajax({
                    url: "modelos/estado/mae_estado/obtener_registros.php",
                    method: "POST",
                    dataType: "json",
                    success: function(data) {
                        $("#idEstado").empty();
                        $.each(data, function() {
                            $("#idEstado").append($("<option />").val(this.id).text(this.nombre));
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                })
            });

            //Aquí código de inserción
            $("#formulario").on('submit', function(event) {
                event.preventDefault();
                var id = $("#id").val();
                var nombre = $("#nombre").val();
                var imagen = $("#imagen_producto").val();
                var extension = $("#imagen_producto").val().split('.').pop().toLowerCase();

                if (extension != '') {
                    if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                        alert("Formato de imagen inválida.");
                        $("#imagen_producto").val('');
                        return false
                    }
                }

                if (nombre != '') {
                    //if (nombre != '' && imagen != '') {
                    $.ajax({
                        url: "modelos/producto/crear.php",
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            console.log(data);
                            //$('#formulario')[0].reset();
                            $('#modalProducto').modal("toggle");
                            //dataTable.ajax.reload();
                            dataTable.ajax.reload();
                            Swal.fire(
                                'Gracias!',
                                'Para continuar has clic en el botón!',
                                'success'
                            )
                        }
                    })
                } else {
                    alert("Debe rellenar los campos obligatorios!");
                }
            });

            //Editar
            $(document).on('click', '.editar', function() {
                var id = $(this).attr("id");
                $("#imagen_producto").val(null);
                $.ajax({
                    url: "modelos/producto/mae_producto/obtener_registro.php",
                    method: "POST",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        $("#idCategoria").empty();
                        $.each(data.categoria, function() {
                            $("#idCategoria").append($("<option />").val(this.id).text(this.nombre));
                        });
                        $("#idTipo").empty();
                        $.each(data.tipo, function() {
                            $("#idTipo").append($("<option />").val(this.id).text(this.nombre));
                        });
                        $("#idMaterial").empty();
                        $.each(data.material, function() {
                            $("#idMaterial").append($("<option />").val(this.id).text(this.nombre));
                        });
                        $("#idModelo").empty();
                        $.each(data.modelo, function() {
                            $("#idModelo").append($("<option />").val(this.id).text(this.nombre));
                        });
                        $("#idVariacion").empty();
                        $.each(data.variacion, function() {
                            $("#idVariacion").append($("<option />").val(this.id).text(this.nombre));
                        });
                        $("#idEstado").empty();
                        $.each(data.estados, function() {
                            $("#idEstado").append($("<option />").val(this.id).text(this.nombre));
                        });
                        $("#modalProducto").modal('show');
                        $(".modal-title").text("Editar Producto");
                        $("#nombre").val(data.nombre);
                        $("#descripcion").val(data.descripcion);
                        $("#codBarra").val(data.codBarra);
                        $("#img").val(data.imagen);
                        $("#imagen").html(data.imagen_producto);
                        $("#idUsuario").val(data.idUsuario);
                        $("#idFicha").val(data.idFicha);
                        $("#idTipoCantidad").val(data.idTipoCantidad);

                        $("#idCategoria").val(data.idCategoria);
                        $("#idTipo").val(data.idTipo);
                        $("#idMaterial").val(data.idMaterial);
                        $("#idModelo").val(data.idModelo);
                        $("#idVariacion").val(data.idVariacion);

                        $("#idEstado").val(data.idEstado);
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
                if (confirm("Esta seguro de borrar el producto?" + id)) {
                    $.ajax({
                        url: "modelos/producto/mae_producto/borrar.php",
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

            $(document).on('click', '#idCategoria', function() {
                //CATEGORIA DE PRODUCTO	TIPO DE PRODUCTO	Material	MODELO	VARIACION
                $("#nombre").val("");
                var categoria = $("#idCategoria option:selected").text();
                var tipo = $("#idTipo option:selected").text();
                var material = $("#idMaterial option:selected").text();
                var modelo = $("#idModelo option:selected").text();
                var variacion = $("#idVariacion option:selected").text();
                $("#nombre").val(categoria + " - " + tipo + " " + material + " " + modelo + " " + variacion);
            });

            $(document).on('click', '#idTipo', function() {
                $("#nombre").val("");
                var categoria = $("#idCategoria option:selected").text();
                var tipo = $("#idTipo option:selected").text();
                var material = $("#idMaterial option:selected").text();
                var modelo = $("#idModelo option:selected").text();
                var variacion = $("#idVariacion option:selected").text();
                $("#nombre").val(categoria + " - " + tipo + " " + material + " " + modelo + " " + variacion);
            });

            $(document).on('click', '#idMaterial', function() {
                $("#nombre").val("");
                var categoria = $("#idCategoria option:selected").text();
                var tipo = $("#idTipo option:selected").text();
                var material = $("#idMaterial option:selected").text();
                var modelo = $("#idModelo option:selected").text();
                var variacion = $("#idVariacion option:selected").text();
                $("#nombre").val(categoria + " - " + tipo + " " + material + " " + modelo + " " + variacion);
            });

            $(document).on('click', '#idModelo', function() {
                $("#nombre").val("");
                var categoria = $("#idCategoria option:selected").text();
                var tipo = $("#idTipo option:selected").text();
                var material = $("#idMaterial option:selected").text();
                var modelo = $("#idModelo option:selected").text();
                var variacion = $("#idVariacion option:selected").text();
                $("#nombre").val(categoria + " - " + tipo + " " + material + " " + modelo + " " + variacion);
            });

            $(document).on('click', '#idVariacion', function() {
                $("#nombre").val("");
                var categoria = $("#idCategoria option:selected").text();
                var tipo = $("#idTipo option:selected").text();
                var material = $("#idMaterial option:selected").text();
                var modelo = $("#idModelo option:selected").text();
                var variacion = $("#idVariacion option:selected").text();
                $("#nombre").val(categoria + " - " + tipo + " " + material + " " + modelo + " " + variacion);
            });

        });
    </script>
</section>
<!-- Content -->