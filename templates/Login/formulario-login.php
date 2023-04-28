<?php include __DIR__ . '/../header.html.php'; ?>

<form action="/realiza-login" method="POST">
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" id="descricao" name="email" class="form-control">

        <label for="password">Senha</label>
        <input type="password" name="senha" id="password" class="form-control">
    </div>
    <button class="btn btn-primary">Entrar</button>
</form>

<?php include __DIR__ . '/../footer.html.php'; ?>