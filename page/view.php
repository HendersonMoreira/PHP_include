<?php
$page_title = 'Perfil';
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

$parts = explode(' ', $user['name']);
$user['viewname'] = $parts[0] . ' ' . $parts[count($parts) - 1];

$user['age'] = get_age($user['birth']);

if ($user['status'] == 'active') {
    $user_status = '<span class="active">ATIVO</span> [<a href="/?p=status&u=' . $id . '&a=0">Desativar</a>]';
} else {
    $user_status = '<span class="inactive">INATIVO</span> [<a href="/?p=status&u=' . $id . '&a=1">Ativar</a>]';
}

switch ($user['type']) {
    case 'author':
        $user_type = "Autor";
        break;
    case 'moderator':
        $user_type = "Moderador";
        break;
    case 'admin':
        $user_type = "Administrador";
        break;
    default:
        $user_type = "Usuário";
}

$user_bio = nl2br(htmlspecialchars($user['bio']));

$page_content = <<<HTML

<div class="user-box">

    <div class="user-image"><img src="{$user['avatar']}" alt="{$user['name']}"></div>
    <div class="user-data">
        <h3>{$user['viewname']}</h3>
        <p>{$user_bio}</p>
        <ul>
            <li><strong>Nome:</strong> {$user['name']}</li>
            <li><strong>E-mail:</strong> {$user['email']} [<a href="mailto:{$user['email']}" target="_blank" title="Enviar e-mail para {$user['name']}">&rarr;&#9993;</a>]</li>
            <li><strong>Nascimento:</strong> {$user['birth_br']} - {$user['age']} anos</li>
        </ul>
        <hr>
        <ul>
            <li><strong>ID:</strong> {$user['id']}</li>
            <li><strong>Data:</strong> {$user['date_br']}</li>
            <li><strong>Tipo de usuário:</strong> {$user_type}</li>
            <li><strong>Status:</strong> {$user_status}</li>
        </ul>
    </div>
    <div class="user-tools">
        <a href="/?p=edit&u={$id}">Editar</a>
        <a href="/?p=delete&u={$id}">Apagar</a>
    </div>

</div>

HTML;
