<div class="row clearfix m-t-25">
	<div class="col-xs-12 col-sm-3">
		<div class="card profile-card">
			<div class="profile-header bg-<?= $this->ma->aktifskin('t_skin','Y'); ?>"><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p></div>
			<div class="profile-body">
				<div class="image-area">
					<img src="<?= site_url('assets/images/users/'.$this->session->userdata('gravatar')) ?>" alt="<?= $this->session->userdata('user') ?>" width="120"/>
				</div>
				<div class="content-area">
					<h4 id="nama_lengkap"></h4>
					<p class="font-12" id="emailuser"></p>
          <p  id="leveluser" class="font-bold text-info"></p>
          <input type="hidden" name="userkey" value="<?= $this->session->userdata('userkey') ?>">
				</div>
			</div>
			<div class="profile-footer">
				<ul>
					<li>
						<span><b class="text-danger">Berita</b></span>
						<span>1.234</span>
					</li>
					<li>
						<span><b class="text-info">Gallery</b></span>
						<span>1.201</span>
					</li>
					<li class="text-center">
						<span><b class="text-success">Terakhir Login</b></span><br>
						<b class="font-12" id="lastLogon"></b>
					</li>
				</ul>
			</div>
		</div>

	</div>
	<div class="col-xs-12 col-sm-9">
		<div class="card">
			<div class="body">
				<div>
					<ul class="nav nav-tabs tab-col-<?= $this->ma->aktifskin('t_skin','Y'); ?>" role="tablist">
						<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Umum</a></li>
						<li role="presentation"><a href="#profile_settings" aria-controls="settings" role="tab" data-toggle="tab">Pengaturan Profile</a></li>
						<li role="presentation"><a href="#change_password_settings" aria-controls="settings" role="tab" data-toggle="tab">Ubah Password</a></li>
					</ul>

					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="home">
							<div class="panel panel-default panel-post">
								<div class="panel-heading">
									<div class="media">
										<div class="media-left">
											<a href="#">
												<img src="../../images/user-lg.jpg" />
											</a>
										</div>
										<div class="media-body">
											<h4 class="media-heading">
												<a href="#">Marc K. Hammond</a>
											</h4>
											Shared publicly - 26 Oct 2018
										</div>
									</div>
								</div>
								<div class="panel-body">
									<div class="post">
										<div class="post-heading">
											<p>I am a very simple wall post. I am good at containing <a href="#">#small</a> bits of <a href="#">#information</a>.
												I require little more information to use effectively.</p>
										</div>
										<div class="post-content">
											<!-- <img src="../../images/profile-post-image.jpg" class="img-responsive" /> -->
										</div>
									</div>
								</div>
								<div class="panel-footer">
									<ul>
										<li>
											<a href="#">
												<i class="material-icons">thumb_up</i>
												<span>12 Likes</span>
											</a>
										</li>
										<li>
											<a href="#">
												<i class="material-icons">comment</i>
												<span>5 Comments</span>
											</a>
										</li>
										<li>
											<a href="#">
												<i class="material-icons">share</i>
												<span>Share</span>
											</a>
										</li>
									</ul>

									<div class="form-group">
										<div class="form-line">
											<input type="text" class="form-control" placeholder="Type a comment" />
										</div>
									</div>
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane fade in" id="profile_settings">
            <?= form_open('backend/admin/updateprofile', array('class' => 'form-horizontal', 'id' => 'FormUpdateProfile')) ?>
                <?php if($this->session->userdata('lvl') == 'ADMIN'): ?>
                <div class="form-group">
									<label for="Userame" class="col-sm-2 control-label">Username</label>
									<div class="col-sm-10">
										<div class="form-line">
											<input type="text" class="form-control" id="Username" name="Username" placeholder="Name Surname">
										</div>
									</div>
                </div>   
                <?php endif ?>
								<div class="form-group">
									<label for="NameSurname" class="col-sm-2 control-label">Nama Lengkap</label>
									<div class="col-sm-10">
										<div class="form-line">
											<input type="text" class="form-control" id="NameSurname" name="NameSurname" placeholder="Name Surname">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="Email" class="col-sm-2 control-label">Email</label>
									<div class="col-sm-10">
										<div class="form-line">
											<input type="email" class="form-control" id="Email" name="Email" placeholder="Email">
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<button type="submit" class="btn btn-danger">UPDATE</button>
									</div>
								</div>
							<?= form_close() ?>
						</div>
						<div role="tabpanel" class="tab-pane fade in" id="change_password_settings">
            <div class="alert bg-teal alert-dismissible" role="alert">
                <b>Password</b> akan terupdate setelah sesi anda berakhir ! ( <a href="javascript:void(0);" class="alert-link" onclick="menu_info('logout')">Logout</a> )
            </div>
							<?= form_open('backend/admin/gantipass', array('class' => 'form-horizontal', 'id' => 'FormGantiPass')) ?>
								<div class="form-group">
									<label for="username" class="col-sm-3 control-label">Username</label>
									<div class="col-sm-9">
										<div class="form-line">
											<input type="text" class="form-control bg-grey" id="username" name="username" disabled>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="NewPassword" class="col-sm-3 control-label">New Password</label>
									<div class="col-sm-9">
										<div class="form-line">
											<input type="password" class="form-control" id="NewPassword" name="NewPassword" placeholder="New Password">
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-3 col-sm-9">
										<button type="submit" class="btn btn-danger">SIMPAN</button>
									</div>
								</div>
							<?= form_close() ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

  viewProfile();
  function viewProfile()
  {
    var iduser = jQuery("[name='userkey']").val();
    jQuery.get('<?= site_url("backend/admin/viewprofile") ?>', {userkey: iduser}, function(responses){
      
      //panel profile
      jQuery("h4#nama_lengkap").html(responses[0].nama_lengkap);
      jQuery("p#emailuser").html(responses[0].email);
      jQuery("p#leveluser").html(responses[0].level);
      jQuery("b#lastLogon").html(responses[0].sesi_login);

      //tab ganti profile
			let username = responses[0].username;
      jQuery("input#Username, input#username").val(username);
      jQuery("input#NameSurname").val(responses[0].nama_lengkap);
      jQuery("input#Email").val(responses[0].email);

    }, 'json');
  }

//##################################################################
jQuery("#FormGantiPass").on('submit', function(e){
  e.preventDefault();
  var form = jQuery(this),
      f_pass = jQuery("#NewPassword").val();
  if(f_pass != '')
  {
     jQuery.post(form.attr('action'), {pass: f_pass}, function(responses){
      if(responses.result.type == 'success')
      {
        showNotification('bg-teal', 'Success, Password Terganti.', 'bottom', 'center', 'animated fadeInUp', 'animated fadeOutDown');
      }
      else if(responses.result.type == 'error')
      {
        swal('Warning !', 'Terjadi Kesalahan', 'warning');
      }
      f_pass.val('');
     }, 'json'); 
  }
  else 
  {
    swal('Error !', 'Password Tidak Boleh Kosong', 'error');
  }
});


//##################################################################
jQuery("#FormUpdateProfile").on('submit', function(e){
  e.preventDefault();
  var form = jQuery(this);

    jQuery.post(form.attr('action'), form.serialize(), function(responses){
      if(form['NameSurname'] != '')
      {
      showNotification('bg-teal', 'Success Profile Updated <br><b>'+responses.surname+'</b>.', 'bottom', 'center', 'animated fadeInUp', 'animated fadeOutDown');
			viewProfile();
      } else {
        swal('Warning', 'Terjadi Kesalahan', 'warning');
      }
    }, 'json'); 
  
});


</script>