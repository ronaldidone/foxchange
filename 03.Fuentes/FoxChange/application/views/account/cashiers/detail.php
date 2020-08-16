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
    <div class="btn-group" role="group" aria-label="Basic example">
      <a href="<?php echo base_url('account/cashiers/detail/'.$transactions['id']); ?>" class="btn btn-outline-secondary btn-sm"><i class="icon-info icons"></i> <?php echo lang('users cashier details trans'); ?></a>
      <a href="<?php echo base_url('account/cashiers/chat/'.$transactions['id']); ?>" class="btn btn-outline-secondary btn-sm"><i class="icon-bubbles icons"></i> <?php echo lang('users cashier chat trans'); ?></a>
      <a href="<?php echo base_url('account/cashiers/'); ?>" class="btn btn-outline-secondary btn-sm"><i class="icon-close icons"></i> <?php echo lang('users cashier cancel trans'); ?></a>      
    </div>
  </div>
  <div class="col-md-4 mb-2 text-right">
  <!--<a href="#" data-toggle="modal" data-target="#chat" class="btn btn-outline-danger btn-sm">CHAT<?php  //echo lang('users history open_dispute'); ?></a>
  &nbsp;-->
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
                        <span class="badge badge-primary"> <?php echo lang('users trans success'); ?> </span>
                      <?php endif; ?>
                      <?php if($transactions["status"]==3): ?>
                        <span class="badge badge-primary"> <?php echo lang('users trans refund'); ?> </span>
                      <?php endif; ?>
                      <?php if($transactions["status"]==4): ?>
                        <span class="badge badge-primary"> <?php echo lang('users trans dispute'); ?> </span>
                      <?php endif; ?>
                      <?php if($transactions["status"]==5): ?>
                        <span class="badge badge-primary"> <?php echo lang('users trans blocked'); ?> </span>
                      <?php endif; ?>
                      <?php if($transactions["status"]==6): ?>
                        <span class="badge badge-primary"> <?php echo lang('users trans cancelled'); ?> </span>
                      <?php endif; ?>
             
         
      </div>

                  
      <?if($transactions['type']==3){?>
      <div class="form-group col-md-4">
         <label for="date"><strong><?php echo lang('users trans cantidad'); ?></strong></label>
          <p class="form-control-static"><?php echo $transactions['amount'] ?> <?if($transactions['currency']=='debit_base'){?>
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
         <label for="date"><strong><?php echo lang('users trans amount_deposit'); ?></strong></label>
          <p class="form-control-static"><?php echo $transactions['amount_deposit'] ?> <?if($transactions['currency']=='debit_base'){?>
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
    
<!-- <div class="card-footer-padding" style="align-content:right">  -->
     <div class="dropdown dropup text-right">
					<div class="btn-group dropup">
					<button type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<?php echo lang('users col actions'); ?>
					</button>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="<?php echo base_url();?>account/cashiers/ok_deposit/<?php echo $transactions['id'] ?>"><?php echo lang('users verify confirm'); ?></a>
 				  </div>
				</div>
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



<!-- Modal -->
<div class="modal fade" id="chat" style="height: 95%; max-height: 95%; " tabindex="-1" role="dialog" aria-labelledby="chat" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="height: 95%; max-height: 95%; " >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">CHAT <?php //echo lang('users history open_dispute'); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row" >
            <!--INICIO CODIGO CHAT-->

            <!--Navbar-->
                

                <div class="container mt-0" style="height: 95%; max-height: 95%; ">

                <!-- Grid row -->
                <div class="row d-flex flex-row-reverse">

                <!-- Grid column -->
                <div class="col-md-12 mb-4 d-flex flex-row-reverse">

                    <div class="card chat-room small-chat wide" style="width:100%" id="myForm">
                    <div class="card-header white d-flex justify-content-between p-2" id="toggle" style="cursor: pointer;">
                        <div class="heading d-flex justify-content-start">
                        <div class="profile-photo">
                            <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-6.jpg" alt="avatar" class="avatar rounded-circle mr-2 ml-0" style="height:3rem;">
                            <span class="state"></span>
                        </div>
                        <div class="data">
                            <p class="name mb-0"><strong>John Smith</strong></p>
                            <p class="activity text-muted mb-0">Active now</p>
                        </div>
                        </div>
                        <div class="icons grey-text">
                        <!--<a class="feature"><i class="fas fa-video mr-2"></i></a>
                        <a class="feature"><i class="fas fa-phone mr-2"></i></a>
                        <a class="feature"><i class="fas fa-cog mr-2"></i></a>
                        <a id="closeButton"><i class="fas fa-times mr-2"></i></a>!-->
                        </div>
                    </div>
                    <div class="my-custom-scrollbar" style="height: 22rem; max-height: 22rem; overflow-y: scroll;display: flex;flex-direction: column-reverse;" id="message">
                        <div class="card-body p-3">
                        <div class="chat-message" id="messagelist">
                            
                            <div class="card bg-primary rounded w-75 float-right z-depth-0 mb-1">
                            <div class="card-body p-2">
                                <p class="card-text text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit voluptatem cum eum tempore.</p>
                            </div>
                            </div>
                            <div class="card bg-primary rounded w-50 float-right z-depth-0 mb-2">
                            <div class="card-body p-2">
                                <p class="card-text text-white">Rem suscipit lorum repellendus ditiis?</p>
                            </div>
                            </div>
                            <div class="card bg-light rounded w-75 z-depth-0 mb-1 message-text">
                            <div class="card-body p-2">
                                <p class="card-text black-text">Nostrum minima cupiditate assumenda, atque cumque hic voluptatibus at corporis maxime quam harum.</p>
                            </div>
                            </div>
                            <div class="d-flex justify-content-start">
                            <!--<div class="profile-photo message-photo">
                                <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-6.jpg" alt="avatar" class="avatar rounded-circle mr-2 ml-0">
                                <span class="state"></span>
                            </div>!-->
                            <div class="card bg-light rounded w-75 z-depth-0 mb-2">
                                <div class="card-body p-2">
                                <p class="card-text black-text">Qui animi molestiae autem nihil optio recusandae nisi sit ab quo est.</p>
                                </div>
                            </div>
                            </div>
                            <div class="card bg-primary rounded w-75 float-right z-depth-0 mb-1 last">
                            <div class="card-body p-2">
                                <p class="card-text text-white">Maxime nostrum ut blanditiis a quod quam, quidem deleniti?</p>
                            </div>
                            </div>
                            <div class="card bg-light rounded w-75 z-depth-0 mb-1 message-text">
                            <div class="card-body p-2">
                                <p class="card-text black-text">Nostrum minima cupiditate assumenda, atque cumque hic voluptatibus at corporis maxime quam harum.</p>
                            </div>
                            </div>
                            <div class="card bg-primary rounded w-75 float-right z-depth-0 mb-1 last">
                            <div class="card-body p-2">
                                <p class="card-text text-white">Maxime nostrum ut blanditiis a quod quam, quidem deleniti?</p>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted white pt-1 pb-2 px-3">
                      
                        
                        <input type="hidden" id="transId" name="id_trans" value="<?php echo $transactions['id']; ?>" />
                        <input type="text" id="inputMsgChat" name="msgtrans" class="form-control" placeholder="Type a message...">
                        <div>
                        <!--<a><i class="far fa-file-image mr-2"></i></a>
                        <a><i class="far fa-laugh mr-2"></i></a>
                        <a><i class="fas fa-gamepad mr-2"></i></a>
                        <a><i class="fas fa-paperclip mr-2"></i></a>
                        <a><i class="fas fa-camera mr-2"></i></a>
                        <a><i class="fas fa-thumbs-up float-right"></i></a>-->
                        </div>
                       
                    </div>
                    </div>

                </div>
                <!-- Grid column -->

                </div>
                <!-- Grid row -->

                </div>




            <!--FIN CODIGO CHAT-->

        <!--<iframe width="560" height="315" src="https://mdbootstrap.com/api/snippets/embed/2401147/fullscreen" frameborder="0"></iframe>!-->
        </div>
      </div>
    </div>
  </div>
</div>