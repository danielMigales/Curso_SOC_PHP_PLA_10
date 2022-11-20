//llamada a la funcion
consultaPacientes()

function consultaPacientes() {

    //llamada al servicio de consulta de pacientes
    let url = 'servicios/consultapacientes.php'

    let parametros = {
        method: 'post',
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
            //si el primer elemento del json es el codigo 30
            if (mensaje[0] == '30') {
                //paso mensaje json a array js
                var pacientes = mensaje[1]
                //variable para crear la tabla
                let tabla = "";
                //bucle que recorre el array y crea la tabla
                for (i in pacientes) {
                    tabla += `<tr>`
                    tabla += `<td>${pacientes[i].idpaciente}</td>`
                    tabla += `<td>${pacientes[i].nif}</td>`
                    tabla += `<td>${pacientes[i].nombre}</td>`
                    tabla += `<td>${pacientes[i].apellidos}</td>`
                    tabla += `<td>${pacientes[i].fechaingreso}</td>`
                    tabla += `<td><input type = 'button' class='consulta' value='Detalle paciente' onclick='detallePaciente(${pacientes[i].idpaciente})'></td>`
                    tabla += `</tr>`
                }
                //manda la tabla creada al html
                document.getElementById('pacientes').innerHTML = tabla
            }
            //si el codigo que llega no es 30 salta error
            else {
                throw ('Error al realizar la consulta de pacientes')
            }
        })
        .catch(function (error) {
            window.alert(error)
        })

}