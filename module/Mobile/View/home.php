
<?=$this->renderMob('header')?>
<div class="container-fluid"  id="home">

</div>


<script>
    $(document).ready(function(){
        carregarHome();
    });

   function carregarHome(){
       $.ajax({
           type:'POST',
           dataType:'text',
           url:'/mobile/home-pagination',
           async:true,
           cache:false,
           data:{

           },
           beforeSend: function(){
               $("#home").html(
                   '<div class="col-xs-12"><i class="fa fa-spin fa-spinner"></i></div>'
               );
           },
           success: function(data){
               $("#home").html(data);
           }

       });
   }

</script>
