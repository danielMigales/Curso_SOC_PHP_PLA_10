document.getElementById('baja').onclick = bajaPaciente

function bajaPaciente() {

    //recuperar los datos a enviar
   // let idpaciente = document.querySelector('#idpaciente').value

    if (sessionStorage.getItem('idpaciente') != undefined) {
        var idpaciente = sessionStorage.getItem('idpaciente')
    }
    else {
        window.location.href = 'hospital.php?consulta'
    }

    // console.log(idpaciente)

    //validar si estan informados los datos
    try {
        if (idpaciente == null || idpaciente.length == 0) {
            throw ('id de paciente no encontrado');
        }

    } catch (error) {
        alert(error)
    }

    //llamada al servicio de baja de paciente
    let url = 'servicios/bajapaciente.php'

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
                return respuesta.text()
            } else {
                throw ('Algo ha ido mal en la petición')
            }
        })
        .then(function (mensaje) {
            //variables para recortar el mensaje de respuesta
            let codigoMensaje = mensaje.substring(0, 2)
            let mensajeFinal = mensaje.substring(2)
            //si el numero es 50 es correcto
            if (codigoMensaje == '50') {
                alert(mensajeFinal)
                //se borra el formulario
                document.querySelector('#formulario').reset()
                //se borra el storage
                sessionStorage.removeItem('idpaciente')
                window.location.href = 'hospital.php?consulta'
            } else {
                alert('Error al realizar la baja del paciente' + '\n' + mensajeFinal)
            }
        })
        .catch(function (error) {
            window.alert(error)
        })

}