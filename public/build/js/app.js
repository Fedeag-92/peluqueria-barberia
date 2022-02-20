let paso=1,alertas=[];const limiteInfPaso=1,limiteSupPaso=3,cita={nombre:"",fecha:"",hora:"",serviciosDeseados:[],total:"",demoraTotal:"",usuarioId:"",direccion:""};let usuario,mapeoDemora,citasUsuario=[],serviciosCita=[];function iniciarApp(){obtenerSucursal(),nombreCliente(),idCliente(),obtenerUsuario(),obtenerCitas(),menuUsuario(),mostrar_ocultarModal(),misCitas(),cambiarNombreUsuario(),cambiarPasswordUsuario(),cambiarTelefonoUsuario(),tabs(),paginaAnterior(),paginaSiguiente(),consultarAPI(),seleccionarFecha(),seleccionarHora()}async function obtenerSucursal(){try{const e=window.location.origin+"/api/sucursal",r=await fetch(e);escribirDatos(await r.json())}catch(e){console.log(e)}}function escribirDatos(e){horarios=document.querySelector(".horarios"),horarios.innerHTML="<p>Horarios de Atencion: </p><p>"+e.diaInicio+" a "+e.diaFin+" - "+e.horaInicio.substring(0,5)+"hs a "+e.horaCierre.substring(0,5)+"hs</p>",direccion=document.querySelector(".direccion"),direccion.innerHTML="<p>"+e.direccion+" - "+e.ciudad+"</p>",cita.direccion=e.direccion}function nombreCliente(){cita.nombre=document.querySelector("#nombre").value}function idCliente(){cita.usuarioId=document.querySelector("#id").value}async function obtenerUsuario(){try{const e=window.location.origin+"/api/usuario?id="+cita.usuarioId,r=await fetch(e);usuario=await r.json()}catch(e){console.log(e)}}async function obtenerCitas(){try{const e=window.location.origin+"/api/citas-usuario?id="+cita.usuarioId,r=await fetch(e);citasUsuario=await r.json(),verificarCitasMax(citasUsuario)}catch(e){console.log(e)}}function verificarCitasMax(e){const r=document.querySelector("#app"),t=document.querySelector(".descripcion-pagina");e.length>4?(r.style.display="none",t.textContent="No se pueden crear más de 5 citas, por favor asiste a las que ya reservaste",t.style.background="#cb0000"):(r.style.display="block",t.textContent="Elije tus servicios y coloca tus datos.",t.style.background="transparent")}function menuUsuario(){document.querySelector(".usuario-barra").addEventListener("click",(function(e){e.stopPropagation(),document.querySelector(".acciones-usuario").classList.toggle("mostrar"),document.querySelector("#overlay").style.display="block",disableScroll()}))}function mostrar_ocultarModal(){document.addEventListener("click",(function(e){const r=document.querySelector(".acciones-usuario");if(r.classList.contains("mostrar")){r.classList.remove("mostrar"),e.target!=misCitas&&(document.querySelector("#overlay").style.display="none");const t=document.querySelector(".cambiar-nombre"),o=document.querySelector(".cambiar-telefono"),a=document.querySelector(".cambiar-password");e.target!=t&&e.target!=o&&e.target!=a&&enableScroll()}}))}function misCitas(){document.querySelector(".mis-citas").addEventListener("click",(function(){const e=document.createElement("DIV");e.classList.add("modal-app"),e.innerHTML=`\n            <div class="mis-citas-modal">\n                <h2 class="x">X</h2>\n                <h3>Mis Citas</h3>\n                <div class="contenedor-importante">\n                    <button>X</button>\n                    <p class="importante"><span>Importante:</span> en caso de no poder asistir a un turno, por favor avisar con 2 horas de anticipación contactandomé por algún medio: <a href="https://www.whatsapp.com/">Wasap</a> - <a href="https://www.facebook.com/">Facebook</a> - <a href="https://www.instagram.com/">Instagram</a></p>\n                </div>\n                <div class="contenedor-aviso">\n                    <button>X</button>\n                    <p class="importante"><span>Aviso:</span> solo se toleran 15 minutos de demora para una cita, pasado este tiempo se cancela la cita.</p>\n                </div>\n                <div class="contenedor-mis-citas">\n                    ${citasUsuario?"":'<p class="no-hay">No hay citas</p>'}\n                </div>\n                <button type="button" class="cerrar-modal">Cerrar</button>\n            </div>\n        `,setTimeout(()=>{document.querySelector(".contenedor-importante button").onclick=()=>{document.querySelector(".contenedor-importante").style.display="none"};document.querySelector(".contenedor-aviso button").onclick=()=>{document.querySelector(".contenedor-aviso").style.display="none"};document.querySelector(".mis-citas-modal").classList.add("animar");const e=document.querySelector(".contenedor-mis-citas");if(citasUsuario.length>0){for(;e.firstChild;)e.removeChild(e.firstChild);citasUsuario.forEach(async(r,t)=>{const{direccion:o,fecha:a,hora:n,total:c}=r;try{const i=window.location.origin+"/api/servicios-cita?id="+r.id,s=await fetch(i),l=await s.json(),d=document.createElement("DIV");d.classList.add("contenedor-cita");const u=document.createElement("DIV"),m=document.createElement("P");u.classList.add("num-cita"),m.textContent="Cita "+(t+1),u.appendChild(m),d.appendChild(u);const p=document.createElement("DIV");p.classList.add("info-cita");const f=new Date(a),v=f.getMonth(),h=f.getDate()+2,b=f.getFullYear(),y=new Date(Date.UTC(b,v,h)),g={weekday:"long",year:"numeric",month:"long",day:"numeric"},S=y.toLocaleDateString("es-AR",g),w=document.createElement("P");w.innerHTML="<span>Lugar: </span>"+o;const C=document.createElement("P");C.innerHTML="<span>Fecha: </span>"+S;const L=document.createElement("P");L.innerHTML="<span>Hora: </span>"+n.substring(0,5),l.forEach(e=>{const{precio:r,nombre:t}=e,o=document.createElement("P");o.classList.add("contenedor-servicio");const a=document.createElement("P");a.textContent=t;const n=document.createElement("P");n.innerHTML="<span>Precio: </span> $"+r,o.appendChild(a),o.appendChild(n),d.appendChild(o)});const E=document.createElement("P");E.innerHTML="<span>Total a Pagar: </span> $"+c,p.appendChild(w),p.appendChild(C),p.appendChild(L),p.appendChild(E),d.appendChild(p),e.appendChild(d)}catch(e){console.log(e)}});const r=servicios.length+1,t=document.createElement("DIV");t.textContent="SERVICIOS",t.classList.add("textoServicios"),t.style.gridRow="1 / "+r;const o=document.createElement("DIV");o.textContent="CITA",o.classList.add("textoCita"),o.style.gridRow=r+" / "+(r+4),contenedorCita.appendChild(t),contenedorCita.appendChild(o)}},0),e.addEventListener("click",(function(r){if(r.target.classList.contains("cerrar-modal")||r.target.classList.contains("x")){document.querySelector(".mis-citas-modal").classList.add("cerrar"),setTimeout(()=>{e.remove(),document.querySelector("#overlay").style.display="none"},500)}enableScroll()})),document.querySelector(".app").appendChild(e)}))}function cambiarNombreUsuario(){document.querySelector(".cambiar-nombre").addEventListener("click",(function(){const e=document.createElement("DIV");e.classList.add("modal-app"),e.innerHTML=`\n            <form class="formulario-modal">\n                <legend>Escribe un nuevo nombre</legend>\n                <div class="campo">\n                    <label for="nombre">Nombre</label>\n                    <input \n                        type="text"\n                        name="nombre"\n                        placeholder="Editar el nombre"\n                        id="nombreForm"\n                        value="${cita.nombre?cita.nombre.split(" ")[0]:""}"\n                    />\n                </div>\n                <div class="campo">\n                    <label for="apellido">Apellido</label>\n                    <input \n                        type="text"\n                        name="apellido"\n                        placeholder="Editar el apellido"\n                        id="apellidoForm"\n                        value="${cita.nombre?cita.nombre.split(" ")[1]:""}"\n                    />\n                </div>\n                <div class="opciones">\n                    <input \n                        type="submit" \n                        class="submit-actualizar" \n                        value="Actualizar" \n                    />\n                    <button type="button" class="cerrar-modal">Cancelar</button>\n                </div>\n            </form>\n        `,setTimeout(()=>{document.querySelector(".formulario-modal").classList.add("animar")},0),e.addEventListener("click",(function(r){if(r.preventDefault(),r.target.classList.contains("cerrar-modal")){document.querySelector(".formulario-modal").classList.add("cerrar"),setTimeout(()=>{e.remove()},500)}if(r.target.classList.contains("submit-actualizar")){const r=document.querySelector("#nombreForm").value.trim(),t=document.querySelector("#apellidoForm").value.trim();if(r==usuario.nombre&&t==usuario.apellido)return Swal.fire({icon:"info",title:"Sin cambios",showConfirmButton:!1,timer:1e3}),enableScroll(),void e.remove();let o=document.querySelector("#errorNombreVacio");if(o&&o.remove(),o=document.querySelector("#errorNombreLong"),o&&o.remove(),o=document.querySelector("#errorNombrePalabra"),o&&o.remove(),o=document.querySelector("#errorApellidoVacio"),o&&o.remove(),o=document.querySelector("#errorApellidoLong"),o&&o.remove(),o=document.querySelector("#errorApellidoPalabra"),o&&o.remove(),""===r)return alerta=crearAlerta("El Nombre es obligatorio","error","errorNombreVacio"),void mostrarAlerta(".formulario-modal legend",alerta);if(r.length>60)return alerta=crearAlerta("El Nombre debe tener menos de 60 caracteres","error","errorNombreLong"),void mostrarAlerta(".formulario-modal legend",alerta);let a=0;for($matches=r.split(" "),$encontro=!1;a<$matches.length&&!$encontro;)/[\w]{16,}/.test($matches[a])&&($encontro=!0),a++;if($encontro)return alerta=crearAlerta("No puede haber nombres de más de 15 caracteres","error","errorNombrePalabra"),void mostrarAlerta(".formulario-modal legend",alerta);if(""===t)return alerta=crearAlerta("El Apellido es obligatorio","error","errorApellidoVacio"),void mostrarAlerta(".formulario-modal legend",alerta);if(t.length>60)return alerta=crearAlerta("El Apellido debe tener menos de 60 caracteres","error","errorApellidoLong"),void mostrarAlerta(".formulario-modal legend",alerta);for(a=0,$matches=t.split(" "),$encontro=!1;a<$matches.length&&!$encontro;)/[\w]{21,}/.test($matches[a])&&($encontro=!0),a++;if($encontro)return alerta=crearAlerta("No puede haber apellidos de más de 20 caracteres","error","errorApellidoPalabra"),void mostrarAlerta(".formulario-modal legend",alerta);usuario.nombre=r,usuario.apellido=t,cita.nombre=r+" "+t,document.querySelector("#nombre").value=cita.nombre,document.querySelector("#nombre-usuario-barra").textContent=cita.nombre,actualizarUsuario("nombre")}enableScroll()})),document.querySelector(".app").appendChild(e)}))}function cambiarPasswordUsuario(){document.querySelector(".cambiar-password").addEventListener("click",(function(){const e=document.createElement("DIV");e.classList.add("modal-app"),e.innerHTML='\n        <form class="formulario-modal">\n            <legend>Escribe un nuevo password</legend>\n            <div class="campo">\n                <label for="passwordAct">Password Actual</label>\n                <input \n                    type="password"\n                    name="passwordAct"\n                    placeholder="Escribe tu password actual"\n                    id="passwordAct"\n                />\n            </div>\n            <div class="campo">\n                <label for="passwordN">Password nuevo</label>\n                <input \n                    type="password"\n                    name="passwordN"\n                    placeholder="Escribe tu password nuevo"\n                    id="passwordN"\n                />\n            </div>\n            <div class="opciones">\n                <input \n                    type="submit" \n                    class="submit-actualizar" \n                    value="Actualizar" \n                />\n                <button type="button" class="cerrar-modal">Cancelar</button>\n            </div>\n        </form>\n    ',setTimeout(()=>{document.querySelector(".formulario-modal").classList.add("animar")},0),e.addEventListener("click",(function(r){if(r.preventDefault(),r.target.classList.contains("cerrar-modal")){document.querySelector(".formulario-modal").classList.add("cerrar"),setTimeout(()=>{e.remove()},500)}if(r.target.classList.contains("submit-actualizar")){const e=document.querySelector("#passwordAct").value,r=document.querySelector("#passwordN").value;let t=document.querySelector("#errorPasswordActual");if(t&&t.remove(),t=document.querySelector("#errorPasswordNuevo"),t&&t.remove(),t=document.querySelector("#errorPasswordNlong"),t&&t.remove(),t=document.querySelector("#errorPasswordIguales"),t&&t.remove(),""===e)return alerta=crearAlerta("Debes escrbir tu password actual","error","errorPasswordActual"),void mostrarAlerta(".formulario-modal legend",alerta);if(""===r)return alerta=crearAlerta("El Password nuevo es obligatorio","error","errorPasswordNuevo"),void mostrarAlerta(".formulario-modal legend",alerta);if(r.length<6)return alerta=crearAlerta("El Password nuevo debe tener al menos 6 caracteres","error","errorPasswordNlong"),void mostrarAlerta(".formulario-modal legend",alerta);if(e==r)return alerta=crearAlerta("Para cambiar el password debe escribir uno distinto","advertencia","errorPasswordIguales"),void mostrarAlerta(".formulario-modal legend",alerta);usuario.passwordAct=e,usuario.passwordN=r,actualizarUsuario("password")}enableScroll()})),document.querySelector(".app").appendChild(e)}))}function cambiarTelefonoUsuario(){document.querySelector(".cambiar-telefono").addEventListener("click",(function(){const e=document.createElement("DIV");e.classList.add("modal-app"),e.innerHTML=`\n            <form class="formulario-modal">\n                <legend>Escribe un nuevo telefono</legend>\n                <div class="campo">\n                    <label for="nombre">Telefono</label>\n                    <input \n                        type="number"\n                        name="telefono"\n                        placeholder="Editar el telefono"\n                        id="telefono"\n                        value="${usuario.telefono?usuario.telefono:""}"\n                    />\n                </div>\n                <div class="opciones">\n                    <input \n                        type="submit" \n                        class="submit-actualizar" \n                        value="Actualizar" \n                    />\n                    <button type="button" class="cerrar-modal">Cancelar</button>\n                </div>\n            </form>\n        `,setTimeout(()=>{document.querySelector(".formulario-modal").classList.add("animar")},0),e.addEventListener("click",(function(r){if(r.preventDefault(),r.target.classList.contains("cerrar-modal")){document.querySelector(".formulario-modal").classList.add("cerrar"),setTimeout(()=>{e.remove()},500)}if(r.target.classList.contains("submit-actualizar")){const r=document.querySelector("#telefono").value.trim();if(r==usuario.telefono)return Swal.fire({icon:"info",title:"Sin cambios",showConfirmButton:!1,timer:1e3}),enableScroll(),void e.remove();let t=document.querySelector("#errorTelefono");if(t&&t.remove(),t=document.querySelector("#errorTelefonoLong"),t&&t.remove(),""===r)return alerta=crearAlerta("El Telefono es obligatorio","error","errorTelefono"),void mostrarAlerta(".formulario-modal legend",alerta);if(r.length>10)return alerta=crearAlerta("El Telefono debe tener menos de 11 digitos","error","errorTelefonoLong"),void mostrarAlerta(".formulario-modal legend",alerta);usuario.telefono=r,actualizarUsuario("telefono")}enableScroll()})),document.querySelector(".app").appendChild(e)}))}async function actualizarUsuario(e){const{id:r,nombre:t,apellido:o,passwordN:a,passwordAct:n,telefono:c}=usuario,i=new FormData;switch(i.append("id",r),e){case"nombre":i.append("nombre",t),i.append("apellido",o);break;case"password":i.append("passwordN",a),i.append("passwordAct",n);break;case"telefono":i.append("telefono",c)}i.append("modificacion",e);try{const e=window.location.origin+"/api/actualizar-usuario",r=await fetch(e,{method:"POST",body:i}),t=await r.json();"exito"===t.tipo?Swal.fire(t.mensaje,"","success"):Swal.fire(t.mensaje,"","error");const o=document.querySelector(".modal-app");o&&o.remove()}catch(e){console.log(e)}}function tabs(){document.querySelectorAll(".tabs button").forEach(e=>{e.addEventListener("click",(function(e){paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesPaginador()}))})}function botonesPaginador(){const e=document.querySelector("#anterior"),r=document.querySelector("#siguiente");switch(paso){case 1:e.classList.add("ocultar"),r.classList.remove("ocultar");break;case 2:e.classList.remove("ocultar"),r.classList.remove("ocultar");break;case 3:e.classList.remove("ocultar"),r.classList.add("ocultar"),verificarResumen()}}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",(function(){paso<=1||(paso--,mostrarSeccion(),botonesPaginador())}))}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",(function(){paso>=3||(paso++,mostrarSeccion(),botonesPaginador())}))}function mostrarSeccion(){location.href="#descripcion-pagina";const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");document.querySelector("#paso-"+paso).classList.add("mostrar");const r=document.querySelector(".actual");r&&r.classList.remove("actual");document.querySelector('[data-paso="'+paso+'"]').classList.add("actual")}async function consultarAPI(){try{const e=window.location.origin+"/api/servicios",r=await fetch(e);mostrarServicios(await r.json())}catch(e){console.log(e)}}function mostrarServicios(e){e.forEach(e=>{const{id:r,nombre:t,precio:o,demora:a,oferta:n}=e,c=document.createElement("P");c.classList.add("nombre-servicio"),c.textContent=t;const i=document.createElement("P");i.classList.add("demora-servicio");let s="",l=0;const d=a.split(":");"00"!=d[0]&&(s=s+d[0].charAt(1)+" hora",l+=2*d[0].charAt(1)),"00"!=d[0]&&"00"!=d[1]&&(s+=", "),"00"!=d[1]&&(s=s+d[1]+" minutos","45"==d[1]&&(l+=1),l+=1),i.innerText="Demora aproximada\n"+s;const u=document.createElement("P");u.classList.add("mapeo-demora"),u.textContent=l;const m=document.createElement("BUTTON");m.textContent="Ver Fotos",m.dataset.target="#largeModal",m.dataset.toggle="modal",m.addEventListener("click",(function(e){const r=document.querySelector(".carousel-inner"),o=t.split(/\s+/).join("").toLowerCase(),a=document.querySelectorAll(".carousel-inner .carousel-item");let n,c;a.length>0&&a.forEach(e=>{e.remove()});let i=1;if(existeImagen("build/img/"+o+i+".jpg"))for(;existeImagen("build/img/"+o+i+".jpg");)c=document.createElement("DIV"),c.classList.add("carousel-item"),1==i&&c.classList.add("active"),n=document.createElement("IMG"),n.classList.add("img-size"),n.src="/build/img/"+o+i+".jpg",i++,c.appendChild(n),r.appendChild(c);else n=document.createElement("IMG"),c=document.createElement("DIV"),c.classList.add("carousel-item"),c.classList.add("active"),n.src="/build/img/sinfotos.png",c.appendChild(n),r.appendChild(c)}));const p=document.createElement("P");p.classList.add("precio-servicio"),p.textContent="$"+o;const f=document.createElement("DIV");if(f.classList.add("precio-contenedor"),f.appendChild(p),0!=n){p.classList.add("oferta");const e=document.createElement("DIV");e.classList.add("precio-descuento"),e.textContent="$"+o*((100-n)/100);const r=document.createElement("P");r.classList.add("descuento"),r.textContent=n+"% OFF",e.appendChild(r),f.appendChild(e)}const v=document.createElement("DIV");v.classList.add("servicio"),v.dataset.idServicio=r,v.onclick=function(r){seleccionarServicio(r,e)},v.appendChild(c),v.appendChild(i),v.appendChild(u),v.appendChild(m),v.appendChild(f),document.querySelector("#servicios").appendChild(v)})}function seleccionarServicio(e,r){if("Ver Fotos"==e.target.textContent)return;const t=document.querySelector("#fecha");""!=t.value&&(t.value="",document.querySelector("#hora").value="",document.querySelector("#hora").disabled=!0,alerta=crearAlerta("Al cambiar los servicios debes seleccionar nuevamente una fecha/hora","advertencia","advertenciaFecha"),mostrarAlerta("#paso-1 p",alerta));const{id:o}=r,{serviciosDeseados:a}=cita,n=document.querySelector('[data-id-servicio="'+o+'"]');if(a.some(e=>e.id===o))cita.serviciosDeseados=a.filter(e=>e.id!==o),n.classList.remove("seleccionado");else{if(a.length+1>5)return void Swal.fire({icon:"warning",title:"Aviso",text:"Solo se pueden seleccionar hasta 5 servicios por turno. Crea otro turno para seleccionar mas servicios",showConfirmButton:!0,confirmButtonText:"Entendido"});cita.serviciosDeseados=[...a,r],n.classList.add("seleccionado")}}function seleccionarFecha(){document.querySelector("#fecha").addEventListener("input",(async function(e){const r=new Date(e.target.value).getUTCDay();if(errorFecha=document.querySelector("#errorFecha"),[6,0].includes(r)){if(e.target.value="",errorFecha)return;alerta=crearAlerta("Fines de semana no permitidos","error","errorFecha"),mostrarAlerta("#paso-2 p",alerta)}else{advertenciaFecha=document.querySelector("#advertenciaFecha"),errorFecha&&errorFecha.remove(),advertenciaFecha&&advertenciaFecha.remove(),cita.fecha=e.target.value;try{const e=window.location.origin+"/api/citas-fecha?fecha="+cita.fecha,r=await fetch(e),t=await r.json();if(0==t.length){document.querySelectorAll("option").forEach(e=>{e.textContent=e.textContent.substring(0,5),e.disabled=!1})}else t.forEach(e=>{const r=e.hora.split(":"),t="#t"+r[0]+r[1];let o=document.querySelector(t);let a=0;const n=e.demoraTotal.substring(0,5).split(":");"00"!=n[0]&&(a+=2*n[0].charAt(1)),"00"!=n[1]&&("45"==n[1]&&(a+=1),a+=1);let c=0;for(;c<a;)o.textContent=o.textContent+" RESERVADO",o.disabled=!0,o=o.nextElementSibling,c++})}catch(e){}document.querySelector("#hora").value="",document.querySelector("#hora").disabled=!1}}))}function seleccionarHora(){document.querySelector("#hora").addEventListener("input",(function(e){const r=e.target.value;let t=0;cita.serviciosDeseados.forEach(e=>{const r=document.querySelector('[data-id-servicio="'+e.id+'"] .mapeo-demora').textContent;t+=parseInt(r)});const o=e.target.value.split(":"),a="#t"+o[0]+o[1];let n=document.querySelector(a),c=!1,i=1;for(;!c&&null!=n;)null!=n.nextElementSibling&&(n.nextElementSibling.disabled?c=!0:i++),n=n.nextElementSibling;if(errorDisponible=document.querySelector("#errorDisponible"),i<t){if(e.target.value="",cita.hora="",errorDisponible)return;alerta=crearAlerta("Elije otro horario/fecha, el tiempo de tu cita excede el disponible","error","errorDisponible"),mostrarAlerta("#paso-2 p",alerta)}else{const t=r.split(":")[0];if(errorHora=document.querySelector("#errorHora"),t<10||t>19){if(e.target.value="",errorHora)return;alerta=crearAlerta("Debes seleccionar una hora entre las 10am y 19:30pm","error","errorHora"),mostrarAlerta("#paso-2 p",alerta)}else errorHora&&errorHora.remove(),errorDisponible&&errorDisponible.remove(),cita.hora=e.target.value}}))}function verificarResumen(){if(errorFecha=document.querySelector("#errorFechaResumen"),errorHora=document.querySelector("#errorHoraResumen"),errorServicios=document.querySelector("#errorServiciosResumen"),""==cita.fecha?errorFecha||(alerta=crearAlerta("Debes seleccionar una fecha","error","errorFechaResumen"),alertas.push(alerta)):errorFecha&&(errorFecha.remove(),alertas=alertas.filter(e=>"errorFechaResumen"!=e.id)),""==cita.hora?errorHora||(alerta=crearAlerta("Debes seleccionar una hora","error","errorHoraResumen"),alertas.push(alerta)):errorHora&&(errorHora.remove(),alertas=alertas.filter(e=>"errorHoraResumen"!=e.id)),0===cita.serviciosDeseados.length?errorServicios||(alerta=crearAlerta("Debes seleccionar al menos un servicio","error","errorServiciosResumen"),alertas.push(alerta)):errorServicios&&(errorServicios.remove(),alertas=alertas.filter(e=>"errorServiciosResumen"!=e.id)),0===alertas.length)mostrarResumen();else{const e=document.querySelector(".contenido-resumen");for(;e.firstChild;)e.removeChild(e.firstChild);alertas.forEach(e=>mostrarAlerta("#paso-3 p",e))}}function mostrarResumen(){for(resumen=document.querySelector(".contenido-resumen");resumen.firstChild;)resumen.removeChild(resumen.firstChild);const{nombre:e,fecha:r,hora:t,serviciosDeseados:o,direccion:a}=cita,n=document.createElement("P");n.innerHTML="<span>Nombre: </span>"+e;const c=document.createElement("P");c.innerHTML="<span>Lugar: </span>"+a;const i=new Date(r),s=i.getMonth(),l=i.getDate()+2,d=i.getFullYear(),u=new Date(Date.UTC(d,s,l)).toLocaleDateString("es-AR",{weekday:"long",year:"numeric",month:"long",day:"numeric"}),m=document.createElement("P");m.innerHTML="<span>Fecha: </span>"+u;const p=document.createElement("P");p.innerHTML="<span>Hora: </span>"+t;let f=0,v=0,h=0,b=0;if(o.forEach(e=>{const{precio:r,nombre:t,demora:o,oferta:a}=e,n=document.createElement("P");n.classList.add("contenedor-servicio");const c=document.createElement("P");c.textContent=t;const i=document.createElement("P");0!=a?(f+=parseFloat(r*((100-a)/100)),b+=parseInt(a),i.classList.add("oferta"),i.innerHTML='Precio: <span class="primero">$'+r+'</span> <span class="segundo">$'+r*((100-a)/100)+' </span><span class="tercero">'+a+"%OFF</span>"):(f+=parseFloat(r),i.innerHTML="<span>Precio: </span> $"+r,i.classList.add("sin-oferta"));const s=o.split(":");v+=parseInt(s[0].charAt(1)),h+=parseInt(s[1]),n.appendChild(c),n.appendChild(i),resumen.appendChild(n)}),h>60){const e=Math.floor(h/60);v+=e,h%=60}const y=v+":"+h;let g=0!=v?v>1?v+" horas ":v+" hora ":"";g+=0!=h?h+" minutos":"",cita.demoraTotal=y;const S=document.createElement("P");S.innerHTML="<span>Demora aproximada: </span>"+g,f=f.toString(),f.includes(".")||(f+=".00");const w=document.createElement("P");w.innerHTML=0==b?"<span>Total a Pagar: </span> $"+f:"<span>Total a Pagar: </span> $"+f+'<span class="porcentaje">'+b+"%OFF TOTAL</span>",cita.total=f;const C=document.createElement("BUTTON");C.classList.add("boton"),C.textContent="Reservar Cita",C.onclick=reservarCita;const L=o.length+1,E=document.createElement("DIV");E.textContent="SERVICIOS",E.classList.add("textoServicios"),E.style.gridRow="1 / "+L;const q=document.createElement("DIV");q.textContent="CITA",q.classList.add("textoCita"),q.style.gridRow=L;const A=document.createElement("DIV");A.classList.add("contenedor-cita"),A.appendChild(n),A.appendChild(c),A.appendChild(m),A.appendChild(p),A.appendChild(S),A.appendChild(w),resumen.appendChild(E),resumen.appendChild(q),resumen.appendChild(A),resumen.appendChild(C)}async function reservarCita(){const{fecha:e,hora:r,total:t,usuarioId:o,serviciosDeseados:a,demoraTotal:n,direccion:c}=cita,i=a.map(e=>e.id),s=new FormData;s.append("fecha",e),s.append("hora",r),s.append("total",t),s.append("demoraTotal",n),s.append("serviciosId",i),s.append("servicios",JSON.stringify(a)),s.append("usuarioId",o),s.append("direccion",c);try{const e=window.location.origin+"/api/citas";Swal.fire({title:"Creando Cita",html:"Espere...",timer:3e3,timerProgressBar:!0,allowOutsideClick:!1,didOpen:()=>{Swal.showLoading();const e=Swal.getHtmlContainer().querySelector("b");timerInterval=setInterval(()=>{e.textContent=Swal.getTimerLeft()},100)},willClose:()=>{clearInterval(timerInterval)}});const r=await fetch(e,{method:"POST",body:s});(await r.json()).resultado&&Swal.fire({icon:"success",title:"Cita Creada",text:"Tu cita fue creada correctamente. Hemos enviado un email a tu dirección con la confirmacion de la cita.",button:"OK"}).then(()=>{window.location.reload()})}catch(e){Swal.fire({icon:"error",title:"Error",text:"Hubo un error al guardar la cita"}),console.log(e)}}function crearAlerta(e,r,t=null){const o=document.createElement("DIV");return o.textContent=e,o.classList.add("alerta"),o.classList.add(r),o.setAttribute("id",t),o}function mostrarAlerta(e,r){let t=document.querySelector("#"+r.id);t?t.remove():(t=document.querySelector("."+r.class),t&&t.remove());document.querySelector(e).appendChild(r)}async function existeImagen(e){fetch(e,{method:"HEAD"}).then(e=>!!e.ok).catch(e=>console.log("Error:",e))}document.addEventListener("DOMContentLoaded",(function(){iniciarApp()}));var keys={37:1,38:1,39:1,40:1};function preventDefault(e){e.preventDefault()}function preventDefaultForScrollKeys(e){if(keys[e.keyCode])return preventDefault(e),!1}var supportsPassive=!1;try{window.addEventListener("test",null,Object.defineProperty({},"passive",{get:function(){supportsPassive=!0}}))}catch(e){}var wheelOpt=!!supportsPassive&&{passive:!1},wheelEvent="onwheel"in document.createElement("div")?"wheel":"mousewheel";function disableScroll(){window.addEventListener("DOMMouseScroll",preventDefault,!1),window.addEventListener(wheelEvent,preventDefault,wheelOpt),window.addEventListener("touchmove",preventDefault,wheelOpt),window.addEventListener("keydown",preventDefaultForScrollKeys,!1)}function enableScroll(){window.removeEventListener("DOMMouseScroll",preventDefault,!1),window.removeEventListener(wheelEvent,preventDefault,wheelOpt),window.removeEventListener("touchmove",preventDefault,wheelOpt),window.removeEventListener("keydown",preventDefaultForScrollKeys,!1)}