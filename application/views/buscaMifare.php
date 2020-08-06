<?php
// Archivos de plantilla
$this->load->view('css-js');
$this->load->view('header');
$this->load->view('menu');
?>

<div class="mainy">
    <div class="page-title">
        <h2><i class="glyphicon glyphicon-search" style="font-size: 25px;"></i><small>Buscar Codigo Mifare</small></h2><br>
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>Tarjeta">Inicio</a></li>
            <li class="active">Buscar Información Codigo Mifare</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-13" align="left">
                    <form class="form-inline" action="/action_page.php">
                        <div class="form-group">
                            <table class="tg">
                                <tr>
                                </tr>

                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div align="left">
                <h3 class="modal-title"><i class="glyphicon glyphicon-credit-card"></i>&nbsp;Buscar Información codigo Mifare</h3>
            </div>
            <div class="awidget">
                <div class="awidget-body" id="busqueda_mifare">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" id="buscamifare" name="buscamifare" action="<?= base_url() ?>tarjeta/buscaMifare" onsubmit="return validaForm();">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="query">Codigo Mifare</label>
                                    <div class="col-md-4">
                                        <input id="query" name="query" class="form-control input-md" type="text" placeholder="00FF6587" maxlength="8" required><br />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="btnGuardar"></label>
                                    <div class="col-md-10">
                                        <br>
                                        <center><button type="submit" id="buscacodigo" class="btn btn-success">Buscar Codigo</input></center>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                        </div>
                        </form>
                        <br>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="table-responsive">
                                    <br>
                                    <?php
                                    if (!isset($cards)) {
                                        $cards = '';
                                        //echo "Esta variable no está definida, y la defino como vacia";
                                    }
                                    if ($cards) {
                                        echo '<center><table class="table table-bordered table-hover">';
                                        echo '<thead>';
                                        echo '<th scope="col" style="width: 200px; ">Codigo Mifare</th>';
                                        echo '<th scope="col">Codigo Barra</th>';
                                        echo '</thead>';
                                        echo '<tbody>';
                                        foreach ($cards->result() as $row) {
                                            echo '<tr>';
                                            echo '<td>' . $row->COD_MIFARE . '</td>';
                                            echo '<td>' . $row->CODIGO_BARRA . '</td>';
                                            echo '</tr>';
                                        }
                                        echo '<tbody>';
                                        echo '</table>';
                                        echo '</center>';
                                    }
                                    ?>
                                        <br />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
</div>
<?php
$this->load->view('footer');
?>
<script type="text/javascript">
    function validaBusqueda() {
        var query = document.getElementById("query").value;
        if (query.length == 0 || query.length < 9) {
            alert('Ingrese un codigo de tarjeta mifare valirdo, que tenga 8 caracteres');
            return false;
        }
    }
    $('#buscamifare').submit(function() {
        $(this).find('input:text').each(function() {
            $(this).val($.trim($(this).val()));
        });
    });
</script>