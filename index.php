<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="title">Cadastro de Usuário</h1>
        <div id="msgAlerta"></div>
        <form id="formCadastro">
            <div class="mb-3">
                <label for="nome" ></label>
                <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome Completo" required>
            </div>
            <div class="mb-3">
                <label for="email" ></label>
                <input type="email" id="email" name="email" class="form-control" placeholder="E-mail"required>
            </div>
            <div class="mb-3">
                <label for="cpf" ></label></label>
                <input type="text" id="cpf" name="cpf" class="form-control" placeholder="CPF" required>
            </div>
            <div class="mb-3">
                <label for="senha" ></label>
                <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha"required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="cadastroModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cadastro Realizado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody"></div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("formCadastro").addEventListener("submit", async function (event) {
            event.preventDefault();

            if (document.getElementById('senha').value.length < 8) {
                alert("A senha deve ter pelo menos 8 caracteres.");
                return;
            }


            let formData = new FormData(this);
            let response = await fetch('cadastro.php', {
                method: 'POST',
                body: formData
            });
            let result = await response.json();

            if (result.status) {
                document.getElementById("modalBody").innerHTML = `<p><strong>Nome:</strong> ${result.dados.nome}</p>
                                                                   <p><strong>E-mail:</strong> ${result.dados.email}</p>
                                                                   <p><strong>CPF:</strong> ${result.dados.cpf}</p>
                                                                    <p><strong>Senha:</strong> ${result.dados.senha}</p>`;
                let modal = new bootstrap.Modal(document.getElementById('cadastroModal'));
                modal.show();
            } else {
                document.getElementById("msgAlerta").innerHTML = result.msg;
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>