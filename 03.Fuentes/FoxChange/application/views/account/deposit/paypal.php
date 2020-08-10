<div class="row">
  <div class="col-md-12 mb-2">
    <h5><?php echo str_replace("Bank",$method,lang('users deposit deposit_bank')); ?></h5>
  </div>
</div>

<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <?php echo "Ingrese a su cuenta de ".$method." y envienos <b>".number_format( ($total_amount+$total_fee), 2, '.', '')." ".$symbol."</b> a cambio recibiras <b>".$amount." ".$symbol."</b>. 
        IMPORTANTE En la nota de pago de Paypal coloque el siguiente texto + el ID de transaccion. <b>Pago por Servicio/Contenido Digital, NO ES UN PRODUCTO FISICO, soy consiente que este servicio no tiene devolucion ni reembolso, 
        segun se ha acordado entre ambas partes. ID: $id_transaction.</b> En Direccion de Envio seleccione <b>No se necesita direccion.<b>";  ?>
      </div>
    </div>
  </div>
</div>
<div class="card mt-3">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <strong><label for="swift"><?php echo lang('users deposit deposit_nuestra_cuenta_paypal'); ?></label></strong>
          <textarea class="form-control" id="swift" rows="8" disabled><?php echo $merchant_account ?></textarea>
        </div>
      </div>
      <div class="col-md-12 text-right">
        <a href="<?php echo base_url('account/transactions'); ?>" class="btn btn-success"><?php echo lang('users deposit check'); ?></a>
      </div>
    </div>
  </div>
</div>