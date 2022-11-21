consultaPaciente()

function consultaPaciente() {

    if (sessionStorage.getItem('idpaciente') != undefined) {
        var idpaciente = sessionStorage.getItem('idpaciente')
    }
    else {
        window.location.href = 'hospital.php?consulta'
    }

    //llamada al servicio de consulta de paciente
    let url = 'servicios/consultapaciente.php'

    //datos a enviar
    let datos = new FormData()
    datos.append('idpaciente', idpaciente)

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
                var paciente = mensaje
                //recorro el array añadiendo a los inputs los valores
                for (i in paciente) {
                    document.getElementById('idpaciente').value = `${paciente[1].idpaciente}`
                    document.getElementById('nif').value = `${paciente[1].nif}`
                    document.getElementById('nombre').value = `${paciente[1].nombre}`
                    document.getElementById('apellidos').value = `${paciente[1].apellidos}`
                    document.getElementById('fechaingreso').value = `${paciente[1].fechaingreso}`
                    //document.getElementById('fechaalta').value = `${paciente[1].fechaalta}`
                }
            } else {
                throw ('Error al realizar la consulta de pacientes')
            }
        })
        .catch(function (error) {
            window.alert(error)
        })






}