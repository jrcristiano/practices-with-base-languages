<?php

?>

<div class="col-10">
    <div class="d-flex align-items justify-content-between mx-2">
        <h1>NOVO PRODUTO</h1>
        <a href="/produtos" class="button-anchor button-primary align-self-center fw-bold">
            <i class="fas fa-undo"></i> Voltar
        </a>
    </div>

    <form method="post" action="/produtos/salvar" class="w-100">
        <div class="w-100 d-flex">
            <div class="w-100 p-1 rounded ml-2">
                <label class="fw-bold text-dark" for="name">
                    Nome <span class="text-danger">*</span>
                </label>
                <input id="name" type="text" placeholder="Nome" class="form-control">
            </div>
            <div class="w-100 p-1 rounded ml-3 mr-3">
                <label class="fw-bold text-dark" for="price">
                    Preço <span class="text-danger">*</span>
                </label>
                <input id="price" type="text" placeholder="Preço" class="form-control">
            </div>
        </div>
        <div class="w-100 d-flex">
            <div class="w-100 p-1 rounded ml-2">
                <label class="fw-bold text-dark" for="category_id">
                    Categoria <span class="text-danger">*</span>
                </label>
                <select id="category_id" class="form-control" name="category_id">
                    <option value="">SELECIONAR CATEGORIA</option>
                </select>
            </div>
        </div>
        <div class="w-100 d-flex">
            <div class="w-100 p-1 mx-2">
                <button class="button button-success" type="submit">
                    <i class="fas fa-check"></i> Salvar
                </button>
            </div>
        </div>
    </form>
</div>