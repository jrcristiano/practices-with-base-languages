<?php
    require_once __DIR__.'/../../Conn.php';

    $products = [];
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
            ORDER BY id desc');

        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (\Exception $exception) {
        echo 'Erro ao listar: ' . $exception->getMessage();
    }
?>

<div class="col-10">
    <div class="d-flex align-items justify-content-between mx-2">
        <h1>PRODUTOS</h1>
        <a href="/produtos/novo" class="button-anchor button-primary align-self-center fw-bold">
           <i class="fas fa-plus"></i> Novo produto
        </a>
    </div>
    <table class="table-striped w-100 mt-4">
        <thead class="border-bottom">
            <tr>
                <th class="col">#</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Categoria</th>
                <th>Criado em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td class="id text-uppercase">
                        <?php echo $product['id']; ?>
                    </td>
                    <td class="text-uppercase">
                        <?php echo $product['name']; ?>
                    </td>
                    <td>
                        <?php echo 'R$ ' . number_format($product['price'], 2, ',', '.'); ?>
                    </td>
                    <td class="text-uppercase">
                        <?php echo $product['category_name']; ?>
                    </td>
                    <td>
                        <?php 
                            $createdAt = new \DateTime($product['created_at']);
                            echo $createdAt->format('d/m/Y');
                        ?>
                    </td>
                    <td>
                        <a class="button-anchor-sm button-primary" 
                            href="/produtos/exibir?id=<?php echo $product['id']; ?>">
                                <i class="fas fa-eye"></i>
                        </a>
                        <a id="really-remove" 
                            class="button-anchor-sm button-danger" 
                            href="/produtos/remover?id=<?php echo $product['id']; ?>">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>