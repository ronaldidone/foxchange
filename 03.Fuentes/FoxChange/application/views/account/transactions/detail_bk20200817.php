<?php
  $label_check = mb_strimwidth($transactions['label'], 0, 3);
  if ($label_check == "blc") {
    $blockchain_type = '1';
  } else {
    $blockchain_type = '2';
  }
?>
<div class="row">
  <div class="col-md-4 mb-2">
    <h5><?php echo lang('users history detail'); ?> <?php echo lang('users trans id'); ?> <?php echo $transactions['id'] ?></h5>
  </div>
  <div class="col-md-4 mb-2 text-right">
  <?php if($transactions['status'] == 1 or $transactions['status'] == 7): ?>
    <div class="btn-group" role="group" aria-label="Basic example">
      <a href="<?php echo base_url('account/transactions/detail/'.$transactions['id']); ?>" class="btn btn-outline-secondary btn-sm"><i class="icon-info icons"></i> <?php echo lang('users cashier details trans'); ?></a>
      <a href="<?php echo base_url('account/transactions/chat/'.$transactions['id']); ?>" class="btn btn-outline-secondary btn-sm"><i class="icon-bubbles icons"></i> <?php echo lang('users cashier chat trans'); ?></a>
      <a href="<?php echo base_url('account/transactions/'); ?>" class="btn btn-outline-secondary btn-sm"><i class="icon-close icons"></i> <?php echo lang('users cashier cancel trans'); ?></a>      
    </div>
  <?php else: ?> &nbsp;
  <?php endif; ?>
  </div>
  <div class="col-md-4 mb-2 text-right">
    <?if($transactions['type'] != 2 & $transactions['type'] != 4){?>
        <?if($user['email'] == $transactions['sender']){?>
          <?if($dispute_mode == 1){?>
    <a href="#" data-toggle="modal" data-target="#dispute" class="btn btn-outline-danger btn-sm"><?php echo lang('users history open_dispute'); ?></a>
    <?}else{?>
          <?}?>
        <?}else{?>
        <?}?>
        <?}else{?>
        <?}?>
  </div>
</div>

