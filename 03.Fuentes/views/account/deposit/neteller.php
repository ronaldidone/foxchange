<div class="row">
  <div class="col-md-12 mb-2">
    <h5><?php echo str_replace("Bank",$method,lang('users deposit deposit_bank')); ?></h5>
  </div>
</div>

<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <?php echo "Ingrese a su cuenta de ".$method." y envienos <b>".number_format( ($total_amount+$total_fee), 2, '.', '')." ".$symbol."</b> a cambio recibirás <b>".$amount." ".$symbol."</b>. En la nota de pago coloque el siguiente ID: $id_transaction";  ?>
      </div>
    </div>
  </div>
</div>
<div class="card mt-3">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <strong><label for="swift"><?php echo lang('users deposit deposit_nuestra_cuenta_neteller'); ?></label></strong>
          <textarea class="form-control" id="swift" rows="8" disabled><?php echo $merchant_account ?></textarea>
        </div>
      </div>
      <div class="col-md-12 text-right">
        <a href="<?php echo base_url('account/transactions'); ?>" class="btn btn-success"><?php echo lang('users deposit check'); ?></a>
      </div>
    </div>
  </div>
</div>
      </div>
