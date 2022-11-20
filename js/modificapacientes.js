document.getElementById('modificacion').onclick = modificaPaciente

function modificaPaciente() {

    //recuperar los datos a enviar
    let nif = document.querySelector('#nif').value
    let nombre = document.querySelector('#nombre').value
    let apellidos = document.querySelector('#apellidos').value
    let fechaingreso = document.querySelector('#fechaingreso').value
    let fechaalta = document.querySelector('#fechaalta').value

    //validar si estan informados los datos
    try {
        if (nif == null || nif.length == 0) {
            throw ('Falta el numero de nif');
        }
        if (apellidos == null || apellidos.length == 0) {
            throw ('Faltan los apellidos');
        }
        if (nombre == null || nombre.length == 0) {
            throw ('Falta el nombre');
        }
        if (fechaingreso == null || fechaingreso.length == 0) {
            throw ('Falta la fecha de ingreso');
        }
        if (fechaalta == null || fechaalta.length == 0) {
            throw ('Falta la fecha de alta');
        }
    } catch (error) {
        alert(error)
    }

    //llamada al servicio de consulta de paciente
    let url = 'servicios/modificacionpaciente.php'

    //datos a enviar
    let datos = new FormData()
    datos.append('idpaciente', idpaciente)
    datos.append('nif', nif)
    datos.append('nombre', nombre)
    datos.append('apellidos', apellidos)
    datos.append('fechaingreso', fechaingreso)
    datos.append('fechaalta', fechaalta)

    let parametros = {
        method: 'post',
        body: datos
    }

    fetch(url, parametros)
        .then(function (respuesta) {
            if (respuesta.ok) {
                return respuesta.json()
            } else {
                throw ('Algo ha ido mal en la petición')
            }
        })
        .then(function (mensaje) {
            //si llega un 30 como primer elemento
            if (mensaje[0] == '30') {
                //paso mensaje json a array js


            } else {
                throw ('Error al realizar la consulta de pacientes')
            }
        })
        .catch(function (error) {
            window.alert(error)
        })




}