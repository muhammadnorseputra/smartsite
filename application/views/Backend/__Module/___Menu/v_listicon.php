<div class="container-fluid">
<div class="row">
  <?php foreach($geticon->result() as $i): ?>
  <div class="col-sm-3" >
    <?php if($geticonid != $i->nama_icon){ ?>
    <a href="javascript:void(0)" title="<?= $i->nama_icon ?>" onclick="changeicon('<?= $i->nama_icon ?>')">
      <i class="material-icons"><?= $i->nama_icon ?></i>
    </a>
    <?php } else { ?>
      <i class="material-icons"><?= $i->nama_icon ?></i>
    <?php } ?>
  </div>
  <?php endforeach ?>
</div>
</div>
