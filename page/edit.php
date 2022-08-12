<?php
$page_title = 'Editar perfil';
$page_content = "<h2>Editar usuário</h2>";
$id = 0;

if (isset($_GET['u'])) $id = intval($_GET['u']);

if ($id == 0) header('Location: /?p=e404');

$sql = <<<SQL

SELECT 
    *,
    DATE_FORMAT(date, '%d/%m/%Y às %H:%i:%s') AS date_br,
    DATE_FORMAT(birth, '%d/%m/%Y') AS birth_br
FROM users 
WHERE 
    id = '{$id}' 
    AND status != 'deleted'

SQL;

$res = $conn->query($sql);

if ($res->num_rows != 1) header('Location: /?p=e404');

$user = $res->fetch_assoc();

$user_form = array(
    'action' => $_SERVER['REQUEST_URI'],
    'name' => $user['name'],
    'email' => $user['email'],
    'avatar' => $user['avatar'],
    'birth' => $user['birth'],
    'bio' => $user['bio'],
    'type' => $user['type'],
    'password' => false
);

require('page/_form.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") :

    $sql = <<<SQL

UPDATE users SET
    name = '{$_POST['name']}',
    email = '{$_POST['email']}',
    avatar = '{$_POST['avatar']}',
    birth = '{$_POST['birth']}',
    bio = '{$_POST['bio']}',
    type = '{$_POST['type']}'
WHERE id = '{$id}'
    AND status != 'deleted';

SQL;

    $conn->query($sql);
    
    $page_content .= <<<HTML

<p>Dados do usuário salvos com sucesso!</p>
<p class="center">
    <a href="/?p=view&u={$id}">Ver perfil</a> &nbsp;|&nbsp;
    <a href="/">Listar usuários</a>
</p>

HTML;

else :

    $page_content .= <<<HTML

<p>Preencha todos os campos com atenção.</p>
{$form}


HTML;

endif;
