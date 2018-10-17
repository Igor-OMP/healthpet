<?php if ($sucesso || $error || $info || $alert) : ?>
    <div class="container-alertas" ng-controller="MensagemCtrl">
        <?php if ($sucesso) : ?>
            <div class="bs-callout bs-callout-success">
                <?php echo $sucesso; ?>
            </div>
        <?php
        endif;
        if ($info) :
            ?>
            <div class="bs-callout bs-callout-info">
                <?php echo $info; ?>
            </div>
        <?php
        endif;
        if ($error) :
            ?>
            <div class="bs-callout bs-callout-danger">
                <?php echo $error; ?>
            </div>
        <?php
        endif;
        if ($alert) :
            ?>
            <div class="bs-callout bs-callout-warning">
                <?php echo $alert; ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>