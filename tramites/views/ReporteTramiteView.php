<table>
    <tr>
        <td align="right"><img src="../servidor/img/logopuce.jpg" alt="Logo PUCE" style = "width:176px;  height:50px;"></td>
        <td align="left"><img src="../servidor/img/sistra-imp.jpg" alt="Logo Sistra" style = "width:108px;  height:48px;"></td>
    </tr>
</table>
<h3 style="text-align:center">Solicitud de Trámite o Pago </h3>
<hr>
<table width="100%">
    <tr>
        <td>
            <div>
                <b>Número Documento: </b>
                <?php echo $resultados[0]['TRA_CODIGO'];?>
            </div>
        </td>
        <td>
            <div>
                <b>Oficio N°:</b>
                <?php echo $resultados[0]['TRA_OFICIO'];?>
            </div>
        </td>
    </tr>
</table>
<hr>
<table>
    <tr>
        <td><b>Fecha:</b></td>
        <td><?php echo substr((string)$resultados[0]['TRA_FECHA'],0,10);?></td>
    </tr>

    <tr>
        <td><b>Unidad Solicitante:</b></td>
        <td><?php echo $resultados[0]['UND_CODIGO'];?></td>
    </tr>
    <tr>
        <td><b>Unidad del Gasto:</b></td>
        <td><?php echo $resultados[0]['TRA_GASTO'];?></td>
    </tr>
    <tr>
        <td><b>Asunto:</b></td>
        <td><?php echo $resultados[0]['ASU_CODIGO'];?></td>
    </tr>
    <tr>
        <td><b>Beneficiario(s):</b></td>
    </tr>
</table>
<br>
<table><!--Beneficiarios-->
    <tr>
        <td><?php echo $resultados[0]['TRA_BENEFICIARIO1'];?></td>
        <td><?php echo $resultados[0]['TRA_CEDULA1'];?></td>
    </tr>
    <tr>
        <td><?php echo $resultados[0]['TRA_BENEFICIARIO2'];?></td>
        <td><?php echo $resultados[0]['TRA_CEDULA2'];?></td>
    </tr>
</table>
<br>
<br>
<table>
    <tr>
        <td><b>Valor:</b></td>
        <td><?php echo $resultados[0]['TRA_VALOR'];?></td>
    </tr>
    <tr>
        <td><b>Elemento PEP/Partida Presupuestaria:</b></td>
        <td><?php echo $resultados[0]['TRA_PROYECTO'];?></td>
    </tr>
    <tr>
        <td><b>Reserva:</b></td>
        <td><?php echo $resultados[0]['TRA_COMPROMISO'];?></td>
    </tr>
    <tr>
        <td><b>Posición:</b></td>
        <td><?php echo $resultados[0]['TRA_POSICION'];?></td>
    </tr>
    <tr>
        <td><b>Detalle de Facturas:</b></td>
        <td><?php echo $resultados[0]['TRA_DETALLE_FACTURA'];?></td>
    </tr>
</table>



<br>
<hr>
<b>Descripción del Pedido:</b>
<?php echo $resultados[0]['TRA_DESCRIPCION'];?>
<br>
<hr>
<br>

<?php if(($resultados[0]['TRA_FECHA_VIAJE_VIATICO'] != null)) : ?>
    <table>
        <tr>
            <td><b>Fecha de Desplazamiento:</b></td>
            <td><?php echo $resultados[0]['TRA_FECHA_VIAJE_VIATICO'];?></td>
        </tr>
        <tr>
            <td><b>Fecha de retorno:</b></td>
            <td><?php echo $resultados[0]['TRA_FECHA_VIAJE_FIN_VIATICO'];?></td>
        </tr>
        <tr>
            <td><b>Destino:</b></td>
            <td><?php echo $resultados[0]['TRA_DESTINO_VIATICO'];?></td>
        </tr>
        <tr>
            <td><b>Persona Responsable:</b></td>
            <td><?php echo $resultados[0]['TRA_RESPONSABLE_VIATICO'];?></td>
        </tr>
        <tr>
            <td><b>Personas Adicionales:</b></td>
            <td><?php echo $resultados[0]['TRA_PERSONAS_ADIC_VIATICO'];?></td>
        </tr>
        <tr>
            <td><b>Observaciones:</b></td>
            <td><?php echo $resultados[0]['TRA_OBSERV_VIAJE_VIATICO'];?></td>
        </tr>
    </table>
<?php endif; ?>

<table width="100%">
    <tr>
        <td>
            <div>
                Atentamente
                <br>
                <br>
                <br>
                <br>
                <br>
                <?php echo $resultados[0]['TRA_PERSONA_AUTORIZA'];?>
                <br>
                Firma Autorizada
                <br>
                Teléfono/Extensión:
                <?php echo $resultados[0]['TRA_TELEFONO'];?>
            </div>
        </td>
        <td>
            <div>
                <img style="float:right;" src="../servidor/img/selloDGF.jpg" alt="Sello DGF" width="209" height="116">
            </div>
        </td>
    </tr>
</table>


