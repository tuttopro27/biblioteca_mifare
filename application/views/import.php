<?php
$this->load->view("css-js");
$this->load->view('header');
$this->load->view('menu');
?>
<div class="mainy">
    <div class="page-title">
        <h2><i class="glyphicon glyphicon-upload" style="font-size: 25px;"></i><small>Subir archivos </small></h2><br>
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>Tarjeta">Inicio</a></li>
            <li class="active">Subir Archibos</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div align="left">

                    <div id="pageloader">
                        <center><img src="http://cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif" alt="processing..." /></center>
                    </div>

                </div>
            </div>
            <div class="awidget">
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                
                <div class="awidget-body" style="padding:0px;">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" name="subirarchivo" id="import_form" enctype="multipart/form-data" method="post" action="/biblioteca_mifare/import/importFile">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Subir Archivos Excel</label>
                                    <div class="col-md-6">
                                        <input name="uploadFile" class="form-control input-md" id="uploadFile" type="file" />
                                            <input type="hidden" name="dato" value="valor">
                                        <input type="submit" name="submit" id="btn_upload" class="btn btn-success" value="upload"/>
                                    </div>
                                    <div id="respuesta" class="alert"></div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="awidget">
                <div class="awidget-body" style="padding:0px;">
                    <div class="row">
                        <div class="col-md-12" id="upload-file-wrapper">
                            <table id="upload_file" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Codigo Mifare</th>
                                        <th>Codigo Barra</th>
                                        <!--<th>Seleccionar</th>
                                <th>Acción</th> -->

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(count($tarjetas) > 0){
                                        foreach ($tarjetas as $tarjeta) {
                                            echo "<tr>";
                                            echo "<td>" . $tarjeta["COD_MIFARE"] . "</td>";
                                            echo "<td>" . $tarjeta["CODIGO_BARRA"] . "</td>";
                                           
                                            
                                            //echo "<td> <input type='checkbox' name='cb-seleccionar'/></td> \n";
                                            //echo "<td> <input type='submit' name='Submit' value='Actualizar'/></td> \n";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo 'No hay registros disponibles';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br />

        <script type="text/javascript">
        function createTable(){
            $('#upload_file').DataTable({
                language: {
                    "lengthMenu": "Mostrar _MENU_ registros por pagina",
                    "zeroRecords": "No se encontraron resultados en su busqueda",
                    "searchPlaceholder": "Buscar registros",
                    "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
                    "infoEmpty": "No existen registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "search": "Buscar:",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                },
                "pageLength": 100
            });            
        }
        createTable();
        </script>
        <script type="text/javascript">
                     $("#import_form").on("submit", function (e){
                        //console.log("envio archivo al server");
                        event.preventDefault();
                        var formData = new FormData($('#import_form')[0]);
                        formData.append('uploadFile', $('input[type=file]')[0].files[0]);
                        console.log(formData);
                        $.post({
                            url: "/biblioteca_mifare/import/importFile",
                            data: formData,
                            contentType: false,
                            cache: false,
                            processData: false,
                            dataType: "json",
                            success: function(respuesta) {
                            console.log(respuesta);
                            var No_Insertados='';
                            if(respuesta.No_Insertados.length>0)
                            {
                                respuesta.No_Insertados.forEach(function (registro){
                                    No_Insertados+= registro.codigo;
                                    No_Insertados+= "->";
                                    No_Insertados+= registro.description;
                                    No_Insertados+= "\n";
                                });
                            
                            }
                            alert(respuesta.message + "\n" + No_Insertados);
                           
                            $('#upload-file-wrapper').load('/biblioteca_mifare/import/getCardsTable',function(){
                                console.log('la tabla fue recargada');
                                createTable();

                            });
                             
                            },
                            error: function (xhr, status, errorThrown)
                            { 
                                alert(xhr.responseText);
                            }
                        });
                    });
                </script>
               
        <?php
        $this->load->view('footer');
        ?>
    </div>