function getMunicipios(departamentoHtml, municipioSelectHtml, selectedMunicipioId = null) {
    let departamento = $(departamentoHtml)
    let municipio = $(municipioSelectHtml)

    departamento.on('change', function() {
        let departamentoId = $(this).val()
        municipio.html('<option value=""> Cargando </option>')

        if (departamentoId) {
            $.ajax({
                url : '/municipios/' + departamentoId,
                type : 'GET',
                dataType : 'json',
                success: function(data) {
                    municipio.html('<option value="">Seleccione </option>')
                    $.each(data, function (index, mun) {
                        let seleccionado = (selectedMunicipioId && mun.id == selectedMunicipioId) ? 'selected' : ''
                        municipio.append(`<option value="${mun.id}" ${seleccionado}> ${mun.nombre} </option>`)
                    })
                },
                error: function() {
                    municipio.append('<option value="">Erorr al carga municipios</option>')
                }
            })
        } else {
            municipio.html('<option value="">Seleccione departamento primero...</option>')
        }
    })
}
