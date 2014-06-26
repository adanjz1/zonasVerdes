<html>
    <body>
        
        <h1>{mensajeBienvenida}</h1>
        <form action="/index.php/usuarios/login" method="POST">
            Usuario: <input type="text" name="username" value="<?=((!empty($datosUsuario[0]->username))?$datosUsuario[0]->username:'')?>">
            Password: <input type="password" name="password">
            <input type="submit">
        </form>
        {datosUsuario}
            {id}
            {username}
            {password}
        {/datosUsuario}
    </body>
</html>
