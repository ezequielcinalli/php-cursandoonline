<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="{BASE_URL}">

    <title>Cursando-online</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" href="images/system/favicon.png" type="image/png">
</head>

{if $smarty.session}
<body data-role='{$smarty.session.ADMINISTRADOR}' data-iduser='{$smarty.session.ID}'>
{else}
<body data-role='0'>
{/if}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container justify-content-between">
            
            <a class="navbar-brand" href="inicio"><img class="logoHeader" src="images/system/logo.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarResponsive">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="inicio">Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="cursos">Cursos</a>
                    </li>
                </ul>
                <div>
                    {* display the php session ($_SESSION) *}
                    {if !$smarty.session}
                        <a href="usuarios/registro" class="btn btn-primary mx-2">Registro</a>
                        <a href="usuarios/ingreso" class="btn btn-primary">Ingresar</a>
                    {else}
                        <div class="d-flex">
                        {if $smarty.session.ADMINISTRADOR}
                            <div class="dropdown">
                                <button type="button" class="btn btn-outline-light dropdown-toggle ml-4 mt-1" data-toggle="dropdown">
                                    Administrar
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="categorias/administrar">Categorias</a>
                                    <a class="dropdown-item" href="cursos/administrar">Cursos</a>
                                    <a class="dropdown-item" href="usuarios/administrar">Usuarios</a>
                                </div>
                            </div>
                        {/if}
                            <div class="dropdown">
                                <button type="button" class="btn btn-outline-light dropdown-toggle ml-4 mt-1" data-toggle="dropdown">
                                    {$smarty.session.EMAIL}
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="usuarios/modificar">Perfil</a>
                                    <a class="dropdown-item" href="usuarios/logout">Logout</a>
                                </div>
                            </div>
                        </div>
                    {/if}
                </div>
            </div>
        </div>
    </nav>