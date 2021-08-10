


function excluirProduto(id) {
    $('#produtoDelete_id').val('')
    $('#produtoDelete_id').val(id)
    $('#modalExclusaoProduto').modal('show')
}

function excluirCategoria(id) {
    $('#categoriaDelete_id').val('')
    $('#categoriaDelete_id').val(id)
    $('#modalExclusaoCategoria').modal('show')
}
