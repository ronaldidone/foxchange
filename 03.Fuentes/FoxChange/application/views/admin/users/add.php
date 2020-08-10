<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php echo form_open('', array('role'=>'form')); ?>
<div class="row">
<div class="col-md-12">
    <div class="card">
      <div class="card-title">
         
      </div>
      <div class="card-body">
          <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php echo form_label(lang('admin user email'), 'email', array('class'=>'control-label')); ?>
                      <span class="required">*</span>
                      <?php echo form_input(array('name'=>'email', 'value'=>set_value('email', (isset($user['email']) ? $user['email'] : '')), 'class'=>'form-control form-control-sm')); ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php echo form_label(lang('admin user first_name'), 'first_name', array('class'=>'control-label')); ?>
                      <span class="required">*</span>
                      <?php echo form_input(array('name'=>'first_name', 'value'=>set_value('first_name', (isset($user['first_name']) ? $user['first_name'] : '')), 'class'=>'form-control form-control-sm')); ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php echo form_label(lang('admin user last_name'), 'last_name', array('class'=>'control-label')); ?>
                      <span class="required">*</span>
                      <?php echo form_input(array('name'=>'last_name', 'value'=>set_value('last_name', (isset($user['last_name']) ? $user['last_name'] : '')), 'class'=>'form-control form-control-sm')); ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php echo form_label(lang('admin user language'), 'language', array('class'=>'control-label')); ?>
                      <span class="required">*</span>
                      <?php echo form_dropdown('language', $this->languages, (isset($user['language']) ? $user['language'] : $this->config->item('language')), 'id="language" class="form-control form-control-sm"'); ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                     <?php echo form_label(lang('admin user admin'), 'language', array('class'=>'control-label')); ?>
                          <span class="required">*</span>
                          <select class="form-control form-control-sm" name="is_admin">
                            <option value="1" <?if($user['is_admin']=="1"){?>selected<?}else{?><?}?>><?php echo lang('admin user yes'); ?></option>
                            <option value="0" <?if($user['is_admin']=="0"){?>selected<?}else{?><?}?>><?php echo lang('admin user no'); ?></option>
                          </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php echo form_label(lang('admin user status'), 'language', array('class'=>'control-label')); ?>
                          <span class="required">*</span>
                          <select class="form-control form-control-sm" name="status">
                            <option value="1" <?if($user['status']=="1"){?>selected<?}else{?><?}?>><?php echo lang('admin user active'); ?></option>
                            <option value="0" <?if($user['status']=="0"){?>selected<?}else{?><?}?>><?php echo lang('admin user inactive'); ?></option>
                          </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php echo form_label(lang('admin user password'), 'password', array('class'=>'control-label')); ?>
                      <?php if ($password_required) : ?><span class="required">*</span><?php endif; ?>
                      <?php echo form_password(array('name'=>'password', 'value'=>'', 'class'=>'form-control form-control-sm', 'autocomplete'=>'off')); ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php echo form_label(lang('admin user re_password'), 'password_repeat', array('class'=>'control-label')); ?>
                      <?php if ($password_required) : ?><span class="required">*</span><?php endif; ?>
                      <?php echo form_password(array('name'=>'password_repeat', 'value'=>'', 'class'=>'form-control form-control-sm', 'autocomplete'=>'off')); ?>
                    </div>
                  </div>
                  <div class="col-md-12 -text-right">
                    <button type="submit"  class="btn btn-success btn-sm"> <?php echo lang('core button save'); ?></button>
                  </div>
                </div>
                 <?php echo form_close(); ?>