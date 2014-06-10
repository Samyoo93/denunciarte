 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_GET['Message'])) {
        print '<script type="text/javascript">alert("' . $_GET['Message'] . '");</script>';
    }
    ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Denunciarte</title>
<link rel="stylesheet" href="Estilo/Estilo.css" />
<link href="Imagenes/favicon.ico" type="image/x-icon" rel="shortcut icon" />
<script type="text/javascript">
function registrar(){
    // Create our XMLHttpRequest object

    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "registrarUsuario.php";
    var nombre = document.getElementById("nombre").value;
    var primerApellido = document.getElementById("primerApellido").value;
    var segundoApellido = document.getElementById("segundoApellido").value;
    var fecNac = document.getElementById("fecNac").value;
    if (document.getElementById('M').checked) {
        var genero = document.getElementById('M').value;
    } else {
        var genero = document.getElementById("F").value;
    }
    if(document.getElementById('checka').checked){
        var checka = 1;
    } else {
        var checka = 0;
    }

    var contrasena = document.getElementById("contrasena").value;
    var contrasena2 = document.getElementById("contrasena2").value;
    var usuario = document.getElementById("usuario").value;
    var cedula1= document.getElementById("cedula1").value;
    var cedula2=document.getElementById("cedula2").value;
    var cedula3= document.getElementById("cedula3").value;


    var vars = 'nombre='+nombre+'&primerApellido='+primerApellido+"&segundoApellido="+segundoApellido+'&fecNac='+fecNac+'&cedula1='+cedula1+'&cedula2='+cedula2+'&cedula3='+cedula3+'&genero='+genero+'&usuario='+usuario+'&contrasena='+contrasena+'&contrasena2='+contrasena2+'&checka='+checka;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
        if(hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            document.getElementById("registro").innerHTML = return_data;
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    document.getElementById("registro").innerHTML = "procesando...";

}

	function login(){
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "loginUsuario.php";
    var usuarioLogin = document.getElementById("usuarioLogin").value;
    var contrasenaLogin = document.getElementById("contrasenaLogin").value;
    var vars = 'usuarioLogin='+usuarioLogin+'&contrasenaLogin='+contrasenaLogin;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			document.getElementById("registro").innerHTML = return_data;
	    }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    document.getElementById("registro").innerHTML = "procesando...";
	}
	</script>
</head>

<body>
<!--Iniciar Sesión-->
<section id="CuadroGris" style=" top:20px; position:absolute; left:20px; width:960px; height:120px">
<h1 style="position:absolute; left:30px; top:-20px;"> DenunciARTE </h1>
<a style="position:absolute; left:510px; top:30px;"> Usuario </a>
<input type="text" style="position:absolute; top:50px; left:510px;" placeholder="Usuario" id="usuarioLogin" />
<a style="position:absolute; left:690px; top:30px;"> Contraseña </a>
<a href="" style="position:absolute; left:690px; font-size:12px; top:80px;">¿Olvidaste tu contraseña?</a>
<input type="password" style="position:absolute; top:50px; left:690px;" placeholder="Contraseña" id="contrasenaLogin" />
<button type="submit" onclick='login()' style="position:absolute; top:50px; left:870px;">Entrar</button>
</section>
<!-- LOGO -->
<img src="Imagenes/logoDenunciARTE2.png" style="position:absolute; top:140px; left:20px;"/>


<!--Android-->
<section style="position:absolute; top:300px; left:20px; width:450px; height:450px;">
<h2 style="position:absolute; top:30px; left:50px;">¡Puedes utilizarlo desde tu teléfono o tablet con Sistema Operativo Android!</h2>
<img src="Imagenes/android.jpg" style="position:absolute; top:170px; left:80px;"/>
<a style="position:absolute; top:450px; left:120px;">Descárgalo desde</a>
<img src="Imagenes/playStore.jpg" style="position:absolute; top:430px; left:250px;" />
</section>

