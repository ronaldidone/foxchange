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
      <a href="<?php echo base_url('account/transactions/detail/'.$transactions['id']); ?>" class="btn btn-outline-secondary btn-sm"><i class="icon-info icons"></i> <?php echo lang('users cashier details trans'); ?></a>
      <a href="<?php echo base_url('account/transactions/chat/'.$transactions['id']); ?>" class="btn btn-outline-secondary btn-sm"><i class="icon-bubbles icons"></i> <?php echo lang('users cashier chat trans'); ?></a>
      <a href="<?php echo base_url('account/transactions/'); ?>" class="btn btn-outline-secondary btn-sm"><i class="icon-close icons"></i> <?php echo lang('users cashier cancel trans'); ?></a>      
    </div>
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


<div class="card">
  <div class="card-body">
    <div class="row">
              
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
                        <img src="<?php echo $avatar = $this->notice->check_img($transactions['type'], $user_kshr["email"], $transactions['id']); ?>" alt="avatar" class="avatar rounded-circle mr-2 ml-0" style="height:3rem;">
                        <span class="state"></span>
                    </div>
                    <div class="data">
                        <p class="name mb-0"><strong>
                        <?php echo $user_kshr["first_name"]." ".$user_kshr["last_name"]; ?>
                        </strong></p>
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
     
      
    </div>
    
<!-- <div class="card-footer-padding" style="align-content:right">  -->
  
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