<?php if ($transactions['protect'] != "none" & $transactions['status'] == 1 & $transactions['receiver'] == $user['email']) : ?>
<div class="row">
  <div class="col-md-12 mb-3">
    <div class="card text-white bg-primary">
      <div class="card-body">
        <div class="row">
          <div class="col-md-9">
            <p class="card-text"><?php echo lang('users transfer info_receiver'); ?></p>
          </div>
          <div class="col-md-3">
            <div class="btn-group mt-2" role="group" aria-label="Basic example">
              <button type="button" data-toggle="collapse" data-target="#protect" aria-expanded="false" aria-controls="protect" class="btn btn-outline-light"><?php echo lang('users transfer enter_code'); ?></button>
              <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#refund"><?php echo lang('users transfer refund'); ?></button>
            </div>
          </div>
          <div class="col-md-12 mt-3">
            <div class="collapse" id="protect"> 
              <?php echo form_open(site_url("account/transactions/protect_confirm/"), array("" => "")) ?>
              <?php if (isset($transactions['id'])) : ?>
                <?php echo form_hidden('id', $transactions['id']); ?>
              <?php endif; ?>
              <div class="row">
                <div class="col-md-12">
                    <label><?php echo lang('users transfer code_protect'); ?></label>
                    <input type="text" class="form-control" name="code_protect" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" placeholder="1234" maxlength="4">
                    <small class="form-text text-white"><?php echo lang('users transaction protect_activate'); ?></small>
                </div>
                <div class="col-md-12 text-right">
                  <button type="submit" class="btn btn-success"><?php echo lang('users transfer protect_confirm'); ?></button>
               </div>
              </div>
              <?php echo form_close(); ?> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if($transactions['type']==1 and $transactions["status"]==7):?>
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="form-group col-md-12">
         <label for="date"><strong>INSTRUCCIONES PARA ENVIAR FONDOS</strong></label>        
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-12">
         <label for="date"><strong>1.</strong> Debes ir a <?php echo $transactions['deposit_method'] ?> y realizar la siguiente transferencia:</label>               
      </div>      
    </div>
    <div class="row">
      <div class="form-group col-md-1">
         &nbsp;               
      </div>   
      <div class="form-group col-md-11">
         <label for="date"><strong><?php echo lang('users trans cantidad'); ?>:</strong></label>
         
           <?php echo $transactions['amount_deposit'] ?> 
           <?php echo ($transactions["currency"]=='debit_base')?$this->currencys->display->base_code:""; ?>
           <?php echo ($transactions["currency"]=='debit_extra1')?$this->currencys->display->extra1_code:""; ?>
           <?php echo ($transactions["currency"]=='debit_extra2')?$this->currencys->display->extra2_code:""; ?>
           <?php echo ($transactions["currency"]=='debit_extra3')?$this->currencys->display->extra3_code:""; ?>
           <?php echo ($transactions["currency"]=='debit_extra4')?$this->currencys->display->extra4_code:""; ?>
           <?php echo ($transactions["currency"]=='debit_extra5')?$this->currencys->display->extra5_code:""; ?>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-1">
         &nbsp;               
      </div>  
      <div class="form-group col-md-11">
         <label for="date"><strong>Nombre:</strong></label>         
           <?php echo $user_kshr['first_name']." ".$user_kshr["last_name"]; ?>           
      </div>   
    </div>
    <div class="row">
      <div class="form-group col-md-1">
         &nbsp;               
      </div>  
      <div class="form-group col-md-11">
         <label for="date"><strong>Cuenta:</strong></label>         
           <?php echo $account_usr_kshr['cashier_account']; ?>           
      </div>   
    </div>
    <div class="row">
      <div class="form-group col-md-12">
         <label for="date"><strong>2.</strong> Una vez realizado, ingresa el id de referencia de confirmación de <?php echo $transactions['deposit_method'] ?> en el campo de texto y confirma el envío:</label>               
      </div>      
    </div>
    <div class="row">
      <div class="form-group col-md-1">
         &nbsp;               
      </div>  
      <div class="form-group col-md-11">
        <?php echo form_open(site_url("account/transactions/confirmdep/".$transactions["id"]), array("" => "")) ?>
            <label for="date"><strong>Id de confirmación <?php echo $transactions['deposit_method'] ?>:</strong></label>         
           <input type="text" id="idcdep"  class="form-control" name="iddep" value="<?php echo $transactions['id_deposit_cashier'] ?>" <?php echo ($transactions['id_deposit_cashier']!='')?"disabled":""; ?> /> 
           <?php if($transactions['id_deposit_cashier']==''): ?>
           <button type="submit" class="btn btn-success"><?php echo lang('users transfer protect_confirm'); ?></button>
           <?php endif; ?>
        <?php echo form_close(); ?>          
      </div> 
    </div>
  </div>
</div>
<?php endif; ?>




