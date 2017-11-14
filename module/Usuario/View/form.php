<div class="container">
    <h2 class="text-center">Cadastro de Usuário</h2>
    <hr>
    <div class="row">
        <div class="col-md-4 col-md-offset-1">
            <form action="<?=base_url('/usuario/salvar');?>" METHOD="post" class="form-horizontal">
               <div class="form-group">
                   <label for="nm_usuario">Nome</label>
                   <input type="text" name="nm_usuario" class="form-control">
               </div>
                <div class="form-group">
                    <label for="nm_usuario">Email</label>
                    <input type="email" name="em_email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nm_usuario">Telefone</label>
                    <input type="telefone" name="nr_tel" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                       Salvar
                    </button>
                    <button class="btn btn-default" style="margin-left: 50px;">
                        <a href="<?=base_url('usuario');?>">Cancelar </a>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>