<!-- Registro de usuarios -->
<section style="position:absolute; top:170px; left:480px; width:450px; height:300px;">
<h2 style="position:absolute; left:30px;">Regístrate</h2>
<a style="position:absolute; left:30px; top:50px;">________________________________________</a>
<a style="position:absolute; top:90px; left:60px;">Nombre</a>
<input type="text" id="nombre" placeholder="Nombre" style="position:absolute; top: 90px; left:130px; width:80px;" maxlength="25" />
<input type="text" id="primerApellido" placeholder="PrimerApellido" style="position:absolute; top: 90px; left:220px; width:100px;" maxlength="25" />
<input type="text" id="segundoApellido" placeholder="SegundoApellido" style="position:absolute; top: 90px; left:330px; width:100px;" maxlength="25" />
<a style="position:absolute; top:130px; left:60px;">Cédula</a>
<input type="text" id="cedula1" align="center" placeholder="1" style="position:absolute; top: 150px; left:130px; width:20px;" maxlength="1" />
<label style="position:absolute; top:155px; left:165px;">-</label>
<input type="text" id="cedula2" align='center' placeholder="1111" style="position:absolute; top: 150px; left:190px; width:100px;" maxlength="4"/>
<label style="position:absolute; top:155px; left:310px;">-</label>
<input type="text" id="cedula3" align="center" placeholder="1111" style="position:absolute; top: 150px; left:330px; width:100px;" maxlength="4" />
<a style="position:absolute; top:190px; left:60px;">Usuario</a>
<a style="position:absolute; top:210px; left:60px;">(Nombre que lo identificará al realizar un comentario.)</a>
<input type="text" id="usuario" placeholder="Álias para reportes" align="center" style="position:absolute; top: 250px; left:130px; width:300px;" maxlength="25" />
<a style="position:absolute; top:290px; left:60px;">Contraseña</a>
<input type="password" id="contrasena"  placeholder="De 1-15 carácteres."style="position:absolute; top: 310px; left:130px; width:300px;" maxlength="15" />
<a style="position:absolute; top:350px; left:60px;">Confirmar la contraseña</a>
<input type="password" id="contrasena2" placeholder="Verifique las contraseñas" style="position:absolute; top: 370px; left:130px; width:300px;" maxlength="15" />
<a style="position:absolute; top:410px; left:60px;">Fecha de nacimiento</a>
<input type="date" id="fecNac"style="position:absolute; top: 430px; left:130px; width:300px;" />
<a style="position: absolute; left: 60px; top: 470px;">Género</a>
    <input type = "radio" name = "genero" id = "F" value = "F" checked = "checked" style="position:absolute; top:470px; left:140px;">
    <a for = "Femenino" style="position:absolute; top:470px; left:160px;">Femenino</a>

    <input type = "radio" name = "genero" id = "M" value = "M" style="position:absolute; top:470px; left:250px;">
    <a for = "Masculino" style="position:absolute; top:470px; left:270px;">Masculino</a>

    <input type="checkbox" id='checka' style="position:absolute; top:510px; left:60px;" />
    <a style="position:absolute; left:80px; top:510px;"> Aceptas las </a> <a href="#openContract" style="position:absolute; top:510px; left:170px;"> Condiciones de uso </a><a style="position:absolute; top:510px; left:315px"> y que has leído la </a> <a href="#openPolicy" style="position:absolute; top:530px; left:80px;">Política de uso de datos.</a>


    <button type="submit" onclick='registrar()' style="position:absolute; top:560px; left:60px; width:200px;">Registrarse</button>
</section>
    <div id="registro">
    </div>
