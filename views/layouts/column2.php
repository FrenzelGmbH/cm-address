<?php $this->beginContent('@app/views/layouts/'.\frenzelgmbh\cmaddress\Module::getMainLayout().'.php'); ?>
<div id="content">
  <div class="row">
    <div class="col-md-4">      
      <?= $this->blocks['sidebar']; ?>
    </div>
    <div class="col-md-8">
      <div class="cm-address">
        <?= $content; ?>
      </div>
    </div>
  </div> 
</div><!-- container -->
<?php $this->endContent(); ?>
