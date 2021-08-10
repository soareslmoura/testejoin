
<div class="modal fade" id="modalExclusaoProduto" tabindex="-1" role="dialog" aria-labelledby="modalExclusaoProdutoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dc3545; color: white">
                <h5 class="modal-title" id="exampleModalLabel">Exclusão de Produto</h5>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir o registro?

                <form method="post" action="{{route('produtos.destroy',['produto'=>0])}}">
                    @csrf
                    @method('delete')
                    <input type="hidden" id="produtoDelete_id" name="produtoDelete_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>
