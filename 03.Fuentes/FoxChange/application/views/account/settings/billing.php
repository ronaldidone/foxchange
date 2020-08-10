<div class="row">
  <div class="col-md-4 mb-2">
    <h5><?php echo lang('users settings billing'); ?></h5>
  </div>
  <div class="col-md-8 mb-2 text-right">
    <div class="btn-group" role="group" aria-label="Basic example">
      <a href="<?php echo base_url('account/settings/logs'); ?>" class="btn btn-outline-secondary btn-sm"><i class="icon-lock icons"></i> <?php echo lang('users settings logs'); ?></a>
      <a href="<?php echo base_url('account/settings/verification'); ?>" class="btn btn-outline-secondary btn-sm"><i class="icon-user-following icons"></i> <?php echo lang('users settings verify'); ?></a>
      <a href="<?php echo base_url('account/settings/billing'); ?>" class="btn btn-outline-secondary btn-sm active"><i class="icon-wallet icons"></i> <?php echo lang('users settings billing'); ?></a>
      <a href="<?php echo base_url('account/settings/security'); ?>" class="btn btn-outline-secondary btn-sm"><i class="icon-shield icons"></i> <?php echo lang('users security title'); ?></a>
    </div>
  </div>
</div>
<div class="card">
  <div class="card-body">
    <?php if ($paypal['status'] == 1) : ?>
    <?php echo form_open(site_url("account/settings/update_paypal/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/paypal.png" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <input type="email" class="form-control" name="paypal" id="paypal" placeholder="<?php echo lang('users settings paypal'); ?>" value="<?php echo $user['paypal']; ?>" <?php if ($enabled_paypal == FALSE) : ?>disabled<?php endif; ?>>
                <?php if ($enabled_paypal == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
                <button type="submit" class="btn btn-success btn-block"><?php echo lang('users button save'); ?></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    <?php if ($credit_card['status'] == 1) : ?>
    <?php echo form_open(site_url("account/settings/update_credit_card/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/visa.png" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <input type="text" class="form-control" name="card" id="card" placeholder="<?php echo lang('users settings card'); ?>" value="<?php echo $user['card']; ?>" <?php if ($enabled_credit_card == FALSE) : ?>disabled<?php endif; ?> onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                <?php if ($enabled_credit_card == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
                <button type="submit" class="btn btn-success btn-block"><?php echo lang('users button save'); ?></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    <?php if ($bitcoin['status'] == 1) : ?>
    <?php echo form_open(site_url("account/settings/update_bitcoin/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/btc.png" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <input type="text" class="form-control" name="bitcoin" id="bitcoin" placeholder="<?php echo lang('users settings bitcoin'); ?>" value="<?php echo $user['bitcoin']; ?>" <?php if ($enabled_bitcoin == FALSE) : ?>disabled<?php endif; ?>>
                <?php if ($enabled_bitcoin == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
                <button type="submit" class="btn btn-success btn-block"><?php echo lang('users button save'); ?></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    <?php if ($skrill['status'] == 1) : ?>
    <?php echo form_open(site_url("account/settings/update_skrill/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/skrill.png" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <input type="text" class="form-control" name="skrill" id="skrill" placeholder="<?php echo lang('users settings skrill'); ?>" value="<?php echo $user['skrill']; ?>" <?php if ($enabled_skrill == FALSE) : ?>disabled<?php endif; ?>>
                <?php if ($enabled_skrill == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
                <button type="submit" class="btn btn-success btn-block"><?php echo lang('users button save'); ?></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    <?php if ($payza['status'] == 1) : ?>
    <?php echo form_open(site_url("account/settings/update_payza/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/payza.png" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <input type="text" class="form-control" name="payza" id="payza" placeholder="<?php echo lang('users settings payza'); ?>" value="<?php echo $user['payza']; ?>" <?php if ($enabled_payza == FALSE) : ?>disabled<?php endif; ?>>
                <?php if ($enabled_payza == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
                <button type="submit" class="btn btn-success btn-block"><?php echo lang('users button save'); ?></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    <?php if ($advcash['status'] == 1) : ?>
    <?php echo form_open(site_url("account/settings/update_advcash/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/advcash.png" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <input type="text" class="form-control" name="advcash" id="advcash" placeholder="<?php echo lang('users settings advcash'); ?>" value="<?php echo $user['advcash']; ?>" <?php if ($enabled_advcash == FALSE) : ?>disabled<?php endif; ?>>
                <?php if ($enabled_advcash == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
                <button type="submit" class="btn btn-success btn-block"><?php echo lang('users button save'); ?></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    <?php if ($perfect_m['status'] == 1) : ?>
    <?php echo form_open(site_url("account/settings/update_perfect_m/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/pm.png" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <input type="text" class="form-control" name="perfect_m" id="perfect_m" placeholder="<?php echo lang('users settings perfect_m'); ?>" value="<?php echo $user['perfect_m']; ?>" <?php if ($enabled_perfect_m == FALSE) : ?>disabled<?php endif; ?>>
                <?php if ($enabled_perfect_m == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
                <button type="submit" class="btn btn-success btn-block"><?php echo lang('users button save'); ?></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    <?php if ($swift['status'] == 1) : ?>
    <?php echo form_open(site_url("account/settings/update_swift/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/swift.png" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <textarea class="form-control" name="swift" id="swift" rows="7"placeholder="<?php echo lang('users settings bank'); ?>" <?php if ($enabled_swift == FALSE) : ?>disabled<?php endif; ?>><?php echo $user['swift']; ?></textarea>
                <?php if ($enabled_swift == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
                <button type="submit" class="btn btn-success btn-block"><?php echo lang('users button save'); ?></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    <?php if ($neteller['status'] == 1) : ?>
    <?php echo form_open(site_url("account/settings/update_neteller/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/Neteller.png" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <input type="text" class="form-control" name="neteller" id="neteller" placeholder="<?php echo lang('users settings neteller'); ?>" value="<?php echo $user['neteller']; ?>" <?php if ($enabled_neteller == FALSE) : ?>disabled<?php endif; ?>>
                <?php if ($enabled_neteller == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
                <button type="submit" class="btn btn-success btn-block"><?php echo lang('users button save'); ?></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    <?php if ($uphold['status'] == 1) : ?>
    <?php echo form_open(site_url("account/settings/update_uphold/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/Uphold.png" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <input type="text" class="form-control" name="uphold" id="uphold" placeholder="<?php echo lang('users settings uphold'); ?>" value="<?php echo $user['uphold']; ?>" <?php if ($enabled_uphold == FALSE) : ?>disabled<?php endif; ?>>
                <?php if ($enabled_uphold == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
                <button type="submit" class="btn btn-success btn-block"><?php echo lang('users button save'); ?></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    <?php if ($payeer['status'] == 1) : ?>
    <?php echo form_open(site_url("account/settings/update_payeer/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/payeer.png" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <input type="text" class="form-control" name="payeer" id="payeer" placeholder="<?php echo lang('users settings payeer'); ?>" value="<?php echo $user['payeer']; ?>" <?php if ($enabled_payeer == FALSE) : ?>disabled<?php endif; ?>>
                <?php if ($enabled_payeer == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
                <button type="submit" class="btn btn-success btn-block"><?php echo lang('users button save'); ?></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    <?php if ($airtm['status'] == 1) : ?>
    <?php echo form_open(site_url("account/settings/update_airtm/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/airtm.png" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <input type="text" class="form-control" name="airtm" id="airtm" placeholder="<?php echo lang('users settings airtm'); ?>" value="<?php echo $user['airtm']; ?>" <?php if ($enabled_airtm == FALSE) : ?>disabled<?php endif; ?>>
                <?php if ($enabled_airtm == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
                <button type="submit" class="btn btn-success btn-block"><?php echo lang('users button save'); ?></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    <?php if ($payoneer['status'] == 1) : ?>
    <?php echo form_open(site_url("account/settings/update_payoneer/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/payoneer.jpg" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <input type="text" class="form-control" name="payoneer" id="payoneer" placeholder="<?php echo lang('users settings payoneer'); ?>" value="<?php echo $user['payoneer']; ?>" <?php if ($enabled_payoneer == FALSE) : ?>disabled<?php endif; ?>>
                <?php if ($enabled_payoneer == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
                <button type="submit" class="btn btn-success btn-block"><?php echo lang('users button save'); ?></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    <?php if ($webmoney['status'] == 1) : ?>
    <?php echo form_open(site_url("account/settings/update_webmoney/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/webmoney.png" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <input type="text" class="form-control" name="webmoney" id="webmoney" placeholder="<?php echo lang('users settings webmoney'); ?>" value="<?php echo $user['webmoney']; ?>" <?php if ($enabled_webmoney == FALSE) : ?>disabled<?php endif; ?>>
                <?php if ($enabled_webmoney == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
                <button type="submit" class="btn btn-success btn-block"><?php echo lang('users button save'); ?></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
  </div>
</div>