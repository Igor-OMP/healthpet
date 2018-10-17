<?php
if(!empty($banners) ):
    $count_banner = count($banners);
?>
    <div id="banner" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php for($i=0;$i<$count_banner;$i++):?>
                <li data-target="#myCarousel" data-slide-to="<?=$i?>" class="active"></li>
            <?php endfor;?>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox" >

            <?php foreach($banners as  $key => $b):

                if($key == 0):
            ?>
                    <div class="item active">
                        <img src="<?=$b['img_banner']?>" alt="<?=$b['tx_descricao']?>" width="1583px" height="300" >
                        <!-- <div class="carousel-caption">
                             <h3>Chania</h3>
                             <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
                         </div>-->
                    </div>
            <?php else:?>
                    <div class="item">
                        <img src="<?=$b['img_banner']?>" alt="<?=$b['tx_descricao']?>" width="1583" height="300">
                        <!-- <div class="carousel-caption">
                             <h3>Chania</h3>
                             <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
                         </div>-->
                    </div>
            <?php endif;?>

            <?php endforeach; ?>

        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#banner" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#banner" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
<?php endif ;?>