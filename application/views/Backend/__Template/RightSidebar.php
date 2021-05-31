 <!-- Right Sidebar -->
 <aside id="rightsidebar" class="right-sidebar">
 	<ul class="nav nav-tabs tab-nav-right" role="tablist">
 		<li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
 	</ul>
 	<div class="tab-content">
 		<div role="tabpanel" class="tab-pane fade in active in active" id="skins">
        <input type="hidden" name="id_skin_active" value="">
 			<ul class="demo-choose-skin" style="overflow-y:scroll; height:490px;">
 				<?php foreach ($skin as $v): ?>
 				<?php
                    
                        if($v->aktif == 'Y'){
                            $ac = 'class="active"';
                        }else{
                            $ac = '';
                        }
                    ?>
 				<li id="change_theme" 
                    data-id="<?= $v->idskin ?>"
                    data-active="<?php echo site_url("backend/c_admin/update_skin") ?>"
                    data-id-active="<?= $this->madmin->aktifskinid('t_skin','Y'); ?>"
 					data-off="<?php echo site_url("backend/c_admin/update_skin_n") ?>"
 					data-theme="<?= strtolower($v->color) ?>" <?= $ac ?>>
 					<div class="<?= strtolower($v->color) ?>"></div>
 					<span><?= ucwords($v->color_name) ?></span>
 				</li>
 				<?php endforeach; ?>
 			</ul>
 		</div>

 	</div>
 </aside>
 <!-- #END# Right Sidebar -->