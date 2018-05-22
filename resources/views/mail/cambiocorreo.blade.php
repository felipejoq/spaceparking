<p>Hola {{ $usuario->name }}!</p>
<p>Te comentamos que acabamos de modificar tu correo de acceso a SpaceParking.</p>
<p>Tu nuevo correo es el siguiente: </p>

<ul>
    <li><strong>Email:</strong> {{ $usuario->email }}</li>
</ul>

Para ingresar, visite este enlace: <a href="{{ route('index') }}/login">Ingresar a Spaceparking</a>