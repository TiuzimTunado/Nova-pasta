<?php

header('Content-Type: application/json');

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['nome']) || empty($dados['email']) || empty($dados['cpf']) || empty($dados['senha'])) {/* verificação de campos vazios */
    echo json_encode(['status' => false, 'msg' => "<div class='alert alert-danger'>Preencha todos os campos!</div>"]);
    exit;
}

if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) { /* expressão regular para validar o e-mail */
    echo json_encode(['status' => false, 'msg' => "<div class='alert alert-danger'>E-mail inválido!</div>"]);
    exit;
}

if (!preg_match("/^([0-9]{3}\.?[0-9]{3}\.?[0-9]{3}\-?[0-9]{2})$/", subject: $dados['cpf'])) { /* expressão regular para validar o CPF */
    echo json_encode(['status' => false, 'msg' => "<div class='alert alert-danger'>CPF inválido!</div>"]);
    exit;
}

if (strlen($dados['senha']) < 8) { 
    echo json_encode(['status' => false, 'msg' => "<div class='alert alert-danger'>A senha deve ter pelo menos 8 caracteres.</div>"]);
    exit;
}

echo json_encode(['status' => true, 'dados' => [ /*manda os dados para o index.php */
    'nome' => $dados['nome'],
    'email' => $dados['email'],
    'cpf' => $dados['cpf'],
    'senha' => $dados['senha']
]]);
