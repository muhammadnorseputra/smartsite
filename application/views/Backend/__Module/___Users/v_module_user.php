<div class="card card-shadow">
  <div class="body">
    
    <?= form_open('backend/module/c_users/update_module_user', array('id' => 'FormUpdateModuleUsers')); ?>
    <input type="hidden" name="id_user" value="<?= $users[0]->id_user ?>">
    <input type="hidden" name="modules" value="<?= $token ?>">
    
      <table class="table table-condensed m-t-15">
        <tr>
          <td width="120">Nama Lengkap</td>
          <td class="font-bold"><?= $users[0]->nama_lengkap ?></td>
        </tr>
        <tr>
          <td>Module</td>
          <td>
          <!-- <div class="well">
            <?php 
              foreach($module as $mod):
            ?>
                
              <input type="checkbox" <?= in_array($mod->token, explode(",",$users[0]->fid_token)) ? 'checked="checked"': ''; ?> name="fid_token[]" id="<?= $mod->id_module ?>" class="filled-in" value="<?= $mod->token ?>">
              <label for="<?= $mod->id_module ?>"><?= ucwords($mod->nama_module) ?></label>
              
            <?php endforeach; ?>
          </div> -->
          <select multiple="multiple" id="my-select" name="fid_token[]">
            <?php 
              foreach($module as $mod):
            ?>
            <option id="<?= $mod->id_module ?>" value='<?= $mod->token ?>' <?= in_array($mod->token, explode(",",$users[0]->fid_token)) ? 'selected': ''; ?>><?= ucwords($mod->nama_module) ?></option>
            <?php endforeach; ?>
          </select>
          </td>
        </tr>
        <tr>
        <td colspan="3">
          <button type="submit" id="c_module_simpan" class="btn btn-link bg-white btn-rounded waves-effect waves-white waves-float pull-right"> Simpan Perubahan</button>
          <button type="button" id="c_module_batal" class="btn btn-link bg-red btn-rounded waves-effect waves-white waves-float m-r-5 pull-right"> Batal</button>
        </td>
        </tr>
        
			</div>
      </table>
      
  </div>
</div>
      <?= form_close(); ?>
    
      <script>
        $(function() {
          $('#my-select').multiSelect({
            selectableHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Pencarian Module'>",
            selectionHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Pencarian User Module'>",
            selectableFooter: "<div class='bg-black p-l-15 p-t-15 p-b-15'>All Module</div>",
            selectionFooter: "<div class='bg-blue-grey p-l-15 p-t-15 p-b-15'>User Module</div>",
            afterInit: function(ms){
              var that = this,
                  $selectableSearch = that.$selectableUl.prev(),
                  $selectionSearch = that.$selectionUl.prev(),
                  selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                  selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

              that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
              .on('keydown', function(e){
                if (e.which === 40){
                  that.$selectableUl.focus();
                  return false;
                }
              });

              that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
              .on('keydown', function(e){
                if (e.which == 40){
                  that.$selectionUl.focus();
                  return false;
                }
              });
            },
            afterSelect: function(){
              this.qs1.cache();
              this.qs2.cache();
            },
            afterDeselect: function(){
              this.qs1.cache();
              this.qs2.cache();
            }
          });
        });
      </script>