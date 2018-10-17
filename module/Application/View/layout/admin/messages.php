<?php
$alert = (isset($msg['alert']))?$msg['alert']:((isset($_SESSION['flash_message']))?$_SESSION['flash_message']['alert']:null);
unset($_SESSION['flash_message']);
#x($alert);

if($alert):
if($alert['status'] =='SUCCESS'):?>
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success fade in alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <strong>Success!</strong> <?= $alert['msg'] ?>
        </div>
    </div>
</div>
<?php endif?>


<?php if($alert['status'] =='INFO'):?>
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-info fade in alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <strong>Info!</strong> <?= $alert['msg'] ?>
        </div>
    </div>
</div>
<?php endif ?>


<?php  if($alert['status'] =='WARNING'):?>
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-warning fade in alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <strong>Warning!</strong> <?= $alert['msg'] ?>.
        </div>
    </div>
</div>
<?php endif ?>

<?php if($alert['status'] =='DANGER'): ?>
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger fade in alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <strong>Danger!</strong> <?= $alert['msg'] ?>.
        </div>
    </div>
</div>
<?php endif;
endif;

?>

