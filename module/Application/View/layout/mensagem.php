<?php if ($tipo == NAMESPACE_SUCCESS): ?>
    <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Sucesso:</strong> <?= $msg; ?>
    </div>
<?php endif; ?>
<?php if ($tipo == NAMESPACE_ERROR): ?>
    <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Erro:</strong> <?= $msg; ?>
    </div>
<?php endif; ?>
<?php if ($tipo == NAMESPACE_INFO): ?>
    <div class="alert alert-info alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Info:</strong> <?= $msg; ?>
    </div>
<?php endif; ?>
<?php if ($tipo == NAMESPACE_WARNING): ?>
    <div class="alert alert-warning alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Atenção:</strong> <?= $msg; ?>
    </div>
<?php endif; ?>


