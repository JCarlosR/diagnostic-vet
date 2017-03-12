
<!-- <a href="#!" class="breadcrumb">Second</a>
<a href="#!" class="breadcrumb">Third</a>
 -->
<!-- <ul id="slide-out" class="side-nav">
    <li>
      <div class="userView">
        <div class="background">
          <img src="/images/dog.png">
        </div>
        <a href="#!user"><img class="circle" src="/images/perfil.png"></a>
        <a href="#!name"><span class="white-text name">Enma</span></a>
        <a href="#!email"><span class="white-text email">diagnosticVet@gmail.com</span></a>
      </div>
    </li>
    <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
    <li><a href="/home">Dashboard</a></li>
    <li><a class="waves-effect" href="/especies">Especies</a></li>
    <li><a class="waves-effect" href="/enfermedades">Enfermedades</a></li>
</ul>
    <li><div class="divider"></div></li> -->

<!-- <li><a href="#" data-activates="slide-out" class="button-collapse"><i class="medium material-icons">menu</i></a></li> -->
<!-- <div class="collection">
        <a href="/home" class="collection-item @if(request()->is('home')) active @endif">Dashboard</a>
        <a href="/especies" class="collection-item @if(request()->is('especies')) active @endif">Especies</a>
        <a href="/enfermedades" class="collection-item @if(request()->is('enfermedades')) active @endif">Enfermedades</a>
</div> -->

<!-- <div class="panel panel-primary">
    <div class="panel-heading">Dashboard</div>

    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">
        	@if(auth()->check())

  	        <li @if(request()->is('home')) class="active" @endif><a href="/home">Dashboard</a></li>

            @if(! auth()->user()->is_client)
  	        <li @if(request()->is('ver')) class="active" @endif><a href="/ver" >Ver Incidencias</a></li>
            @endif

  	        <li @if(request()->is('reportar')) class="active" @endif><a href="/reportar" >Reportar Incidencia</a></li>

            @if(auth()->user()->is_admin)
              <li role="presentation" class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Administracion 
                      <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="/usuarios" >Usuarios</a></li>
                        <li><a href="/proyectos" >Proyectos</a></li>
                        <li><a href="/config" >Configuracion</a></li>
                      </ul>
                    </li>
            @endif
        	@else
        		<li><a href="/welcome" >Bienvenido</a></li>
	        	<li><a href="#" >Instrucciones</a></li>
	        	<li><a href="#" >Creditos</a></li>
        	@endif	  
		</ul>
    </div>
</div> -->