<div class="card">
  <div class="card-body">
    <div class="row">
              <?if($transactions['type']==1){?>
      <div class="form-group col-md-4">
         <label for="date"><strong><?php echo lang('users history id_trans'); ?></strong></label>
         <p class="form-control-static"><?php echo $transactions['id'] ?>
</p>
      </div>
<?}else{?>
                 <?}?>
      <div class="form-group col-md-4">
         <label for="date"><strong><?php echo lang('users trans date'); ?></strong></label>
         <p class="form-control-static"><?php echo $transactions['time'] ?></p>
      </div>
      <div class="form-group col-md-4">
         <label for="date"><strong><?php echo lang('users trans type'); ?></strong></label>
         <p class="form-control-static"><?if($transactions['type']==1){?>
                 <?php echo lang('users trans deposit'); ?>
                 <?}else{?>
                 <?}?>
                 <?if($transactions['type']==2){?>
                      <?php echo lang('users trans retiro'); ?>
                 <?}else{?>
                 <?}?>
                 <?if($transactions['type']==3){?>
                      <?php echo lang('users trans transfer'); ?>
                 <?}else{?>
                 <?}?>
                 <?if($transactions['type']==4){?>
                      <?php echo lang('users trans exchange'); ?>
                 <?}else{?>
                 <?}?>
                 <?if($transactions['type']==5){?>
                      <?php echo lang('users trans external'); ?>
                 <?}else{?>
                 <?}?></p>
      </div>
      <div class="form-group col-md-4">
         <label for="date"><strong><?php echo lang('users trans status'); ?></strong></label>
         <p class="form-control-static">
                      <?php if($transactions["status"]==1): ?>
                        <span class="badge badge-primary"> <?php echo lang('users trans pending'); ?> </span>
                      <?php endif; ?>
                      <?php if($transactions["status"]==2): ?>
                        <span class="badge badge-success"> <?php echo lang('users trans success'); ?> </span>
                      <?php endif; ?>
                      <?php if($transactions["status"]==3): ?>
                        <span class="badge badge-secondary"> <?php echo lang('users trans refund'); ?> </span>
                      <?php endif; ?>
                      <?php if($transactions["status"]==4): ?>
                        <span class="badge badge-danger"> <?php echo lang('users trans dispute'); ?> </span>
                      <?php endif; ?>
                      <?php if($transactions["status"]==5): ?>
                        <span class="badge badge-secondary"> <?php echo lang('users trans blocked'); ?> </span>
                      <?php endif; ?>
                      <?php if($transactions["status"]==6): ?>
                        <span class="badge badge-cancelled"> <?php echo lang('users trans cancelled'); ?> </span>
                      <?php endif; ?>
                      <?php if($transactions["status"]==7): ?>
                        <span class="badge badge-primary"> <?php echo lang('users trans accepted'); ?> </span>
                      <?php endif; ?>
      </div>

                  
      <?if($transactions['type']==3){?>
      <div class="form-group col-md-4">
         <label for="date"><strong><?php echo lang('users trans cantidad'); ?></strong></label>
          <p class="form-control-static"><?php echo $transactions['amount'] ?> 
          <?php echo ($transactions["currency"]=='debit_base')?$this->currencys->display->base_code:""; ?>
           <?php echo ($transactions["currency"]=='debit_extra1')?$this->currencys->display->extra1_code:""; ?>
           <?php echo ($transactions["currency"]=='debit_extra2')?$this->currencys->display->extra2_code:""; ?>
           <?php echo ($transactions["currency"]=='debit_extra3')?$this->currencys->display->extra3_code:""; ?>
           <?php echo ($transactions["currency"]=='debit_extra4')?$this->currencys->display->extra4_code:""; ?>
           <?php echo ($transactions["currency"]=='debit_extra5')?$this->currencys->display->extra5_code:""; ?>      
        </p></p>
      </div>
      <?}else{?>
       <?}?>
       
       <?if($transactions['type']==1){?>
      <div class="form-group col-md-4">
         <label for="date"><strong><?php echo lang('users trans amount_deposit'); ?></strong></label>
          <p class="form-control-static"><?php echo $transactions['amount_deposit'] ?> 
            <?php echo ($transactions["currency"]=='debit_base')?$this->currencys->display->base_code:""; ?>
           <?php echo ($transactions["currency"]=='debit_extra1')?$this->currencys->display->extra1_code:""; ?>
           <?php echo ($transactions["currency"]=='debit_extra2')?$this->currencys->display->extra2_code:""; ?>
           <?php echo ($transactions["currency"]=='debit_extra3')?$this->currencys->display->extra3_code:""; ?>
           <?php echo ($transactions["currency"]=='debit_extra4')?$this->currencys->display->extra4_code:""; ?>
           <?php echo ($transactions["currency"]=='debit_extra5')?$this->currencys->display->extra5_code:""; ?> 
          
        </p></p>
      </div>
      <?}else{?>
       <?}?>
      
            <?if($transactions['type']==2){?>
      <div class="form-group col-md-4">
         <label for="date"><strong><?php echo lang('users trans amount_withdraw'); ?></strong></label>
         <p class="form-control-static"><?php echo $transactions['amount_withdraw'] ?><?if($transactions['currency']=='debit_base'){?>
                      <?php echo $this->currencys->display->base_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($transactions['currency']=='debit_extra1'){?>
                      <?php echo $this->currencys->display->extra1_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($transactions['currency']=='debit_extra2'){?>
                      <?php echo $this->currencys->display->extra2_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($transactions['currency']=='debit_extra3'){?>
                      <?php echo $this->currencys->display->extra3_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($transactions['currency']=='debit_extra4'){?>
                      <?php echo $this->currencys->display->extra4_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($transactions['currency']=='debit_extra5'){?>
                      <?php echo $this->currencys->display->extra5_code ?>
                  <?}else{?>
                  <?}?></p></p>
      </div>
      <?}else{?>
       <?}?>
      
      <div class="form-group col-md-4">
         <label for="date"><strong><?php echo lang('users trans fee'); ?></strong></label>
         <p class="form-control-static">
           
           <?php echo $this->notice->check_fee_transaction($transactions['sum'], $transactions['amount'], $transactions['fee'], $transactions['sender'], $transactions['receiver'], $transactions['type'], $user['email'], $transactions['id']); ?> <?if($transactions['currency']=='debit_base'){?>
                      <?php echo $this->currencys->display->base_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($transactions['currency']=='debit_extra1'){?>
                      <?php echo $this->currencys->display->extra1_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($transactions['currency']=='debit_extra2'){?>
                      <?php echo $this->currencys->display->extra2_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($transactions['currency']=='debit_extra3'){?>
                      <?php echo $this->currencys->display->extra3_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($transactions['currency']=='debit_extra4'){?>
                      <?php echo $this->currencys->display->extra4_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($transactions['currency']=='debit_extra5'){?>
                      <?php echo $this->currencys->display->extra5_code ?>
                  <?}else{?>
                  <?}?>
                
        </p>
      </div>
      
<?if($transactions['type']==1){?>
      <div class="form-group col-md-4">
         <label for="date"><strong><?php echo lang('users trans amount_received_withdraw'); ?></strong></label>
         <p class="form-control-static"><?php echo $transactions['amount_received_deposit'] ?><?if($transactions['currency']=='debit_base'){?>
                      <?php echo $this->currencys->display->base_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($transactions['currency']=='debit_extra1'){?>
                      <?php echo $this->currencys->display->extra1_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($transactions['currency']=='debit_extra2'){?>
                      <?php echo $this->currencys->display->extra2_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($transactions['currency']=='debit_extra3'){?>
                      <?php echo $this->currencys->display->extra3_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($transactions['currency']=='debit_extra4'){?>
                      <?php echo $this->currencys->display->extra4_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($transactions['currency']=='debit_extra5'){?>
                      <?php echo $this->currencys->display->extra5_code ?>
                  <?}else{?>
                  <?}?></p></p>
      </div>
      <?}else{?>
       <?}?>
      
      <?if($transactions['type']==2){?>
      <div class="form-group col-md-4">
         <label for="date"><strong><?php echo lang('users trans amount_received_withdraw'); ?></strong></label>
         <p class="form-control-static"><?php echo $transactions['amount_received_withdraw'] ?><?if($transactions['currency']=='debit_base'){?>
                      <?php echo $this->currencys->display->base_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($transactions['currency']=='debit_extra1'){?>
                      <?php echo $this->currencys->display->extra1_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($transactions['currency']=='debit_extra2'){?>
                      <?php echo $this->currencys->display->extra2_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($transactions['currency']=='debit_extra3'){?>
                      <?php echo $this->currencys->display->extra3_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($transactions['currency']=='debit_extra4'){?>
                      <?php echo $this->currencys->display->extra4_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($transactions['currency']=='debit_extra5'){?>
                      <?php echo $this->currencys->display->extra5_code ?>
                  <?}else{?>
                  <?}?></p></p>
      </div>
      <?}else{?>
       <?}?>
       
       <?if($transactions['type']==1){?>
      <div class="form-group col-md-4">
         <label for="date"><strong><?php echo lang('users trans deposit_method'); ?></strong></label>
         <p class="form-control-static"><?php echo $transactions['deposit_method'] ?></p>
      </div>
      <?}else{?>
       <?}?>
       
       <div class="form-group col-md-4">
         <label for="date"><strong><?php echo lang('users trans ip'); ?></strong></label>
         <p class="form-control-static"><?php echo $transactions['ip_address'] ?></p>
      </div>
       
       <?if($transactions['type']==1){?>
      <div class="form-group col-md-12">
         <label for="date"><strong><?php echo lang('users trans deposit_account'); ?></strong></label>
         <p class="form-control-static"><?php echo $transactions['deposit_account'] ?></p>
      </div>
       <?}else{?>
       <?}?>
      
      <?if($transactions['type']==2){?>
      <div class="form-group col-md-4">
         <label for="date"><strong><?php echo lang('users trans withdraw_method'); ?></strong></label>
         <p class="form-control-static"><?php echo $transactions['withdraw_method'] ?></p>
      </div>
      <?}else{?>
       <?}?>
       
       <?if($transactions['type']==2){?>
      <div class="form-group col-md-4">
         <label for="date"><strong><?php echo lang('users trans withdraw_account'); ?></strong></label>
         <p class="form-control-static"><?php echo $transactions['withdraw_account'] ?></p>
      </div>
      <?}else{?>
       <?}?>
      
      
      <?if($transactions['type']==3){?>
      <div class="form-group col-md-4">
         <label for="date"><strong><?php echo lang('users trans sender'); ?></strong></label>
         <p class="form-control-static"><?php echo $transactions['sender'] ?></p>
      </div>
      <?}else{?>
       <?}?>
      
      <?if($transactions['type']==3){?>
      <div class="form-group col-md-4">
         <label for="date"><strong><?php echo lang('users trans receiver'); ?></strong></label>
         <p class="form-control-static"><?php echo $transactions['receiver'] ?></p>
      </div>
       <?}else{?>
       <?}?>
                 
      <?php if ($blockchain_type == '1') : ?>
      <div class="form-group col-md-4">
         <label for="date"><strong><?php echo lang('users deposit number_confirm'); ?></strong></label>
         <p class="form-control-static"><?php echo $this->fixer->get_btc_confirm_network($transactions['user_comment']); ?></p>
      </div>
      <?php endif; ?>
      
  <?if($transactions['type']==3){?>
      <?if($transactions['user_comment']!=NULL){?>
      <div class="form-group col-md-4">
         <label for="date"><strong><?php echo lang('users trans comment'); ?></strong></label>
         <p class="form-control-static"><?php echo $transactions['user_comment'] ?></p>
      </div>
      <?}else{?>
      <?}?>
      <?}else{?>
       <?}?>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="refund" tabindex="-1" role="dialog" aria-labelledby="refund" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo lang('users refund header'); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo lang('users refund body'); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal"><?php echo lang('users verifi close'); ?></button>
        <a href="<?php echo base_url();?>account/transactions/protect_refund/<?php echo $transactions['id']; ?>" class="btn btn-success"><?php echo lang('users transfer protect_confirm'); ?></a>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="dispute" tabindex="-1" role="dialog" aria-labelledby="dispute" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo lang('users history open_dispute'); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <?php echo form_open(site_url("account/disputes/start_dispute"), array("" => "")) ?>
          <?php if (isset($transactions['id'])) : ?>
            <?php echo form_hidden('id', $transactions['id']); ?>
          <?php endif; ?>
          <div class="col-md-12">
            <div class="form-group">
              <label><?php echo lang('users history dispute_title'); ?></label>
                <select class="form-control" name="title">
                  <option value="1"><?php echo lang('users history not_received'); ?></option>
                  <option value="2"><?php echo lang('users history not_desk'); ?></option>
                </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label><?php echo lang('users history reason'); ?></label>
              <textarea class="form-control" rows="10" name="message"></textarea>
              <span class="text-muted"><?php echo lang('users history help'); ?></span>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal"><?php echo lang('users verifi close'); ?></button>
        <button type="submit" name="submit" class="btn btn-success"><?php echo lang('users history start'); ?></button>
      </div>
      <?php echo form_close(); ?> 
    </div>
  </div>
</div>