<!-- <input type="hidden" name="idregistro" id="idregistro" value="<?php //echo $id; ?>"> -->
            
<?php
//debuguear($tblpaciente);
?>
            <label for="Fecha">FECHA</label>
            <input type="text" name="Fecha" id="Fecha" readonly="readonly" value="<?php echo date('y-m-d h:i:s'); ?>">

            <label for="tblPersonal_id">Medico</label>
            <select name="tblpaciente[tblPersonal_id]" id="tblPersonal_id">
            <option value="">-- Seleccione --</option>

            <?php
            foreach($tblPersonal as $row) : ?>
                <option <?php echo $tblPersonal_id === strval($row->id) ? 'selected' : '' ?> value="<?php echo $row->id; ?>"><?php echo $row->cNombre; ?></option>
            <?php endforeach; ?>
            </select>

            <label for="cUnidadMedica">Unidad Medica</label>
            <input type="text" name="cUnidadMedica" id="cUnidadMedica" value="C. S. SAN JOSE BUENAVISTA" readonly="readonly">

            <label for="cNumExpediente">Numero Expediente</label>
            <input type="text" name="tblpaciente[cNumExpediente]" id="cNumExpediente" placeholder="Numero Expediente" value = "<?php echo s( $tblpaciente->cNumExpediente ); ?>">

            <label for="cNombre">Nombre</label>
            <input type="text" name="tblpaciente[cNombre]" id="cNombre" placeholder="Nombre" value = "<?php echo s( $tblpaciente->cNombre ); ?>">

            <label for="cPaterno">Apellido Paterno</label>
            <input type="text" name="tblpaciente[cPaterno]" id="cPaterno" placeholder="Apellido Paterno" value = "<?php echo s( $tblpaciente->cPaterno ); ?>">
            
            <label for="cMaterno">Apellido Materno</label>
            <input type="text" name="tblpaciente[cMaterno]" id="cMaterno" placeholder="Apellido Materno" value = "<?php echo s( $tblpaciente->cMaterno ); ?>">
            
            <label for="dFechaNacimiento">Fecha de Nacimiento</label>
            <input type="date" name="tblpaciente[dFechaNacimiento]" id="dFechaNacimiento" placeholder="dd-mm-yyyy" value="<?php echo date("Y-m-d", strtotime($tblpaciente->dFechaNacimiento)); ?>">

            <label for="cCURP">CURP</label>
            <input type="text" name="tblpaciente[cCURP]" id="cCURP" placeholder="CURP" value = "<?php echo s( $tblpaciente->cCURP ); ?>">
            <!-- <input type="submit" value="Obtener CURP" class="boton-verde-block"> -->
            <select name="tblpaciente[cGenero]">
                <option value="">-- Seleccione --</option>
                <option <?php echo $tblpaciente->cGenero === "H" ? 'selected' : '' ?> value="H">Hombre</option>
                <option <?php echo $tblpaciente->cGenero === "M" ? 'selected' : '' ?> value="M">Mujer</option>
            </select>
