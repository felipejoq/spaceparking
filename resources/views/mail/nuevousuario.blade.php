<p>Hola {{ $usuario->name }}!</p>
<p>Bienvenido(a) a SpaceParking, has sido registrado para ser gestor del sistema de estacionamientos.</p>
<p>Tus datos de acceso son los siguientes: </p>

<ul>
    <li>Email: {{ $usuario->email }}</li>
    <li>Password: {{ $usuario->password }}</li>
</ul>

Para ingresar, visite este enlace: <a href="{{ route('index') }}/login">Ingresar a Spaceparking</a>
