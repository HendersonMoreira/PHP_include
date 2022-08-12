<?php
$page_title = 'Cadastro';
$page_content = "<h2>Cadastro de novo usuário</h2>";

$user_form = array(
    'action' => $_SERVER['REQUEST_URI'],
    'name' => '',
    'email' => '',
    'avatar' => '',
    'birth' => '',
    'bio' => '',
    'type' => '',
    'password' => true
);

require('page/_form.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") :

    $sql = <<<SQL

INSERT INTO users (name, email, password, avatar, birth, bio, type)
VALUES (
    '{$_POST['name']}',
    '{$_POST['email']}',
    SHA1('{$_POST['password']}'),
    '{$_POST['avatar']}',
    '{$_POST['birth']}',
    '{$_POST['bio']}',
    '{$_POST['type']}'
);

SQL;

    $conn->query($sql);

    $page_content .= <<<HTML

<p>Novo usuário cadastrado com sucesso!</p>
<p class="center">
    <a href="/?p=signup">Cadastrar novo</a> &nbsp;|&nbsp;
    <a href="/">Listar usuários</a>
</p>

HTML;

else :

    $page_content .= <<<HTML

<p>Preencha todos os campos com atenção.</p>
{$form}


HTML;

endif;
