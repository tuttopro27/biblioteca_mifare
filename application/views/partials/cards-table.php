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
                                    if (!isset($mifarecodBarra)) {
                                        $mifarecodBarra = '';
                                    }
                                    if ($mifarecodBarra != False) {

                                        foreach ($mifarecodBarra->result() as $row) {
                                            echo "<tr>";
                                            echo "<td>" . $row->COD_MIFARE . "</td>";
                                            echo "<td>" . $row->CODIGO_BARRA . "</td>";
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