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
</div>