<!-- Contrato de política de uso de datos-->
<div id="openPolicy" class="modalDialog">
    <div style="width:800px; height:500px;">
        <a  style="left:775px; top:5px;" href="#close" title="Close" class="close">X</a>
        <h2>POLÍTICA DE USO DE DATOS</h2>
        <div style="position:absolute; top:100px; left:50px; width:750px; height:350px;  background-color: #fff; overflow:auto;" overflow-y: scroll;>
            <h3>POLÍTICA DE USO DE DATOS</h3>
            <h3>Información que recibimos sobre ti</h3>
            <p>Recibimos diferentes tipos de información sobre ti, como:</p>
            <h3>Tu información</h3>
            <p>Se trata de la información necesaria para registrarte en el sitio. </p>
            <h3>a)	Información de registro:</h3>
            <p>Cuando te registras en DenunciARTE, te pedimos que introduzcas ciertos datos como, por               ejemplo, tu nombre, cédula, fecha de nacimiento y género. </p>
            <h3>b)	Información que decides publicar:</h3>
            <p>Tu información también incluye todo aquello que compartes en DenunciARTE, como los                   reviews que realizas acerca de otras personas.</p>
            <h3>Información que otras personas comentan sobre ti</h3>
            <p>Recibimos información sobre ti de los usuarios que se encuentran registrados, por                     ejemplo, cuando realizan reviews sobre ti, publican un reporte con una evidencia.</p>
            <p>Cuando la gente usa DenunciARTE, puede almacenar y compartir información sobre ti.</p>
            <h3>Información pública</h3>
            <p>Cuando usamos el término "información pública" (al que en ocasiones nos referimos como               "información que se comparte con todos"), estamos hablando de la información que decides                  hacer pública.</p>
            <h3>Información que siempre es pública</h3>
            <p>Los tipos de información que se enumeran a continuación son siempre públicos y se tratan             como la información que hayas decidido hacer pública:</p>
            <h3>a.	Nombre de una persona física o entidad:</h3>
            <p>Ayuda a todos los usuarios a encontrarte. </p>
            <p>Si alguien tiene tu nombre de usuario o identificador de usuario puede utilizarlo para               acceder a información sobre ti a través del sitio web DenunciARTE.com. En concreto, tendrá               acceso a tu información pública.</p>
            <h3>Cómo utilizamos la información que recibimos</h3>
            <p>Utilizamos la información que recibimos sobre ti en relación con los servicios y las                 funciones que te ofrecemos a ti y a otros usuarios. Por ejemplo, además de ayudar a otras               personas a ver y encontrar cosas que haces, podemos utilizar la información que recibimos               sobre ti:</p>
            <p>*	como parte de nuestro esfuerzo para mantener la seguridad de las integraciones, los             servicios y los productos de DenunciARTE;</p>
            <p>*	para proteger los derechos o la propiedad de DenunciARTE o de otros;</p>
            <p>*	para operaciones internas, incluidos la solución de problemas, el análisis de datos,             la investigación, el desarrollo y la mejora del servicio.</p>
            <p>Concedernos este permiso para utilizar tu información no solo nos permite ofrecer el                 DenunciARTE que conoces, sino que también nos permitirá ofrecerte en el futuro funciones y               servicios que utilizarán la información que recibimos sobre ti de forma innovadora.</p>
            <p>Aunque nos permites utilizar la información que recibimos acerca de ti, tú eres en todo               momento su propietario. Tu confianza es importante para nosotros y por ello no compartimos               esta información con otros a menos que:</p>
            <p>*	nos hayas dado tu permiso;</p>
            <p>*	te hayamos advertido, como informándote de ello en esta política, o</p>
            <p>*	hayamos eliminado tu nombre y cualquier otro dato por el que se te pueda                         identificar.</p>
            <p>Obviamente, en el caso de la información que otras personas comparten sobre ti, dichas               personas son quienes controlan cómo la comparten.</p>
            <p>Almacenamos los datos durante el tiempo necesario para facilitarte productos y servicios,             a ti y otros usuarios, incluidos los descritos anteriormente. Normalmente, la información               asociada con tu cuenta se conserva hasta que elimines la cuenta. En el caso de determinados             tipos de datos también tenemos prácticas específicas de conservación de datos. </p>
            <h3>Desactivación de tu cuenta</h3>
            <p>Si quieres dejar de usar tu cuenta, la puedes desactivar o eliminar.</p>
            <h3>a)Desactivar</h3>
            <p>Una cuenta desactivada queda en espera. No eliminaremos tu información. Al desactivar una             cuenta nos estás pidiendo que no eliminemos la información porque piensas volver a activar               la cuenta más adelante. Puedes desactivar tu cuenta en la página de configuración de tu                 cuenta.</p>
        </div>
    </div>
