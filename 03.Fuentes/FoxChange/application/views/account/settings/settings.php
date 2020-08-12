<div class="row">
  <div class="col-md-4 mb-2">
    <h5><?php echo lang('users settings profile'); ?></h5>
  </div>
  <div class="col-md-8 mb-2 text-right">
    <div class="btn-group" role="group" aria-label="Basic example">
      <a href="<?php echo base_url('account/settings/logs'); ?>" class="btn btn-outline-secondary btn-sm"><i class="icon-lock icons"></i> <?php echo lang('users settings logs'); ?></a>
      <a href="<?php echo base_url('account/settings/verification'); ?>" class="btn btn-outline-secondary btn-sm"><i class="icon-user-following icons"></i> <?php echo lang('users settings verify'); ?></a>
      <a href="<?php echo base_url('account/settings/billing'); ?>" class="btn btn-outline-secondary btn-sm"><i class="icon-wallet icons"></i> <?php echo lang('users settings billing'); ?></a>
      <a href="<?php echo base_url('account/settings/security'); ?>" class="btn btn-outline-secondary btn-sm"><i class="icon-shield icons"></i> <?php echo lang('users security title'); ?></a>
    </div>
  </div>
</div>
<?php echo form_open('', array('role'=>'form')); ?>
<div class="card">
  <div class="card-body">
    <div class="row">
          <div class="form-group col-md-6">
            <label for="email"><?php echo lang('users settings email'); ?></label>
            <input type="text" class="form-control-blocked" id="name" value="<?php echo $user['email']; ?>" disabled>
          </div>
          <div class="form-group col-md-6">
            <label for="first_name"><?php echo lang('users settings first_name'); ?></label>
             <input type="text" class="form-control-blocked" id="name" value="<?php echo $user['first_name']; ?>" disabled>
          </div>
          <div class="form-group col-md-6">
            <label for="last_name"><?php echo lang('users settings last_name'); ?></label>
            <input type="text" class="form-control-blocked" id="name" value="<?php echo $user['last_name']; ?>" disabled>
          </div>
          <div class="form-group col-md-6">
            <label for="language"><?php echo lang('users settings language'); ?></label>
             <?php echo form_dropdown('language', $this->languages, (isset($user['language']) ? $user['language'] : $this->config->item('language')), 'id="language" class="form-control"'); ?>
          </div>
          <div class="form-group col-md-6">
            <label for="password"><?php echo lang('users settings password'); ?></label>
            <input type="password" class="form-control <?php echo form_error('password') ? ' is-invalid' : ''; ?>" name="password" id="password">
          </div>
          <div class="form-group col-md-6">
            <label for="password_repeat"><?php echo lang('users settings re_password'); ?></label>
            <input type="password" class="form-control <?php echo form_error('password_repeat') ? ' is-invalid' : ''; ?>" name="password_repeat" id="password_repeat">
          </div>
          <div class="col-md-10">
                 <p class="text-muted"><small><?php echo lang('users settings info'); ?></small></p>
              </div>
          <div class="col-md-6 text-left">
            <?php if($user['verify_status']==2): ?>
              <button type="button" id="btnAtm" class="btn btn-success"><?php echo lang('users button ATM'); ?></button>
            <?php else: ?>
              &nbsp;
            <?php endif; ?>
          </div>
          <div class="col-md-6 text-right">
              <button type="submit" class="btn btn-success"><?php echo lang('users button save'); ?></button>
          </div>

        
    </div>
  </div>
</div>
 <?php echo form_close(); ?> 