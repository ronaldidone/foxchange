<div class="row">
  <div class="col-md-12 mb-2">
    <h5><?php echo lang('users title form_deposit'); ?></h5>
  </div>
</div>
<?php echo form_open(site_url("account/deposit/confirm"), array("" => "")) ?>
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="form-group col-md-4">
         <label for="title"><?php echo lang('users transfer amount deposit'); ?></label>
         <input type="text" class="form-control" name="amount" id="amount_param" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '');MontoaRecibir()" placeholder="0.00">
      </div>
      <div class="form-group col-md-4">
         <label for="title"><?php echo lang('users transfer received'); ?></label>
         <input type="text" class="form-control" name="amount_received" id="amount_received"  placeholder="0.00" disabled="">
      </div>
      <div class="form-group col-md-4">
            <label><?php echo lang('users trans cyr'); ?></label>
                  <select class="form-control" name="currency">
                    <option value="debit_base">
                    <?php echo $this->currencys->display->base_code ?>
                    </option>
                    <?php if($this->currencys->display->extra1_check) : ?>
                    <option value="debit_extra1">
                    <?php echo $this->currencys->display->extra1_code ?>
                    </option>
                    <?php endif; ?>
                    <?php if($this->currencys->display->extra2_check) : ?>
                    <option value="debit_extra2">
                    <?php echo $this->currencys->display->extra2_code ?>
                    </option>
                    <?php endif; ?>
                    <?php if($this->currencys->display->extra3_check) : ?>
                    <option value="debit_extra3">
                    <?php echo $this->currencys->display->extra3_code ?>
                    </option>
                    <?php endif; ?>
                    <?php if($this->currencys->display->extra4_check) : ?>
                    <option value="debit_extra4">
                    <?php echo $this->currencys->display->extra4_code ?>
                    </option>
                    <?php endif; ?>
                    <?php if($this->currencys->display->extra5_check) : ?>
                    <option value="debit_extra5">
                    <?php echo $this->currencys->display->extra5_code ?>
                    </option>
                    <?php endif; ?>
                  </select>
       </div>
      <div class="col-md-12">
        <fieldset>
          <div class="plan-card-group">
            <?php if ($paypal['status'] == 1) : ?>
              <div class="radio-card">
                <input type="radio" class="planes-radio" name="method" value="paypal" id="tradicional" checked/>
                <label for="tradicional" id="radio-label1">
                 <div class="row">
                    <div class="col-md-1 mt-3 mb-3 text-center">
                      <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/paypal.png" class="win-img">
                    </div>
                     <div class="col-md-8 mt-12px mb-3">
                      <h5 class="mb-0">
                        <?php echo $paypal['name']; ?>
                      </h5>
                       <?if($enabled_paypal == FALSE){?><small class="text-danger"><?php echo lang('users withdrawal verify_error'); ?></small><?}else{?><small class="text-success"><?php echo lang('users withdrawal automatic'); ?></small> <small class="text-muted"><?php echo lang('users withdrawal available'); ?> <?if($paypal['debit_base'] == 1){?><a  data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $paypal['minimum_debit_base']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $paypal['maximum_debit_base']; ?>"><?php echo $this->currencys->display->base_code ?></a><?}else{?><?}?> <?if($paypal['debit_extra1'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $paypal['minimum_debit_extra1']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $paypal['maximum_debit_extra1']; ?>"><?php echo $this->currencys->display->extra1_code ?></a><?}else{?><?}?> <?if($paypal['debit_extra2'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $paypal['minimum_debit_extra2']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $paypal['maximum_debit_extra2']; ?>"><?php echo $this->currencys->display->extra2_code ?></a><?}else{?><?}?> <?if($paypal['debit_extra3'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $paypal['minimum_debit_extra3']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $paypal['maximum_debit_extra3']; ?>"><?php echo $this->currencys->display->extra3_code ?></a><?}else{?><?}?> <?if($paypal['debit_extra4'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $paypal['minimum_debit_extra4']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $paypal['maximum_debit_extra4']; ?>"><?php echo $this->currencys->display->extra4_code ?></a><?}else{?><?}?> <?if($paypal['debit_extra5'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $paypal['minimum_debit_extra5']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $paypal['maximum_debit_extra5']; ?>"><?php echo $this->currencys->display->extra5_code ?></a><?}else{?><?}?></small><?}?>
                    </div>
                   <div class="col-md-3 mt-22px mb-3 text-right">
                     <span class="badge badge-secondary"><?php echo $paypal['fee']; ?>% + <?php echo $paypal['fee_fix']; ?></span>
                   </div>
                  </div>
                </label>
              </div>
              <?php endif; ?>
              <?php if ($perfect_m['status'] == 1) : ?>
              <div class="radio-card">
                <input type="radio" class="planes-radio" name="method" value="perfect_m" id="full-marca-blanca6"/>
                <label for="full-marca-blanca6" id="radio-label9">
                  <div class="row">
                    <div class="col-md-1 mt-3 mb-3 text-center">
                      <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/pm.png" class="win-img">
                    </div>
                     <div class="col-md-8 mt-12px mb-3">
                      <h5 class="mb-0">
                        <?php echo $perfect_m['name']; ?>
                      </h5>
                       <?if($enabled_perfect_m == FALSE){?><small class="text-danger"><?php echo lang('users withdrawal verify_error'); ?></small><?}else{?><small class="text-success"><?php echo lang('users withdrawal automatic'); ?></small> <small class="text-muted"> <?php echo lang('users withdrawal available'); ?> <?if($perfect_m['debit_base'] == 1){?><a  data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $perfect_m['minimum_debit_base']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $perfect_m['maximum_debit_base']; ?>"><?php echo $this->currencys->display->base_code ?></a><?}else{?><?}?> <?if($perfect_m['debit_extra1'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $perfect_m['minimum_debit_extra1']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $perfect_m['maximum_debit_extra1']; ?>"><?php echo $this->currencys->display->extra1_code ?></a><?}else{?><?}?> <?if($perfect_m['debit_extra2'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $perfect_m['minimum_debit_extra2']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $perfect_m['maximum_debit_extra2']; ?>"><?php echo $this->currencys->display->extra2_code ?></a><?}else{?><?}?> <?if($perfect_m['debit_extra3'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $perfect_m['minimum_debit_extra3']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $perfect_m['maximum_debit_extra3']; ?>"><?php echo $this->currencys->display->extra3_code ?></a><?}else{?><?}?> <?if($perfect_m['debit_extra4'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $perfect_m['minimum_debit_extra4']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $perfect_m['maximum_debit_extra4']; ?>"><?php echo $this->currencys->display->extra4_code ?></a><?}else{?><?}?> <?if($perfect_m['debit_extra5'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $perfect_m['minimum_debit_extra5']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $perfect_m['maximum_debit_extra5']; ?>"><?php echo $this->currencys->display->extra5_code ?></a><?}else{?><?}?></small><?}?>
                    </div>
                   <div class="col-md-3 mt-22px mb-3 text-right">
                     <span class="badge badge-secondary"><?php echo $perfect_m['fee']; ?>% + <?php echo $perfect_m['fee_fix']; ?></span>
                   </div>
                  </div>
                </label>
              </div>
              <?php endif; ?>
              <?php if ($advcash['status'] == 1) : ?>
              <div class="radio-card">
                <input type="radio" class="planes-radio" name="method" value="advcash" id="full-marca-blanca5"/>
                <label for="full-marca-blanca5" id="radio-label8">
                  <div class="row">
                    <div class="col-md-1 mt-3 mb-3 text-center">
                      <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/advcash.png" class="win-img">
                    </div>
                     <div class="col-md-8 mt-12px mb-3">
                      <h5 class="mb-0">
                        <?php echo $advcash['name']; ?>
                      </h5>
                       <?if($enabled_advcash == FALSE){?><small class="text-danger"><?php echo lang('users withdrawal verify_error'); ?></small><?}else{?><small class="text-success"><?php echo lang('users withdrawal automatic'); ?></small> <small class="text-muted"> <?php echo lang('users withdrawal available'); ?> <?if($advcash['debit_base'] == 1){?><a  data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $advcash['minimum_debit_base']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $advcash['maximum_debit_base']; ?>"><?php echo $this->currencys->display->base_code ?></a><?}else{?><?}?> <?if($advcash['debit_extra1'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $advcash['minimum_debit_extra1']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $advcash['maximum_debit_extra1']; ?>"><?php echo $this->currencys->display->extra1_code ?></a><?}else{?><?}?> <?if($advcash['debit_extra2'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $advcash['minimum_debit_extra2']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $advcash['maximum_debit_extra2']; ?>"><?php echo $this->currencys->display->extra2_code ?></a><?}else{?><?}?> <?if($advcash['debit_extra3'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $advcash['minimum_debit_extra3']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $advcash['maximum_debit_extra3']; ?>"><?php echo $this->currencys->display->extra3_code ?></a><?}else{?><?}?> <?if($advcash['debit_extra4'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $advcash['minimum_debit_extra4']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $advcash['maximum_debit_extra4']; ?>"><?php echo $this->currencys->display->extra4_code ?></a><?}else{?><?}?> <?if($advcash['debit_extra5'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $advcash['minimum_debit_extra5']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $advcash['maximum_debit_extra5']; ?>"><?php echo $this->currencys->display->extra5_code ?></a><?}else{?><?}?></small><?}?>
                    </div>
                   <div class="col-md-3 mt-22px mb-3 text-right">
                     <span class="badge badge-secondary"><?php echo $advcash['fee']; ?>% + <?php echo $advcash['fee_fix']; ?></span>
                   </div>
                  </div>
                </label>
              </div>
              <?php endif; ?>
              <?php if ($payeer['status'] == 1) : ?>
              <div class="radio-card">
                <input type="radio" class="planes-radio" name="method" value="payeer" id="full-marca-blanca10"/>
                <label for="full-marca-blanca10" id="radio-label10">
                  <div class="row">
                    <div class="col-md-1 mt-3 mb-3 text-center">
                      <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/payeer.png" class="win-img">
                    </div>
                     <div class="col-md-8 mt-12px mb-3">
                      <h5 class="mb-0">
                        <?php echo $payeer['name']; ?>
                      </h5>
                       <?if($enabled_payeer == FALSE){?><small class="text-danger"><?php echo lang('users withdrawal verify_error'); ?></small><?}else{?><small class="text-success"><?php echo lang('users withdrawal automatic'); ?></small> <small class="text-muted"> <?php echo lang('users withdrawal available'); ?> <?if($payeer['debit_base'] == 1){?><a  data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $payeer['minimum_debit_base']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $payeer['maximum_debit_base']; ?>"><?php echo $this->currencys->display->base_code ?></a><?}else{?><?}?> <?if($payeer['debit_extra1'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $payeer['minimum_debit_extra1']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $payeer['maximum_debit_extra1']; ?>"><?php echo $this->currencys->display->extra1_code ?></a><?}else{?><?}?> <?if($payeer['debit_extra2'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $payeer['minimum_debit_extra2']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $payeer['maximum_debit_extra2']; ?>"><?php echo $this->currencys->display->extra2_code ?></a><?}else{?><?}?> <?if($payeer['debit_extra3'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $payeer['minimum_debit_extra3']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $payeer['maximum_debit_extra3']; ?>"><?php echo $this->currencys->display->extra3_code ?></a><?}else{?><?}?> <?if($payeer['debit_extra4'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $payeer['minimum_debit_extra4']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $payeer['maximum_debit_extra4']; ?>"><?php echo $this->currencys->display->extra4_code ?></a><?}else{?><?}?> <?if($payeer['debit_extra5'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $payeer['minimum_debit_extra5']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $payeer['maximum_debit_extra5']; ?>"><?php echo $this->currencys->display->extra5_code ?></a><?}else{?><?}?></small><?}?>
                    </div>
                   <div class="col-md-3 mt-22px mb-3 text-right">
                     <span class="badge badge-secondary"><?php echo $payeer['fee']; ?>% + <?php echo $payeer['fee_fix']; ?></span>
                   </div>
                  </div>
                </label>
              </div>
              <?php endif; ?>
              <?php if ($skrill['status'] == 1) : ?>
              <div class="radio-card">
                <input type="radio" class="planes-radio" name="method" value="skrill" id="full-marca-blanca11"/>
                <label for="full-marca-blanca11" id="radio-label11">
                  <div class="row">
                    <div class="col-md-1 mt-3 mb-3 text-center">
                      <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/skrill.png" class="win-img">
                    </div>
                     <div class="col-md-8 mt-12px mb-3">
                      <h5 class="mb-0">
                        <?php echo $skrill['name']; ?>
                      </h5>
                       <?if($enabled_skrill == FALSE){?><small class="text-danger"><?php echo lang('users withdrawal verify_error'); ?></small><?}else{?><small class="text-muted"><?php echo lang('users withdrawal automatic'); ?> <?php echo lang('users withdrawal available'); ?> <?if($skrill['debit_base'] == 1){?><a  data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $skrill['minimum_debit_base']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $skrill['maximum_debit_base']; ?>"><?php echo $this->currencys->display->base_code ?></a><?}else{?><?}?> <?if($skrill['debit_extra1'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $skrill['minimum_debit_extra1']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $skrill['maximum_debit_extra1']; ?>"><?php echo $this->currencys->display->extra1_code ?></a><?}else{?><?}?> <?if($skrill['debit_extra2'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $skrill['minimum_debit_extra2']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $skrill['maximum_debit_extra2']; ?>"><?php echo $this->currencys->display->extra2_code ?></a><?}else{?><?}?> <?if($skrill['debit_extra3'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $skrill['minimum_debit_extra3']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $skrill['maximum_debit_extra3']; ?>"><?php echo $this->currencys->display->extra3_code ?></a><?}else{?><?}?> <?if($skrill['debit_extra4'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $skrill['minimum_debit_extra4']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $skrill['maximum_debit_extra4']; ?>"><?php echo $this->currencys->display->extra4_code ?></a><?}else{?><?}?> <?if($skrill['debit_extra5'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $skrill['minimum_debit_extra5']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $skrill['maximum_debit_extra5']; ?>"><?php echo $this->currencys->display->extra5_code ?></a><?}else{?><?}?></small><?}?>
                    </div>
                   <div class="col-md-3 mt-22px mb-3 text-right">
                     <span class="badge badge-secondary"><?php echo $skrill['fee']; ?>% + <?php echo $skrill['fee_fix']; ?></span>
                   </div>
                  </div>
                </label>
              </div>
              <?php endif; ?>
              <?php if ($paygol['status'] == 1) : ?>
              <div class="radio-card">
                <input type="radio" class="planes-radio" name="method" value="paygol" id="full-marca-blanca12"/>
                <label for="full-marca-blanca12" id="radio-label12">
                  <div class="row">
                    <div class="col-md-1 mt-3 mb-3 text-center">
                      <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/visa.png" class="win-img">
                    </div>
                     <div class="col-md-8 mt-12px mb-3">
                      <h5 class="mb-0">
                        <?php echo $paygol['name']; ?>
                      </h5>
                       <?if($enabled_paygol == FALSE){?><small class="text-danger"><?php echo lang('users withdrawal verify_error'); ?></small><?}else{?><small class="text-muted"><?php echo lang('users withdrawal automatic'); ?> <?php echo lang('users withdrawal available'); ?> <?if($paygol['debit_base'] == 1){?><a  data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $paygol['minimum_debit_base']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $paygol['maximum_debit_base']; ?>"><?php echo $this->currencys->display->base_code ?></a><?}else{?><?}?> <?if($paygol['debit_extra1'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $paygol['minimum_debit_extra1']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $paygol['maximum_debit_extra1']; ?>"><?php echo $this->currencys->display->extra1_code ?></a><?}else{?><?}?> <?if($paygol['debit_extra2'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $paygol['minimum_debit_extra2']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $paygol['maximum_debit_extra2']; ?>"><?php echo $this->currencys->display->extra2_code ?></a><?}else{?><?}?> <?if($paygol['debit_extra3'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $paygol['minimum_debit_extra3']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $paygol['maximum_debit_extra3']; ?>"><?php echo $this->currencys->display->extra3_code ?></a><?}else{?><?}?> <?if($paygol['debit_extra4'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $paygol['minimum_debit_extra4']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $paygol['maximum_debit_extra4']; ?>"><?php echo $this->currencys->display->extra4_code ?></a><?}else{?><?}?> <?if($paygol['debit_extra5'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $paygol['minimum_debit_extra5']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $paygol['maximum_debit_extra5']; ?>"><?php echo $this->currencys->display->extra5_code ?></a><?}else{?><?}?></small><?}?>
                    </div>
                   <div class="col-md-3 mt-22px mb-3 text-right">
                     <span class="badge badge-secondary"><?php echo $paygol['fee']; ?>% + <?php echo $paygol['fee_fix']; ?></span>
                   </div>
                  </div>
                </label>
              </div>
              <?php endif; ?>
             <?php if ($paypal_manual['status'] == 1) : ?>
              <div class="radio-card">
                <input type="radio" class="planes-radio" name="method" value="paypal_manual" id="full-marca-blanca13"/>
                <label for="full-marca-blanca13" id="radio-label13">
                  <div class="row">
                    <div class="col-md-1 mt-3 mb-3 text-center">
                      <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/paypal.png" class="win-img">
                    </div>
                     <div class="col-md-8 mt-12px mb-3">
                      <h5 class="mb-0">
                        <?php echo $paypal_manual['name']; ?>
                      </h5>
                       <?if($enabled_paypal_manual == FALSE){?><small class="text-danger"><?php echo lang('users withdrawal verify_error'); ?></small><?}else{?><small class="text-muted"><?php echo lang('users withdrawal manual'); ?></small> <small class="text-muted"><?php echo lang('users withdrawal available'); ?> <?if($paypal_manual['debit_base'] == 1){?><a  data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $paypal_manual['minimum_debit_base']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $paypal_manual['maximum_debit_base']; ?>"><?php echo $this->currencys->display->base_code ?></a><?}else{?><?}?> <?if($paypal_manual['debit_extra1'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $paypal_manual['minimum_debit_extra1']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $paypal_manual['maximum_debit_extra1']; ?>"><?php echo $this->currencys->display->extra1_code ?></a><?}else{?><?}?> <?if($paypal_manual['debit_extra2'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $paypal_manual['minimum_debit_extra2']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $paypal_manual['maximum_debit_extra2']; ?>"><?php echo $this->currencys->display->extra2_code ?></a><?}else{?><?}?> <?if($paypal_manual['debit_extra3'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $paypal_manual['minimum_debit_extra3']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $paypal_manual['maximum_debit_extra3']; ?>"><?php echo $this->currencys->display->extra3_code ?></a><?}else{?><?}?> <?if($paypal_manual['debit_extra4'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $paypal_manual['minimum_debit_extra4']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $paypal_manual['maximum_debit_extra4']; ?>"><?php echo $this->currencys->display->extra4_code ?></a><?}else{?><?}?> <?if($paypal_manual['debit_extra5'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $paypal_manual['minimum_debit_extra5']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $paypal_manual['maximum_debit_extra5']; ?>"><?php echo $this->currencys->display->extra5_code ?></a><?}else{?><?}?></small><?}?>
                    </div>
                   <div class="col-md-3 mt-22px mb-3 text-right">
                     <span class="badge badge-secondary"><?php echo $paypal_manual['fee']; ?>% + <?php echo $paypal_manual['fee_fix']; ?></span>
                   </div>
                  </div>
                </label>
              </div>
              <?php endif; ?>
              <?php if ($coinpayments['status'] == 1) : ?>
              <div class="radio-card">
                <input type="radio" class="planes-radio" name="method" value="coinpayments" id="full-marca-blanca15"/>
                <label for="full-marca-blanca15" id="radio-label15">
                  <div class="row">
                    <div class="col-md-1 mt-3 mb-3 text-center">
                      <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/btc.png" class="win-img">
                    </div>
                     <div class="col-md-8 mt-12px mb-3">
                      <h5 class="mb-0">
                        <?php echo $coinpayments['name']; ?>
                      </h5>
                       <?if($enabled_coinpayments == FALSE){?><small class="text-danger"><?php echo lang('users withdrawal verify_error'); ?></small><?}else{?><small class="text-success"><?php echo lang('users withdrawal automatic'); ?></small> <small class="text-muted"> <?php echo lang('users withdrawal available'); ?> <?if($coinpayments['debit_base'] == 1){?><a  data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $coinpayments['minimum_debit_base']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $coinpayments['maximum_debit_base']; ?>"><?php echo $this->currencys->display->base_code ?></a><?}else{?><?}?> <?if($coinpayments['debit_extra1'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $coinpayments['minimum_debit_extra1']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $coinpayments['maximum_debit_extra1']; ?>"><?php echo $this->currencys->display->extra1_code ?></a><?}else{?><?}?> <?if($coinpayments['debit_extra2'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $coinpayments['minimum_debit_extra2']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $coinpayments['maximum_debit_extra2']; ?>"><?php echo $this->currencys->display->extra2_code ?></a><?}else{?><?}?> <?if($coinpayments['debit_extra3'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $coinpayments['minimum_debit_extra3']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $coinpayments['maximum_debit_extra3']; ?>"><?php echo $this->currencys->display->extra3_code ?></a><?}else{?><?}?> <?if($coinpayments['debit_extra4'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $coinpayments['minimum_debit_extra4']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $coinpayments['maximum_debit_extra4']; ?>"><?php echo $this->currencys->display->extra4_code ?></a><?}else{?><?}?> <?if($coinpayments['debit_extra5'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $coinpayments['minimum_debit_extra5']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $coinpayments['maximum_debit_extra5']; ?>"><?php echo $this->currencys->display->extra5_code ?></a><?}else{?><?}?></small><?}?>
                    </div>
                   <div class="col-md-3 mt-22px mb-3 text-right">
                     <span class="badge badge-secondary"><?php echo $coinpayments['fee']; ?>% + <?php echo $coinpayments['fee_fix']; ?></span>
                   </div>
                  </div>
                </label>
              </div>
              <?php endif; ?>
              <?php if ($blockchain['status'] == 1) : ?>
              <div class="radio-card">
                <input type="radio" class="planes-radio" name="method" value="blockchain" id="full-marca-blanca16"/>
                <label for="full-marca-blanca16" id="radio-label16">
                  <div class="row">
                    <div class="col-md-1 mt-3 mb-3 text-center">
                      <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/blockchain.png" class="win-img">
                    </div>
                     <div class="col-md-8 mt-12px mb-3">
                      <h5 class="mb-0">
                        <?php echo $blockchain['name']; ?>
                      </h5>
                       <?if($enabled_blockchain == FALSE){?><small class="text-danger"><?php echo lang('users withdrawal verify_error'); ?></small><?}else{?><small class="text-muted"><?php echo lang('users withdrawal available'); ?> <?if($blockchain['debit_base'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $blockchain['minimum_debit_base']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $blockchain['maximum_debit_base']; ?>"><?php echo $this->currencys->display->base_code ?></a><?}else{?><?}?> <?if($blockchain['debit_extra1'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $blockchain['minimum_debit_extra1']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $blockchain['maximum_debit_extra1']; ?>"><?php echo $this->currencys->display->extra1_code ?></a><?}else{?><?}?> <?if($blockchain['debit_extra2'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $blockchain['minimum_debit_extra2']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $blockchain['maximum_debit_extra2']; ?>"><?php echo $this->currencys->display->extra2_code ?></a><?}else{?><?}?> <?if($blockchain['debit_extra3'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $blockchain['minimum_debit_extra3']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $blockchain['maximum_debit_extra3']; ?>"><?php echo $this->currencys->display->extra3_code ?></a><?}else{?><?}?> <?if($blockchain['debit_extra4'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $blockchain['minimum_debit_extra4']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $blockchain['maximum_debit_extra4']; ?>"><?php echo $this->currencys->display->extra4_code ?></a><?}else{?><?}?> <?if($blockchain['debit_extra5'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $blockchain['minimum_debit_extra5']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $blockchain['maximum_debit_extra5']; ?>"><?php echo $this->currencys->display->extra5_code ?></a><?}else{?><?}?></small><?}?>
                    </div>
                   <div class="col-md-3 mt-22px mb-3 text-right">
                     <span class="badge badge-secondary"><?php echo $blockchain['fee']; ?>% + <?php echo $blockchain['fee_fix']; ?></span>
                   </div>
                  </div>
                </label>
              </div>
              <?php endif; ?>
              <?php if ($neteller['status'] == 1) : ?>
              <div class="radio-card">
                <input type="radio" class="planes-radio" name="method" value="neteller" id="full-marca-blanca17"/>
                <label for="full-marca-blanca17" id="radio-label17">
                  <div class="row">
                    <div class="col-md-1 mt-3 mb-3 text-center">
                      <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/Neteller.png" class="win-img">
                    </div>
                     <div class="col-md-8 mt-12px mb-3">
                      <h5 class="mb-0">
                        <?php echo $neteller['name']; ?>
                      </h5>
                       <?if($enabled_neteller == FALSE){?><small class="text-danger"><?php echo lang('users withdrawal verify_error'); ?></small><?}else{?><small class="text-muted"><?php echo lang('users withdrawal manual'); ?> <?php echo lang('users withdrawal available'); ?> <?if($neteller['debit_base'] == 1){?><a  data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $neteller['minimum_debit_base']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $neteller['maximum_debit_base']; ?>"><?php echo $this->currencys->display->base_code ?></a><?}else{?><?}?> <?if($neteller['debit_extra1'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $neteller['minimum_debit_extra1']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $neteller['maximum_debit_extra1']; ?>"><?php echo $this->currencys->display->extra1_code ?></a><?}else{?><?}?> <?if($neteller['debit_extra2'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $neteller['minimum_debit_extra2']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $neteller['maximum_debit_extra2']; ?>"><?php echo $this->currencys->display->extra2_code ?></a><?}else{?><?}?> <?if($neteller['debit_extra3'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $neteller['minimum_debit_extra3']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $neteller['maximum_debit_extra3']; ?>"><?php echo $this->currencys->display->extra3_code ?></a><?}else{?><?}?> <?if($neteller['debit_extra4'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $neteller['minimum_debit_extra4']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $neteller['maximum_debit_extra4']; ?>"><?php echo $this->currencys->display->extra4_code ?></a><?}else{?><?}?> <?if($neteller['debit_extra5'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $neteller['minimum_debit_extra5']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $neteller['maximum_debit_extra5']; ?>"><?php echo $this->currencys->display->extra5_code ?></a><?}else{?><?}?></small><?}?>
                    </div>
                   <div class="col-md-3 mt-22px mb-3 text-right">
                     <span class="badge badge-secondary"><?php echo $neteller['fee']; ?>% + <?php echo $neteller['fee_fix']; ?></span>
                   </div>
                  </div>
                </label>
              </div>
              <?php endif; ?>
              <?php if ($uphold['status'] == 1) : ?>
              <div class="radio-card">
                <input type="radio" class="planes-radio" name="method" value="uphold" id="full-marca-blanca18"/>
                <label for="full-marca-blanca18" id="radio-label18">
                  <div class="row">
                    <div class="col-md-1 mt-3 mb-3 text-center">
                      <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/Uphold.png" class="win-img">
                    </div>
                     <div class="col-md-8 mt-12px mb-3">
                      <h5 class="mb-0">
                        <?php echo $uphold['name']; ?>
                      </h5>
                       <?if($enabled_uphold == FALSE){?><small class="text-danger"><?php echo lang('users withdrawal verify_error'); ?></small><?}else{?><small class="text-muted"><?php echo lang('users withdrawal manual'); ?> <?php echo lang('users withdrawal available'); ?> <?if($uphold['debit_base'] == 1){?><a  data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $uphold['minimum_debit_base']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $uphold['maximum_debit_base']; ?>"><?php echo $this->currencys->display->base_code ?></a><?}else{?><?}?> <?if($uphold['debit_extra1'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $uphold['minimum_debit_extra1']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $uphold['maximum_debit_extra1']; ?>"><?php echo $this->currencys->display->extra1_code ?></a><?}else{?><?}?> <?if($uphold['debit_extra2'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $uphold['minimum_debit_extra2']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $uphold['maximum_debit_extra2']; ?>"><?php echo $this->currencys->display->extra2_code ?></a><?}else{?><?}?> <?if($uphold['debit_extra3'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $uphold['minimum_debit_extra3']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $uphold['maximum_debit_extra3']; ?>"><?php echo $this->currencys->display->extra3_code ?></a><?}else{?><?}?> <?if($uphold['debit_extra4'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $uphold['minimum_debit_extra4']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $uphold['maximum_debit_extra4']; ?>"><?php echo $this->currencys->display->extra4_code ?></a><?}else{?><?}?> <?if($uphold['debit_extra5'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $uphold['minimum_debit_extra5']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $uphold['maximum_debit_extra5']; ?>"><?php echo $this->currencys->display->extra5_code ?></a><?}else{?><?}?></small><?}?>
                    </div>
                   <div class="col-md-3 mt-22px mb-3 text-right">
                     <span class="badge badge-secondary"><?php echo $uphold['fee']; ?>% + <?php echo $uphold['fee_fix']; ?></span>
                   </div>
                  </div>
                </label>
              </div>
              <?php endif; ?>
              <?php if ($skrill_manual['status'] == 1) : ?>
              <div class="radio-card">
                <input type="radio" class="planes-radio" name="method" value="skrill_manual" id="full-marca-blanca19"/>
                <label for="full-marca-blanca19" id="radio-label19">
                  <div class="row">
                    <div class="col-md-1 mt-3 mb-3 text-center">
                      <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/skrill.png" class="win-img">
                    </div>
                     <div class="col-md-8 mt-12px mb-3">
                      <h5 class="mb-0">
                        <?php echo $skrill_manual['name']; ?>
                      </h5>
                       <?if($enabled_skrill_manual == FALSE){?><small class="text-danger"><?php echo lang('users withdrawal verify_error'); ?></small><?}else{?><small class="text-muted"><?php echo lang('users withdrawal manual'); ?> <?php echo lang('users withdrawal available'); ?> <?if($skrill_manual['debit_base'] == 1){?><a data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $skrill_manual['minimum_debit_base']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $skrill_manual['maximum_debit_base']; ?>"><?php echo $this->currencys->display->base_code ?></a><?}else{?><?}?> <?if($skrill_manual['debit_extra1'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $skrill_manual['minimum_debit_extra1']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $skrill_manual['maximum_debit_extra1']; ?>"><?php echo $this->currencys->display->extra1_code ?></a><?}else{?><?}?> <?if($skrill_manual['debit_extra2'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $skrill_manual['minimum_debit_extra2']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $skrill_manual['maximum_debit_extra2']; ?>"><?php echo $this->currencys->display->extra2_code ?></a><?}else{?><?}?> <?if($skrill_manual['debit_extra3'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $skrill_manual['minimum_debit_extra3']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $skrill_manual['maximum_debit_extra3']; ?>"><?php echo $this->currencys->display->extra3_code ?></a><?}else{?><?}?> <?if($skrill_manual['debit_extra4'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $skrill_manual['minimum_debit_extra4']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $skrill_manual['maximum_debit_extra4']; ?>"><?php echo $this->currencys->display->extra4_code ?></a><?}else{?><?}?> <?if($skrill_manual['debit_extra5'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $skrill_manual['minimum_debit_extra5']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $skrill_manual['maximum_debit_extra5']; ?>"><?php echo $this->currencys->display->extra5_code ?></a><?}else{?><?}?></small><?}?>
                    </div>
                   <div class="col-md-3 mt-22px mb-3 text-right">
                     <span class="badge badge-secondary"><?php echo $skrill_manual['fee']; ?>% + <?php echo $skrill_manual['fee_fix']; ?></span>
                   </div>
                  </div>
                </label>
              </div>
              <?php endif; ?>
              <?php if ($airtm['status'] == 1) : ?>
              <div class="radio-card">
                <input type="radio" class="planes-radio" name="method" value="airtm" id="full-marca-blanca20"/>
                <label for="full-marca-blanca20" id="radio-label20">
                  <div class="row">
                    <div class="col-md-1 mt-3 mb-3 text-center">
                      <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/airtm.png" class="win-img">
                    </div>
                     <div class="col-md-8 mt-12px mb-3">
                      <h5 class="mb-0">
                        <?php echo $airtm['name']; ?>
                      </h5>
                       <?if($enabled_airtm == FALSE){?><small class="text-danger"><?php echo lang('users withdrawal verify_error'); ?></small><?}else{?><small class="text-muted"><?php echo lang('users withdrawal manual'); ?> <?php echo lang('users withdrawal available'); ?> <?if($airtm['debit_base'] == 1){?><a data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $airtm['minimum_debit_base']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $airtm['maximum_debit_base']; ?>"><?php echo $this->currencys->display->base_code ?></a><?}else{?><?}?> <?if($airtm['debit_extra1'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $airtm['minimum_debit_extra1']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $airtm['maximum_debit_extra1']; ?>"><?php echo $this->currencys->display->extra1_code ?></a><?}else{?><?}?> <?if($airtm['debit_extra2'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $airtm['minimum_debit_extra2']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $airtm['maximum_debit_extra2']; ?>"><?php echo $this->currencys->display->extra2_code ?></a><?}else{?><?}?> <?if($airtm['debit_extra3'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $airtm['minimum_debit_extra3']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $airtm['maximum_debit_extra3']; ?>"><?php echo $this->currencys->display->extra3_code ?></a><?}else{?><?}?> <?if($airtm['debit_extra4'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $airtm['minimum_debit_extra4']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $airtm['maximum_debit_extra4']; ?>"><?php echo $this->currencys->display->extra4_code ?></a><?}else{?><?}?> <?if($airtm['debit_extra5'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $airtm['minimum_debit_extra5']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $airtm['maximum_debit_extra5']; ?>"><?php echo $this->currencys->display->extra5_code ?></a><?}else{?><?}?></small><?}?>
                    </div>
                   <div class="col-md-3 mt-22px mb-3 text-right">
                     <span class="badge badge-secondary"><?php echo $airtm['fee']; ?>% + <?php echo $airtm['fee_fix']; ?></span>
                   </div>
                  </div>
                </label>
              </div>
              <?php endif; ?>
              <?php if ($payoneer['status'] == 1) : ?>
              <div class="radio-card">
                <input type="radio" class="planes-radio" name="method" value="payoneer" id="full-marca-blanca21"/>
                <label for="full-marca-blanca21" id="radio-label21">
                  <div class="row">
                    <div class="col-md-1 mt-3 mb-3 text-center">
                      <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/payoneer.jpg" class="win-img">
                    </div>
                     <div class="col-md-8 mt-12px mb-3">
                      <h5 class="mb-0">
                        <?php echo $payoneer['name']; ?>
                      </h5>
                       <?if($enabled_payoneer == FALSE){?><small class="text-danger"><?php echo lang('users withdrawal verify_error'); ?></small><?}else{?><small class="text-muted"><?php echo lang('users withdrawal manual'); ?> <?php echo lang('users withdrawal available'); ?> <?if($payoneer['debit_base'] == 1){?><a  data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $payoneer['minimum_debit_base']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $payoneer['maximum_debit_base']; ?>"><?php echo $this->currencys->display->base_code ?></a><?}else{?><?}?> <?if($payoneer['debit_extra1'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $payoneer['minimum_debit_extra1']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $payoneer['maximum_debit_extra1']; ?>"><?php echo $this->currencys->display->extra1_code ?></a><?}else{?><?}?> <?if($payoneer['debit_extra2'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $payoneer['minimum_debit_extra2']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $payoneer['maximum_debit_extra2']; ?>"><?php echo $this->currencys->display->extra2_code ?></a><?}else{?><?}?> <?if($payoneer['debit_extra3'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $payoneer['minimum_debit_extra3']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $payoneer['maximum_debit_extra3']; ?>"><?php echo $this->currencys->display->extra3_code ?></a><?}else{?><?}?> <?if($payoneer['debit_extra4'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $payoneer['minimum_debit_extra4']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $payoneer['maximum_debit_extra4']; ?>"><?php echo $this->currencys->display->extra4_code ?></a><?}else{?><?}?> <?if($payoneer['debit_extra5'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $payoneer['minimum_debit_extra5']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $payoneer['maximum_debit_extra5']; ?>"><?php echo $this->currencys->display->extra5_code ?></a><?}else{?><?}?></small><?}?>
                    </div>
                   <div class="col-md-3 mt-22px mb-3 text-right">
                     <span class="badge badge-secondary"><?php echo $payoneer['fee']; ?>% + <?php echo $payoneer['fee_fix']; ?></span>
                   </div>
                  </div>
                </label>
              </div>
              <?php endif; ?>
              <?php if ($webmoney['status'] == 1) : ?>
              <div class="radio-card">
                <input type="radio" class="planes-radio" name="method" value="webmoney" id="full-marca-blanca22"/>
                <label for="full-marca-blanca22" id="radio-label22">
                  <div class="row">
                    <div class="col-md-1 mt-3 mb-3 text-center">
                      <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/webmoney.png" class="win-img">
                    </div>
                     <div class="col-md-8 mt-12px mb-3">
                      <h5 class="mb-0">
                        <?php echo $webmoney['name']; ?>
                      </h5>
                       <?if($enabled_webmoney == FALSE){?><small class="text-danger"><?php echo lang('users withdrawal verify_error'); ?></small><?}else{?><small class="text-muted"><?php echo lang('users withdrawal manual'); ?> <?php echo lang('users withdrawal available'); ?> <?if($webmoney['debit_base'] == 1){?><a  data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $webmoney['minimum_debit_base']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $webmoney['maximum_debit_base']; ?>"><?php echo $this->currencys->display->base_code ?></a><?}else{?><?}?> <?if($webmoney['debit_extra1'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $webmoney['minimum_debit_extra1']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $webmoney['maximum_debit_extra1']; ?>"><?php echo $this->currencys->display->extra1_code ?></a><?}else{?><?}?> <?if($webmoney['debit_extra2'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $webmoney['minimum_debit_extra2']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $webmoney['maximum_debit_extra2']; ?>"><?php echo $this->currencys->display->extra2_code ?></a><?}else{?><?}?> <?if($webmoney['debit_extra3'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $webmoney['minimum_debit_extra3']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $webmoney['maximum_debit_extra3']; ?>"><?php echo $this->currencys->display->extra3_code ?></a><?}else{?><?}?> <?if($webmoney['debit_extra4'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $webmoney['minimum_debit_extra4']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $webmoney['maximum_debit_extra4']; ?>"><?php echo $this->currencys->display->extra4_code ?></a><?}else{?><?}?> <?if($webmoney['debit_extra5'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $webmoney['minimum_debit_extra5']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $webmoney['maximum_debit_extra5']; ?>"><?php echo $this->currencys->display->extra5_code ?></a><?}else{?><?}?></small><?}?>
                    </div>
                   <div class="col-md-3 mt-22px mb-3 text-right">
                     <span class="badge badge-secondary"><?php echo $webmoney['fee']; ?>% + <?php echo $webmoney['fee_fix']; ?></span>
                   </div>
                  </div>
                </label>
              </div>
              <?php endif; ?>
              <?php if ($local_bank['status'] == 1) : ?>
              <div class="radio-card">
                <input type="radio" class="planes-radio" name="method" value="local_bank" id="full-marca-blanca14"/>
                <label for="full-marca-blanca14" id="radio-label14">
                  <div class="row">
                    <div class="col-md-1 mt-3 mb-3 text-center">
                      <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/local_bank.png" class="win-img">
                    </div>
                     <div class="col-md-8 mt-12px mb-3">
                      <h5 class="mb-0">
                        <?php echo $local_bank['name']; ?>
                      </h5>
                       <?if($enabled_local_bank == FALSE){?><small class="text-danger"><?php echo lang('users withdrawal verify_error'); ?></small><?}else{?><small class="text-muted"><?php echo lang('users withdrawal manual'); ?> <?php echo lang('users withdrawal available'); ?> <?if($local_bank['debit_base'] == 1){?><a  data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $local_bank['minimum_debit_base']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $local_bank['maximum_debit_base']; ?>"><?php echo $this->currencys->display->base_code ?></a><?}else{?><?}?> <?if($local_bank['debit_extra1'] == 1){?><a  data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $local_bank['minimum_debit_extra1']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $local_bank['maximum_debit_extra1']; ?>"><?php echo $this->currencys->display->extra1_code ?></a><?}else{?><?}?> <?if($local_bank['debit_extra2'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $local_bank['minimum_debit_extra2']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $local_bank['maximum_debit_extra2']; ?>"><?php echo $this->currencys->display->extra2_code ?></a><?}else{?><?}?> <?if($local_bank['debit_extra3'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $local_bank['minimum_debit_extra3']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $local_bank['maximum_debit_extra3']; ?>"><?php echo $this->currencys->display->extra3_code ?></a><?}else{?><?}?> <?if($local_bank['debit_extra4'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $local_bank['minimum_debit_extra4']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $local_bank['maximum_debit_extra4']; ?>"><?php echo $this->currencys->display->extra4_code ?></a><?}else{?><?}?> <?if($local_bank['debit_extra5'] == 1){?><a href="#" data-tooltip="<?php echo lang('users withdrawal minimum'); ?>: <?php echo $local_bank['minimum_debit_extra5']; ?> <?php echo lang('users withdrawal maximum'); ?>: <?php echo $local_bank['maximum_debit_extra5']; ?>"><?php echo $this->currencys->display->extra5_code ?></a><?}else{?><?}?></small><?}?>
                    </div>
                   <div class="col-md-3 mt-22px mb-3 text-right">
                     <span class="badge badge-secondary"><?php echo $local_bank['fee']; ?>% + <?php echo $local_bank['fee_fix']; ?></span>
                   </div>
                  </div>
                </label>
              </div>
              <?php endif; ?>
          </div>
        </fieldset>
      </div>
      <div class="col-md-12 text-right mt-2">
         <button type="submit" class="btn btn-success"><?php echo lang('users transfer send'); ?></button>
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?> 
<script type="text/javascript">
    function MontoaRecibir(){
        var RadioTarifaId = $('input:radio[name=method]:checked').attr("id");
        var attrtext = "";
        $("label").each(function(){
            var atrfor   = $(this).attr("for");
            if(RadioTarifaId==atrfor){
                attrtext = $(this).find('span').text();
                attrtext = attrtext.split("+");
            }
        });
        var tarifa_porcentaje = parseFloat(attrtext[0].trim()) / 100;
        if(isNaN(tarifa_porcentaje)){
            $("#amount_received").val("0.00");
            return false;
        }
        var tarifa_monto      = attrtext[1].trim();
        
        var amount  = $("#amount_param").val();
        var amountp = (parseFloat(amount) * tarifa_porcentaje) + parseFloat(tarifa_monto);
        //console.log(amount+" - "+amountp);
        var n = parseFloat(amount) - parseFloat(amountp);
        //redondear
        (Math.round( n * 100 )/100 ).toString() //-> "1.1"
        var amount_received = n.toFixed(2);
        if (isNaN(amount_received) || parseFloat(amount_received)<=0) {
            $("#amount_received").val("0.00");
            return false;
        }
        $("#amount_received").val(amount_received);
    }
  
    window.onload = function() {
        $(":radio").change(function(){
           MontoaRecibir();
        });
    };
</script>