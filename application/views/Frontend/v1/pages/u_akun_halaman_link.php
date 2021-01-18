<h4 class="px-3 py-3 border-bottom border-light animated fadeIn">Halaman Link</h4>
<section class="my-3 mx-3">
	<div class="container">
		<div class="row">
		<?php 
			// var_dump($data_submenu) 
		?>
		<select name="submenu" class="custom-select">
		  <option value="">-- Pilih menu --</option>
		  <?php foreach ($data_submenu as $d): ?>
		  	<option value="<?= $d->idsub ?>"><?= $d->nama_sub ?></option>
		  <?php endforeach ?>
		</select>
		<table class="table table-borderless">
			<tbody>
				<tr>
					<td width="30">Token</td>
					<td width="20">:</td>
					<td class="token">-</td>
				</tr>
				<tr>
					<td width="30">Link</td>
					<td width="20">:</td>
					<td class="link">-</td>
				</tr>
				<tr>
					<td colspan="3">
						<div class="form-inline">
							<div class="input-group mb-2 mr-sm-2">
							    <div class="input-group-prepend">
							      <div class="input-group-text"><i class="fas fa-link"></i></div>
							    </div>
							    <input type="text" class="form-control" name="f_token" id="f_token" placeholder="Paste token baru disini."> <button disabled="disabled" type="button" class="btn btn-outline-primary rounded-0 ml-2" id="save-token"> simpan</button>
							  </div>
						</div>	
					</td>
				</tr>
				
			</tbody>
		</table>
		</div>
	</div>
</section>
<script>
	$("select[name='submenu']").on("change", function() {
		if($(this).val() != '') {
			$.getJSON(_uri+'/frontend/v1/users/getsubmenubyid', {id: $(this).val()}, function(res) {
				// console.log(res);
				let link = res.link_sub;
				let slice = link.split("/");
				if(typeof slice[2] == 'undefined') {
				$("button#save-token").prop('disabled', false);
					$("table tr td.link").html(`${_uri}/${link}`);
				 return	$("table tr td.token").html(`-`);	
				}
				$("table tr td.token").html(`${slice[2]}`);
				$("table tr td.link").html(`${_uri}/${link}`);
				$("button#save-token").prop('disabled', false);
			});
		} else {
			$("table tr td.token").html(`-`);
			$("table tr td.link").html(`-`);	
			$("button#save-token").prop('disabled', true);
		}
	});

	$("button#save-token").unbind().bind("click", function() {
		let val = $("input[name='f_token']").val();
		let id  = $("select[name='submenu']").val();
		// alert(id);
		$.post(`${_uri}/frontend/v1/users/updatelinkhalaman/${id}`, {txt: val}, function(res) {
			if(res != false){
				notif({
					msg: `Updated Sukses Token (</b>${res.newtoken}<b>)`,
					type: "success",
					position: "bottom"
				});
				$("table tr td.token").html(`${res.newtoken}`);
				$("table tr td.link").html(`${_uri}/${res.newlink}`);
				return true;
			}
			return notif({
					msg: "<b>Error</b> Token Kosong",
					type: "error",
					position: "bottom"
				});
		}, 'json');
	})
</script>