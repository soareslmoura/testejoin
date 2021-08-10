
<div class="modal fade" id="modalExclusaoCategoria" tabindex="-1" role="dialog" aria-labelledby="modalExclusaoCategoriaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dc3545; color: white">
                <h5 class="modal-title" id="exampleModalLabel">Exclusão de Categoria</h5>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir o registro?

                <form method="post" action="{{route('categorias.destroy',['categoria'=>0])}}">
                    @csrf
                    @method('delete')
                    <input type="hidden" id="categoriaDelete_id" name="categoriaDelete_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>
