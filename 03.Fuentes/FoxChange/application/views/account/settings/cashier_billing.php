<div class="row">
  <div class="col-md-8 mb-2">
    <h5><?php echo lang('users settings cashier billing_req'); ?></h5>
  </div>
  <div class="col-md-4 mb-2 text-right">
    &nbsp;
  </div>
</div>
<div class="card">
  <div class="card-body">
    <?php if ($paypal['status'] == 1  and trim($user['paypal']) !='') : ?>
    <?php echo form_open(site_url("account/settings/update_method_cashier/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/paypal.png" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <input type="email" class="form-control" name="paypal" id="paypal" placeholder="<?php echo lang('users settings paypal'); ?>" value="<?php echo $user['paypal']; ?>" disabled>
                <?php if ($enabled_paypal == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
                <?php if (intval($user_cashier['paypal']) == 0 ) : ?>                      
                  <input type="hidden" name=method value="paypal">         
                  <button type="submit" class="btn btn-success btn-block"><?php echo lang('users cashier button select'); ?></button>
                <?php else: ?>
                  <?php $total_selected=$total_selected+1; ?> 
                  <?php echo lang('users cashier button selected'); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    <?php if ($credit_card['status'] == 1  and trim($user['card']) !='') : ?>
    <?php echo form_open(site_url("account/settings/update_method_cashier/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/visa.png" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <input type="text" class="form-control" name="card" id="card" placeholder="<?php echo lang('users settings card'); ?>" value="<?php echo $user['card']; ?>" disabled onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                <?php if ($enabled_credit_card == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
                <?php if (intval($user_cashier['card']) == 0 ) : ?>                      
                  <input type="hidden" name=method value="card">         
                  <button type="submit" class="btn btn-success btn-block"><?php echo lang('users cashier button select'); ?></button>
                <?php else: ?>
                  <?php $total_selected=$total_selected+1; ?> 
                  <?php echo lang('users cashier button selected'); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    <?php if ($bitcoin['status'] == 1  and trim($user['bitcoin']) !='') : ?>
    <?php echo form_open(site_url("account/settings/update_method_cashier/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/btc.png" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <input type="text" class="form-control" name="bitcoin" id="bitcoin" placeholder="<?php echo lang('users settings bitcoin'); ?>" value="<?php echo $user['bitcoin']; ?>" disabled>
                <?php if ($enabled_bitcoin == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
                <?php if (intval($user_cashier['bitcoin']) == 0 ) : ?>                      
                  <input type="hidden" name=method value="bitcoin">         
                  <button type="submit" class="btn btn-success btn-block"><?php echo lang('users cashier button select'); ?></button>
                <?php else: ?>
                  <?php $total_selected=$total_selected+1; ?> 
                  <?php echo lang('users cashier button selected'); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    <?php if ($skrill['status'] == 1  and trim($user['skrill']) !='') : ?>
    <?php echo form_open(site_url("account/settings/update_method_cashier/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/skrill.png" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <input type="text" class="form-control" name="skrill" id="skrill" placeholder="<?php echo lang('users settings skrill'); ?>" value="<?php echo $user['skrill']; ?>" disabled>
                <?php if ($enabled_skrill == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
                <?php if (intval($user_cashier['skrill']) == 0 ) : ?>                      
                  <input type="hidden" name=method value="skrill">         
                  <button type="submit" class="btn btn-success btn-block"><?php echo lang('users cashier button select'); ?></button>
                <?php else: ?>
                  <?php $total_selected=$total_selected+1; ?> 
                  <?php echo lang('users cashier button selected'); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    <?php if ($payza['status'] == 1 and trim($user['payza']) !='') : ?>
    <?php echo form_open(site_url("account/settings/update_method_cashier/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/payza.png" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <input type="text" class="form-control" name="payza" id="payza" placeholder="<?php echo lang('users settings payza'); ?>" value="<?php echo $user['payza']; ?>" disabled>
                <?php if ($enabled_payza == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
              <?php if (intval($user_cashier['payza']) == 0 ) : ?>                      
                  <input type="hidden" name=method value="payza">         
                  <button type="submit" class="btn btn-success btn-block"><?php echo lang('users cashier button select'); ?></button>
                <?php else: ?>
                  <?php $total_selected=$total_selected+1; ?> 
                  <?php echo lang('users cashier button selected'); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    <?php if ($advcash['status'] == 1 and trim($user['advcash']) !='') : ?>
    <?php echo form_open(site_url("account/settings/update_method_cashier/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/advcash.png" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <input type="text" class="form-control" name="advcash" id="advcash" placeholder="<?php echo lang('users settings advcash'); ?>" value="<?php echo $user['advcash']; ?>" disabled>
                <?php if ($enabled_advcash == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
                <?php if (intval($user_cashier['advcash']) == 0 ) : ?>                      
                  <input type="hidden" name=method value="advcash">         
                  <button type="submit" class="btn btn-success btn-block"><?php echo lang('users cashier button select'); ?></button>
                <?php else: ?>
                  <?php $total_selected=$total_selected+1; ?> 
                  <?php echo lang('users cashier button selected'); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    <?php if ($perfect_m['status'] == 1 and trim($user['perfect_m']) !='') : ?>
    <?php echo form_open(site_url("account/settings/update_method_cashier/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/pm.png" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <input type="text" class="form-control" name="perfect_m" id="perfect_m" placeholder="<?php echo lang('users settings perfect_m'); ?>" value="<?php echo $user['perfect_m']; ?>" disabled>
                <?php if ($enabled_perfect_m == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
                <?php if (intval($user_cashier['perfect_m']) == 0 ) : ?>                      
                  <input type="hidden" name=method value="perfect_m">         
                  <button type="submit" class="btn btn-success btn-block"><?php echo lang('users cashier button select'); ?></button>
                <?php else: ?>
                  <?php $total_selected=$total_selected+1; ?> 
                  <?php echo lang('users cashier button selected'); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    <?php if ($swift['status'] == 1 and trim($user['swift']) !='') : ?>
    <?php echo form_open(site_url("account/settings/update_method_cashier/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/swift.png" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <textarea class="form-control" name="swift" id="swift" rows="7"placeholder="<?php echo lang('users settings bank'); ?>" disabled><?php echo $user['swift']; ?></textarea>
                <?php if ($enabled_swift == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
                <?php if (intval($user_cashier['swift']) == 0 ) : ?>                      
                  <input type="hidden" name=method value="swift">         
                  <button type="submit" class="btn btn-success btn-block"><?php echo lang('users cashier button select'); ?></button>
                <?php else: ?>
                  <?php $total_selected=$total_selected+1; ?> 
                  <?php echo lang('users cashier button selected'); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    <?php if ($neteller['status'] == 1 and trim($user['neteller']) !='') : ?>
    <?php echo form_open(site_url("account/settings/update_method_cashier/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/Neteller.png" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <input type="text" class="form-control" name="neteller" id="neteller" placeholder="<?php echo lang('users settings neteller'); ?>" value="<?php echo $user['neteller']; ?>" disabled>
                <?php if ($enabled_neteller == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
                <?php if (intval($user_cashier['neteller']) == 0 ) : ?>                      
                  <input type="hidden" name=method value="neteller">         
                  <button type="submit" class="btn btn-success btn-block"><?php echo lang('users cashier button select'); ?></button>
                <?php else: ?>
                  <?php $total_selected=$total_selected+1; ?> 
                  <?php echo lang('users cashier button selected'); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    <?php if ($uphold['status'] == 1 and trim($user['uphold']) !='') : ?>
    <?php echo form_open(site_url("account/settings/update_method_cashier/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/Uphold.png" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <input type="text" class="form-control" name="uphold" id="uphold" placeholder="<?php echo lang('users settings uphold'); ?>" value="<?php echo $user['uphold']; ?>" disabled>
                <?php if ($enabled_uphold == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
              <?php if (intval($user_cashier['uphold']) == 0 ) : ?>                      
                  <input type="hidden" name=method value="uphold">         
                  <button type="submit" class="btn btn-success btn-block"><?php echo lang('users cashier button select'); ?></button>
                <?php else: ?>
                  <?php $total_selected=$total_selected+1; ?> 
                  <?php echo lang('users cashier button selected'); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    <?php if ($payeer['status'] == 1 and trim($user['payeer']) !='') : ?>
    <?php echo form_open(site_url("account/settings/update_method_cashier/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/payeer.png" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <input type="text" class="form-control" name="payeer" id="payeer" placeholder="<?php echo lang('users settings payeer'); ?>" value="<?php echo $user['payeer']; ?>" disabled>
                <?php if ($enabled_payeer == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
                <?php if (intval($user_cashier['payeer']) == 0 ) : ?>                      
                  <input type="hidden" name=method value="payeer">         
                  <button type="submit" class="btn btn-success btn-block"><?php echo lang('users cashier button select'); ?></button>
                <?php else: ?>
                  <?php $total_selected=$total_selected+1; ?> 
                  <?php echo lang('users cashier button selected'); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    <?php if ($airtm['status'] == 1 and trim($user['airtm']) !='') : ?>
    <?php echo form_open(site_url("account/settings/update_method_cashier/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/airtm.png" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <input type="text" class="form-control" name="airtm" id="airtm" placeholder="<?php echo lang('users settings airtm'); ?>" value="<?php echo $user['airtm']; ?>" disabled>
                <?php if ($enabled_airtm == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
              <?php if (intval($user_cashier['airtm']) == 0 ) : ?>                      
                <input type="hidden" name=method value="airtm">         
                <button type="submit" class="btn btn-success btn-block"><?php echo lang('users cashier button select'); ?></button>
                <?php else: ?>
                  <?php $total_selected=$total_selected+1; ?> 
                  <?php echo lang('users cashier button selected'); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    <?php if ($payoneer['status'] == 1 and trim($user['payoneer']) !='') : ?>
    <?php echo form_open(site_url("account/settings/update_method_cashier/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/payoneer.jpg" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <input type="text" class="form-control" name="payoneer" id="payoneer" placeholder="<?php echo lang('users settings payoneer'); ?>" value="<?php echo $user['payoneer']; ?>" disabled>
                <?php if ($enabled_payoneer == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
              <?php if (intval($user_cashier['payoneer']) == 0 ) : ?>                      
                <input type="hidden" name=method value="payoneer">         
                <button type="submit" class="btn btn-success btn-block"><?php echo lang('users cashier button select'); ?></button>
                <?php else: ?>
                  <?php $total_selected=$total_selected+1; ?> 
                  <?php echo lang('users cashier button selected'); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    <?php if ($webmoney['status'] == 1 and trim($user['webmoney']) !='') : ?>
    <?php echo form_open(site_url("account/settings/update_method_cashier/"), array("" => "")) ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 text-center mb-2">
                <img src="<?php echo base_url();?>assets/themes/account/img/pay-icon/webmoney.png" class="win-img">
              </div>
              <div class="col-md-9 mb-2">
                <input type="text" class="form-control" name="webmoney" id="webmoney" placeholder="<?php echo lang('users settings webmoney'); ?>" value="<?php echo $user['webmoney']; ?>" disabled>
                <?php if ($enabled_webmoney == FALSE) : ?><small class="form-text text-muted"><?php echo lang('users settings verify_req'); ?></small><?php endif; ?>
              </div>
              <div class="col-md-2 mb-2">
              <?php if (intval($user_cashier['webmoney']) == 0  ) : ?>                      
                <input type="hidden" name=method value="webmoney">         
                <button type="submit" class="btn btn-success btn-block"><?php echo lang('users cashier button select'); ?></button>
                <?php else: ?>
                  <?php $total_selected=$total_selected+1; ?> 
                  <?php echo lang('users cashier button selected'); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <?php endif; ?>
    
    <?php if ($user['status_ATM']==0) : ?>
      <?php if ($total_selected>0) : ?>
      <?php echo form_open(site_url("account/settings/send_cashier_request/"), array("" => "")) ?>
      <div class="row mt-3">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12 text-center mb-2">
                <button type="submit" class="btn btn-success btn-block"><?php echo lang('users cashier button send_request'); ?></button>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php echo form_close(); ?> 
      <?php else: ?>
        <?php echo form_open(site_url("account/settings/send_cashier_request/"), array("" => "")) ?>
      <div class="row mt-3">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12 text-center mb-2">
                  <?php echo lang('users cashier button select_one_msg'); ?>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php echo form_close(); ?> 
      <?php endif; ?>
    <?php else: ?>
      <?php echo form_open(site_url("account/settings/"), array("" => "")) ?>
      <div class="row mt-3">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12 text-center mb-2">
                <button type="button" class="btn btn-success btn-block"  onclick="location.href='../settings'"><?php echo lang('users cashier button back_settings'); ?></button>
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