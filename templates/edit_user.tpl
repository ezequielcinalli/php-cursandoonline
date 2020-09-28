{include file="templates/navbar.tpl"}
<div class="container">
    <h1 class="text-center">Mi perfil</h1>
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            {if $user}
                <div class="card card-signin mb-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Modificar datos</h5>
                        <form class="form-signin" action="usuarios/modificar/{$user->id}" method="POST">
                            <label for="email">Email</label>
                            <input name="email" type="email" class="form-control mb-2" value="{$user->email}" required>
    
                            <label for="pass">Password</label>
                            <input name="pass" type="password" class="form-control mb-2" required>
    
                            <label for="nombre">Nombre</label>
                            <input name="nombre" type="text" class" class="form-control mb-2" value="{$user->nombre}" required>
    
                            <label for="telefono">Telefono</label>
                            <input name="telefono" type="text" class="form-control mb-2" value="{$user->telefono}" required>
    
                            <button class="btn btn-lg btn-success btn-block mb-2" type="submit">Modificar</button>
                            <a href="inicio" class="btn btn-lg btn-danger btn-block mb-2" type="submit">Cancelar</a>
                        </form>
                    </div>
                </div>
            {else}
                <div class="alert alert-success" role="alert">
                    Su perfil fue actualizado con exito!
                </div>
            {/if}
        </div>
    </div>
</div>
{include file="templates/footer.tpl"}