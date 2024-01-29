<!-- Content Header -->
<section class="content-header">
    <div class="content-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Proveedores.</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item active">Proveedores</li>
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
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modalProveedor" id="botonCrear">
                        <i class="bi bi-plus-circle-fill"></i> Crear
                    </button>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="table-responsive">
            <table id="dt_proveedor" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Razón social</th>
                        <th>Rut</th>
                        <th>Giro</th>
                        <th>Dirección</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Tipo de proveedor</th>
                        <th>Id Estado</th>
                        <th>Estado</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalProveedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Proveedor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" id="formulario" enctype="multipart/form-data" action="modelos/mae_proveedor/crear.php">
                    <div class="modal-content">
                        <div class="modal-body">
                            <label>Proveedor:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control">
                            <br>
                            <label>Descripción:</label>
                            <input type="text" name="descripcion"  id="descripcion" class="form-control">
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
                $(".modal-title").text("Crear Proveedor");
                $("#action").val("Crear");
                $("#operacion").val("Crear");
            });
            var dataTable = $('#dt_proveedor').DataTable({
                "processing": true,
                "ServerSide": true,
                "order": [],
                "ajax": {
                    url: "modelos/proveedor/mae_proveedor/obtener_registros.php",
                    type: "POST"
                },
                "columnsDefs": [{
                    "targets": [0, 3, 4],
                    "orderable": false,
                }, ]

            });
            //Aquí código de inserción
            $("#formulario").on('submit', function(event) {
                event.preventDefault();
                var id = $("#id").val();
                var nombre = $("#nombre").val();

                if (nombre != '') {
                    $.ajax({
                        url: "modelos/proveedor/mae_proveedor/crear.php",
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            console.log(data);                            
                            Swal.fire(
                            'Gracias!',
                            'Para continuar has clic en el botón!',
                            'success'
                            );
                            $('#modalProveedor').modal("toggle");
                            dataTable.ajax.reload()
                        }
                    })
                } else {
                    alert("Debe rellenar los campos obligatorios!");
                }
            });

            //Editar
            $(document).on('click', '.editar', function(){
                var id = $(this).attr("id");
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
                $.ajax({
                    url:"modelos/proveedor/mae_proveedor/obtener_registro.php",
                    method: "POST",
                    data:{id:id},
                    dataType: "json",
                    success:function(data)
                        {
                            console.log(data);
                            $("#modalProveedor").modal('show');
                            $(".modal-title").text("Editar Proveedor");
                            $("#nombre").val(data.nombre);
                            $("#descripcion").val(data.descripcion);
                            $("#razonsocial").val(data.razonsocial);
                            $("#rut").val(data.rut);
                            $("#giro").val(data.giro);
                            $("#direccion").val(data.direccion);
                            $("#correo").val(data.correo);
                            $("#telefono").val(data.telefono);
                            $("#proveedortipo").val(data.proveedortipo);
                            $("#estado").val(data.estado);
                            $("#id").val(data.id);
                            $("#action").val("Editar");
                            $("#operacion").val('Editar');
                        },
                        error: function(jqXHR, textStatus, errorThrown){
                            console.log(textStatus, errorThrown);
                        }
                })
            });

            //Eliminar
            $(document).on('click', '.borrar', function(){
                var id = $(this).attr("id");
                if(confirm("Esta seguro de eliminar al proveedor?"+id)){
                    $.ajax({
                    url:"modelos/proveedor/mae_proveedor/borrar.php",
                    method: "POST",
                    data:{id:id},
                    success:function(data)
                        {
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