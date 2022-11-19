consultaPacientes()

function consultaPacientes() {

    let url = 'servicios/consultapacientes.php'
    let tabla = null;

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
            for (i in pacientes) {
                tabla += `<tr>`
                tabla += `<td>${pacientes[i].idpaciente}</td>`
                tabla += `<td>${pacientes[i].nif}</td>`
                tabla += `<td>${pacientes[i].nombre}</td>`
                tabla += `<td>${pacientes[i].apellidos}</td>`
                tabla += `<td>${pacientes[i].fechaingreso}</td>`
                tabla += `<td><input type = 'button' class='consulta' value='Detalle paciente' onclick='detallePaciente(${paciente[i].idpaciente})'></td>`
                tabla += `</tr>`
            }
            document.getElementById('pacientes').innerHTML = tabla
        })
        .catch(function (error) {
            window.alert(error)
        })

}