</div>
<!-- Contrato de privacidad-->
<div id="openContract" class="modalDialog">
    <div style="width:800px; height:500px;">
        <a  style="left:775px; top:5px;" href="#close" title="Close" class="close">X</a>
        <h2>CONTRATO DE CONDICIONES DE USO</h2>
        <div style="position:absolute; top:100px; left:50px; width:750px; height:350px;  background-color: #fff; overflow:auto;" overflow-y: scroll;>
            <h3>CONTRATO DE CONDICIONES DE USO</h3>
            <p>En vigor a partir de 11 de junio del 2014.</p>
            <p>POR FAVOR, LEA DETENIDAMENTE EL SIGUIENTE CONTRATO DE CONDICIONES DE USO.
                EL USO POR SU PARTE DE LA PÁGINA WEB DENUNCIARTE Y DE CUALQUIER SUBPÁGINA, SERVICIO O                   ELEMENTOS RELACIONADOS CON LA MISMA (EN ADELANTE LA “PÁGINA”) CONSTITUYE SU ACEPTACIÓN                   DE ESTAS CONDICIONES, ACUERDOS, POLÍTICAS Y NOTIFICACIONES (EN ADELANTE LAS                             “CONDICIONES”). SI ES MENOR DE EDAD, DEBERÁ ASEGURARSE DE QUE SUS PADRES O SU TUTOR DAN                 SU CONSENTIMIENTO AL PRESENTE CONTRATO EN SU NOMBRE ANTES DE QUE PUEDA USAR LA PÁGINA.                   IMPRIMA UNA COPIA DE ESTE CONTRATO PARA TENER CONSTANCIA. SI NO ESTÁ DE ACUERDO CON                     TODAS LAS CONDICIONES CONTRACTUALES, NO SE LE PERMITIRÁ EL USO DE LA PÁGINA.</p>
            <p>DenunciARTE. (“DenunciARTE”) ofrece ciertos contenidos, imágenes, textos, y/o servicios a              través de la Página, a los que puede accederse desde el registro de una cuenta gratuita de              DenunciARTE (la “Cuenta”). </p>
            <p>El uso por su parte de la Página y la Cuenta está sujeto a estas Condiciones de Uso y a                la Política de uso de datos de DenunciARTE, aquí referenciadas e incorporadas al presente                Contrato. Debe aceptar el Contrato de Licencia de Usuario Final correspondiente, la                      Política de uso de datos y el presente Contrato de Condiciones de Uso (conjuntamente                    denominados los “Contratos”) antes de empezar a utilizar los servicios suministrados por la              página. El coste de la conexión a Internet por el uso de la Página, de su Cuenta, y/o del                Servicio correrá por su cuenta.</p>
            <p>Se prohíbe expresamente el uso, reproducción, modificación, distribución o comunicación                pública de la Página, o del Servicio que no estén explícitamente autorizados en las                      condiciones de los Contratos.
            </p>

            <h3>Declaración de derechos y responsabilidades</h3>

            <p>Esta Declaración de derechos y responsabilidades ("Declaración", "Condiciones" o                     "DDR") tiene su origen en los Principios de DenunciARTE y contiene las condiciones de                   servicio que rigen nuestra relación con los usuarios y con todos aquellos que interactúan               con DenunciARTE. Al usar o al acceder a DenunciARTE, muestras tu conformidad con esta                   Declaración. Al final de este documento también encontrarás otros recursos que te ayudarán a             comprender cómo funciona DenunciARTE.
            </p>

            <h3>1.	Privacidad</h3>
            <p>Tu privacidad es muy importante para nosotros. Hemos diseñado nuestra Política de uso de             datos para ayudarte a comprender cómo puedes usar DenunciARTE para compartir información con             otras personas y cómo recopilamos y usamos tu información. Te animamos a que leas nuestra               Política de uso de datos y a que la utilices para poder tomar decisiones fundamentadas.</p>

            <h3>2.	Compartir el contenido y la información</h3>
            <p>Eres el propietario de todo el contenido y la información que publicas en DenunciARTE, y             puedes controlar cómo se comparte a través de la configuración de la privacidad. Además:</p>

            <p>a.	Para el contenido protegido por derechos de propiedad intelectual, como fotografías               y vídeos (en adelante, "contenido de PI”), nos concedes específicamente el siguiente                    permiso, de acuerdo con la configuración de la privacidad: concedes una licencia no                      exclusiva, transferible, con derechos de sublicencia, libre de derechos de autor, aplicable              globalmente, para utilizar cualquier contenido de PI que publiques en DenunciARTE o en                  conexión con DenunciARTE (en adelante, "licencia de PI"). Esta licencia de PI finaliza                  cuando eliminas tu contenido de PI o tu cuenta, salvo si el contenido se ha compartido con              terceros y estos no lo han eliminado.</p>

            <p>b.	Cuando eliminas contenido de PI, este se borra de forma similar a cuando vacías la                  papelera o papelera de reciclaje de tu equipo. No obstante, entiendes que es posible que                el contenido eliminado permanezca en copias de seguridad durante un plazo de tiempo                      razonable (si bien no estará disponible para terceros).</p>

            <p>3.	Cuando publicas contenido o información con la configuración "Público", significa                  que permites que todos, accedan y usen dicha información y la asocien a ti (es decir, tu                nombre). </p>

            <h3>3.	Seguridad</h3>

            <p>Hacemos todo lo posible para hacer que DenunciARTE sea un sitio seguro, pero no podemos                  garantizarlo. Necesitamos tu ayuda para que así sea, lo que implica los siguientes                      compromisos de tu parte:</p>

            <p>a.	No publicarás comunicaciones comerciales no autorizadas (como correo no deseado,                  "spam") en DenunciARTE.</p>
            <p>b.	No recopilarás información o contenido de otros usuarios, ni accederás de otro modo                a DenunciARTE, utilizando medios automáticos (como harvesting bots, robots, arañas o                    scrapers) sin nuestro permiso previo.</p>
            <p>c.	No subirás virus ni código malintencionado de ningún tipo.</p>
            <p>d.	No solicitarás información de inicio de sesión ni accederás a una cuenta                            perteneciente a otro usuario.</p>
            <p>e.	No molestarás, intimidarás ni acosarás a ningún usuario.</p>
            <p>f.	No publicarás contenido que contenga lenguaje ofensivo, resulte intimidatorio o                   pornográfico, que incite a la violencia o que contenga desnudos o violencia gráfica o                   injustificada.</p>
            <p>g.	No utilizarás DenunciARTE para actos ilícitos, engañosos, malintencionados o                      discriminatorios.</p>
            <p>h.	No realizarás ninguna acción que pudiera inhabilitar, sobrecargar o afectar al                    funcionamiento correcto o al aspecto de DenunciARTE, como, por ejemplo, un ataque de                    denegación de servicio o la alteración de la presentación de páginas u otra funcionalidad                de DenunciARTE.</p>
             <p>i.	No facilitarás ni fomentarás el incumplimiento de esta Declaración o nuestras                    políticas.</p>

            <h3>4.	Seguridad de la cuenta y registro</h3>
            <p>Los usuarios de DenunciARTE proporcionan sus nombres e información reales y necesitamos                tu colaboración para que siga siendo así. Estos son algunos de los compromisos que aceptas              en relación con el registro y mantenimiento de la seguridad de tu cuenta:</p>
            <p>a.	No proporcionarás información personal falsa en DenunciARTE, ni crearás una cuenta                para otras personas sin su autorización.</p>
            <p>b.	No crearás más de una cuenta personal.</p>
            <p>c.	Si inhabilitamos tu cuenta, no crearás otra sin nuestro permiso.</p>
            <p>d.	No utilizarás DenunciARTE si eres menor de 18 años.</p>
            <p>e.	Mantendrás la información de contacto exacta y actualizada.</p>
            <p>f.	No compartirás tu contraseña (o en el caso de los desarrolladores, tu clave                       secreta), no dejarás que otra persona acceda a tu cuenta, ni harás nada que pueda poner en              peligro la seguridad de tu cuenta.</p>
            <p>g.	No transferirás la cuenta (incluida cualquier página o aplicación que administres) a              nadie sin nuestro consentimiento previo por escrito.</p>
            <p>h.	Si seleccionas un nombre de usuario o identificador similar para tu cuenta o página,              nos reservamos el derecho a eliminarlo o reclamarlo si lo consideramos oportuno (por                    ejemplo, si el propietario de una marca comercial se queja por un nombre de usuario que no              está relacionado estrechamente con el nombre real del usuario).</p>

            <h3>5.	Protección de los derechos de otras personas</h3>

            <p>Respetamos los derechos de otras personas y esperamos que tú hagas lo mismo.</p>
            <p>a.	No publicarás contenido ni realizarás ninguna acción en DenunciARTE que infrinja o                viole los derechos de otros o que viole la ley de algún modo.</p>
            <p>b.	Podemos retirar cualquier contenido o información que publiques en DenunciARTE si               consideramos que infringe esta Declaración o nuestras políticas.</p>
            <p>c.	Si infringes repetidamente los derechos de otras personas, desactivaremos tu cuenta             cuando lo estimemos oportuno.</p>
            <p>d.	Si recopilas información de usuarios: deberás obtener su consentimiento previo,                 dejar claro que eres tú (y no DenunciARTE) quien recopila la información y publicar una                 política de privacidad que explique qué datos recopilas y cómo los usarás.</p>
            <p>e.	No publicarás los documentos de identificación ni información financiera de nadie en              DenunciARTE.</p>


            <h3>6.	Dispositivos móviles y de otros tipos</h3>
            <p>a.	Actualmente ofrecemos nuestros servicios de móviles de forma gratuita pero ten en                 cuenta que se aplicarán las tarifas normales de tu operadora, por ejemplo, las tarifas de               mensajes de texto y cargos de datos.</p>


            <h3>7.	Disposiciones especiales aplicables al software</h3>
            <p>a.	Si descargas o utilizas nuestro software, como un producto de software                            independiente, una aplicación o un plug-in para el navegador, aceptas que, periódicamente,              el software puede descargar e instalar mejoras, actualizaciones y funciones adicionales a                fin de mejorarlo y desarrollarlo.</p>
            <p>b.	No modificarás nuestro código fuente ni llevarás a cabo con él trabajos derivados,                como descompilar o intentar de algún otro modo extraer dicho código fuente, excepto en los              casos permitidos expresamente por una licencia de código abierto o si te damos nuestro                  consentimiento expreso por escrito.</p>

            <h3>8.	Terminación</h3>

            <p>Si infringes la letra o el espíritu de esta Declaración, o de algún otro modo provocas               riesgos  o causas que estemos expuestos legalmente, podríamos dejar de proporcionarte todo o             parte de DenunciARTE. Te notificaremos la próxima vez que intentes acceder a tu cuenta.                 También puedes eliminar tu cuenta. En tales casos, esta Declaración cesará.</p>

            <h3>9.	Conflictos</h3>
            <p>a.	Si alguien interpone una demanda contra nosotros relacionada con tus acciones, tu                 contenido o tu información en DenunciARTE, te encargarás de indemnizarnos y nos librarás                 de la responsabilidad por todos los posibles daños, pérdidas y gastos de cualquier tipo                (incluidos los costes y tasas legales razonables) relacionados con dicha demanda. Aunque                 proporcionamos normas para la conducta de los usuarios, no controlamos ni dirigimos sus                acciones en DenunciARTE y no somos responsables del contenido o la información que los                  usuarios transmitan. No somos responsables de ningún contenido que se considere ofensivo,                 inapropiado, obsceno, ilegal o inaceptable que puedas encontrar en DenunciARTE. No somos                 responsables de la conducta de ningún usuario de DenunciARTE, tanto dentro como fuera de                 DenunciARTE.</p>
            <p>b.	INTENTAMOS MANTENER DENUNCIARTE EN FUNCIONAMIENTO, SIN ERRORES Y SEGURO, PERO LO                  UTILIZAS BAJO TU PROPIA RESPONSABILIDAD. PROPORCIONAMOS DENUNCIARTE TAL CUAL, SIN GARANTÍA              ALGUNA EXPRESA O IMPLÍCITA, INCLUIDAS, ENTRE OTRAS, LAS GARANTÍAS DE COMERCIABILIDAD,                    ADECUACIÓN A UN FIN PARTICULAR Y NO INCUMPLIMIENTO. NO GARANTIZAMOS QUE DENUNCIARTE SEA                  SIEMPRE SEGURO O ESTÉ LIBRE DE ERRORES, NI QUE FUNCIONE SIEMPRE SIN INTERRUPCIONES,                      RETRASOS O IMPERFECCIONES. DENUNCIARTE NO SE RESPONSABILIZA DE LAS ACCIONES, EL CONTENIDO,              LA INFORMACIÓN O LOS DATOS DE TERCEROS Y POR LA PRESENTE NOS DISPENSAS A NOSOTROS, NUESTROS              DIRECTIVOS, EMPLEADOS Y AGENTES DE CUALQUIER DEMANDA O DAÑOS, CONOCIDOS O DESCONOCIDOS,                  DERIVADOS DE O DE ALGÚN MODO RELACIONADOS CON CUALQUIER DEMANDA QUE TENGAS INTERPUESTA                  CONTRA TALES TERCEROS.</p>
            <h3>10.	Definiciones</h3>
            <p>a.	El término "DenunciARTE" se refiere a las funciones y servicios que proporcionamos,               incluidos los que se ofrecen a través de (a) nuestro sitio web en www.DenunciARTE.com ;                 (b) nuestra plataforma.</p>
            <p>b.	El término "Plataforma" se refiere al conjunto de servicios (como el contenido) que                permiten que otras personas, incluidos los desarrolladores de aplicaciones y los                        operadores de sitios web, obtengan datos de DenunciARTE o nos los proporcionen a                        nosotros.</p>
            <p>c.	El término "información" se refiere a los hechos y otra información sobre ti,                     incluidas las acciones que realizan los usuarios.
            <p>d.	El término "datos" o "datos de usuario" se refiere a los datos, incluidos el                      contenido o la información de un usuario, que otros pueden obtener de DenunciARTE o                      proporcionar a DenunciARTE a través de la plataforma.</p>

        </div>
    </div>
</div>

<!-- Registro Entidad-->
<!-- Registro de usuarios -->
<section style="position:absolute; top:750px; left:480px; width:450px; height:100px;">
<a style="position:absolute; left:30px; top:30px;">________________________________________</a>
<a href="entidad.php" style="position:absolute; top:60px; left:30px; color:#00F;">Crear un perfil</a>
<a style="position:absolute; top:60px; left:150px;">para una entidad.</a>
<a href="personaFisica.php" style="position:absolute; top:80px; left:30px; color:#00F;">Crear un perfil</a>
<a style="position:absolute; top:80px; left:150px;">para una persona física.</a>
</section>
<!-- Pie de página -->
<section id="CuadroGris" style=" top:865px; position:absolute; left:20px; width:960px; height:90px">
<a style="position:absolute; left:20px; top:10px;"> Desarrolladores </a>
<a style="position:absolute; left:40px; top:40px;"> -Kathy Brenes G. </a>
<a style="position:absolute; left:190px; top:40px;"> -Barnum Castillo B. </a>
<a style="position:absolute; left:340px; top:40px;"> -Franco Solís A. </a>
<a style="position:absolute; left:480px; top:40px;"> -Samuel Yoo </a><a href="http://www.matmartinez.net/nsfw" style="position:absolute; top:40px; left:570px;">.</a>

<a style=" position:absolute; top:70px; left:700px;">DenunciARTE © 2014 · Español </a>

</section>
</body>
</html>
