<!-- formulario de busqueda de codigo de barra -->
<?php
$this->load->view('css-js');
$this->load->view('header');
$this->load->view('menu');
?>
<div class="mainy">
    <div class="page-title">
        <h2><i class="glyphicon glyphicon-search" style="font-size: 25px;"></i><small>Buscar Codigo Barra</small></h2><br>
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>Tarjeta">Inicio</a></li>
            <li class="active">Buscar Información Codigo Barra</li>
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
                <h3 class="modal-title"><i class="glyphicon glyphicon-credit-card"></i>&nbsp;Buscar Información Codigo Barra</h3>
            </div>
            <div class="awidget">
                <div class="awidget-body" id="usuarios_sistema">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" id="busca" action="<?= base_url() ?>Tarjeta/buscacodigo" onsubmit="return validaForm();">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="query">Codigo Barra</label>
                                    <div class="col-md-4">
                                        <input id="query" name="query" class="form-control input-md" type="text" placeholder="12345678901" maxlength="12"><br />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="buscacodigo"></label>
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
    echo '<th scope="col" style="width: 200px; ">Codigo Barra</th>';
    echo '<th scope="col">Codigo Mifare</th>';
    echo '</thead>';
    echo '<tbody>';
    foreach ($cards->result() as $row) {
        echo '<tr>';
        echo '<td>' . $row->CODIGO_BARRA. '</td>';
        echo '<td>' . $row->COD_MIFARE . '</td>';
        echo '</tr>';
    }
    echo '<tbody>';
    echo '<center>';
    echo '</table>';
}
?>
                                                <center>
                                        </table>
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
<?php
$this->load->view('footer');
?>
<script type="text/javascript">
    function validaForm() {
        var query = document.getElementById("query").value;

        if (query.length == '' || query.length == 12) {
            alert('Ingrese un codigo de barra valido de 12 caracteres');
            return false;
        }

        $('#buscaCodigo').submit(function() {
            $(this).find('input:text').each(function() {
                $(this).val($.trim($(this).val()));
            });
        });

    }
</script>