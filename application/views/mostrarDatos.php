<?php
$this->load->view('headers/menu');
?>
<div class="container">
    <br />
       <h3 align="center">Mostrar Datos </h3>
    <br/>
    <center><table class="uc-table">
        <thead>

            <th style="width: 300px;">Codigo Mifare</th>
            <th>Codigo Barra</th>

        </thead>
        <tbody>
            <?php
            if (!isset($mifarecodBarra)) {
                $mifarecodBarra = '';
            }
            if ($mifarecodBarra != False) {

                foreach ($mifarecodBarra->result() as $row) {
                    echo "<tr>";
                    echo "<td>" . $row->cod_mifare . "</td>";
                    echo "<td>" . $row->codigo_barra . "</td>";
                    echo "</tr>";
                }
            } else {
                echo 'No hay registros disponibles';
            }

            ?>
           
        </tbody>
        </center>
    </table>
      
</div>
<?php
$this->load->view('footer');
?>


       