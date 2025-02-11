<?php
    include_once 'templates/header.php';
?>



    <div class="container">
        <?php include_once 'templates/backbtn.html'?>
        <h1 id="main-title">Editar contato</h1>
        <form id="create-form" action="<?= $BASE_URL; ?>config/process.php" method="post">
            <input type="hidden" name="type" value="edit">
            <input type="hidden" name="id" value="<?= $contact['id']?>">
            <div class="form-group">
                <label for="name">Nome do contato:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome" required value="<?= $contact['name']?>">
            </div>
            <div class="form-group">
                <label for="phone">Telefone do contato:</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Digite o telefone" required value="<?= $contact['phone']?>">
            </div>
            <div class="form-group">
                <label for="observations">Observações:</label>
                <textarea type="text" class="form-control" id="observations" name="observations" placeholder="Digite as observações" rows=3><?= $contact['observations']?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>

<?php
    include_once 'templates/footer.php';
?>
