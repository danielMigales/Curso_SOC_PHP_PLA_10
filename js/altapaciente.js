document.getElementById('alta').onclick = altaPaciente

function altaPaciente() {

    try {
        //recuperar los datos a enviar
        let nif = document.querySelector('#nif').value.trim()
        let nombre = document.querySelector('#nombre').value.trim()
        let apellidos = document.querySelector('#apellidos').value.trim()
        let fechaingreso = document.querySelector('#fechaingreso').value.trim()

        if (nif == null || nif.length == 0) {
            throw ('Introduzca el numero de nif');
        }
        if (apellidos == null || apellidos.length == 0) {
            throw ('Introduzca los apellidos');
        }
        if (nombre == null || nombre.length == 0) {
            throw ('Introduzca el nombre');
        }
        if (fechaingreso == null || fechaingreso.length == 0) {
            throw ('Introduzca la fecha de ingreso');
        }
    } catch (error) {
        alert(error)
    }


    //informar del servicio php a invocar
    let url = 'servicios/altapaciente.php'

    let datos = new FormData()
    datos.append('nif', nif)
    datos.append('nombre', nombre)
    datos.append('apellidos', apellidos)
    datos.append('fechaingreso', fechaingreso)


    //definir los parametros de la peticion ajax
    let parametros = {
        method: 'post',
        body: datos
    }

    //enviar la peticion al servidor usando fetch
    fetch(url, parametros)
        .then(function (respuesta) {
            if (respuesta.ok) {
                return respuesta.text()
            } else {
                throw ('Algo ha ido mal en la petición')
            }
        })
        .then(function (mensaje) {           
            if (mensaje.substring(0, 2) == '00') {
                alert(mensaje.substring(2))
                document.querySelector('formulario').reset
            }
            else{
                alert(mensaje)
            }
        })
        .catch(function (error) {
            window.alert(error)
        })
}