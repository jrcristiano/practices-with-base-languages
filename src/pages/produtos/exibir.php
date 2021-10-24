<?php
    require_once __DIR__.'/../../Conn.php';

    $product = new \stdClass;

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if (!$id) {
        require_once __DIR__.'/../not-found.php';
    }
        
    try {
        $conn = Conn::getInstance();
        $stmt = $conn->prepare('SELECT p.id,
            p.name as name, 
            p.price, 
            p.created_at,
            c.name as category_name
            FROM products as p
            INNER JOIN categories as c
            ON p.category_id = c.id
            WHERE p.id = :id');

        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $product = $stmt->fetch(PDO::FETCH_OBJ);

        if ($product == false) {
            require_once __DIR__.'/../not-found.php';
        }

    } catch (\Exception $exception) {
        echo 'Erro ao exibir produto: ' . $exception->getMessage();
    }
?>

<div class="col-10">
    <div class="d-flex justify-content-between mx-2">
        <h1 class="text-uppercase">
            <?php echo $product->name ?? null ?>
        </h1>
        <?php
            $id = $product->id ?? null;
        ?>
        <div class="actions d-flex align-items">
            <a href="/produtos" 
                class="button-anchor button-primary align-self-center fw-bold">
                    <i class="fas fa-undo"></i> Voltar
            </a>
            <a href="/produtos/editar?id=<?php echo $id; ?>" 
                class="button-anchor button-primary align-self-center fw-bold ml-1">
                    <i class="fas fa-edit"></i> Editar
            </a>
            <a id="really-remove" href="/produtos/remover?id=<?php echo $id; ?>" 
                class="button-anchor button-danger align-self-center fw-bold ml-1">
                    <i class="fas fa-trash"></i> Remover
            </a>
        </div>
    </div>
    <div class="w-100 mb-2">
        <div class="w-100 d-flex">
            <div class="w-100 border p-1 rounded mr-2 ml-2">
                <span class="fw-bold">
                    Preço
                </span>
                <div class="w-100 pt-1">
                    <?php 
                        $price = $product->price ?? null;
                        echo 'R$ ' . number_format($price, 2, ',', '.');
                    ?>
                </div>
            </div>
            <div class="w-100 border p-1 rounded mr-2">
                <span class="fw-bold">
                    Categoria
                </span>
                <div class="w-100 pt-1 text-uppercase">
                    <?php 
                        echo $product->category_name ?? null;
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="w-100">
        <div class="w-100 d-flex">
            <div class="w-100 border p-1 rounded mr-2 ml-2">
                <span class="fw-bold">
                    Criado em
                </span>
                <div class="w-100 pt-1">
                    <?php 
                        $createdAt = new \DateTime($product->created_at);
                        echo $createdAt->format('d/m/Y H:i');
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>