<?php
$page_title = 'Apagar usuário';
$page_content = '<h2>Apagar perfil</h2>';
$id = 0;

if (isset($_GET['u'])) $id = intval($_GET['u']);

if ($id == 0) header('Location: /?p=e404');

$sql = "SELECT id, name FROM users WHERE id = '{$id}' AND status != 'deleted'";

$res = $conn->query($sql);

if ($res->num_rows != 1) header('Location: /?p=e404');

$user = $res->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") :

    $sql = "UPDATE users SET status = 'deleted' WHERE id = '{$id}'";
    $conn->query($sql);

    $page_content .= <<<HTML

    <div class="form-delete">
        <p>Usuário apagado com sucesso!</p>
        <p class="user-tools"><a href="/">Listar usuários</a></p>
    </div>

HTML;

else :

    $page_content .= <<<HTML

<form method="post" action="{$_SERVER['REQUEST_URI']}" class="form-delete">

    <p>Tem certeza que deseja apagar o perfil de "{$user['name']}"?</p>
    <blockquote><em>Esta ação não pode ser desfeita!</em></blockquote>
    <div class="buttons">
        <button type="button" onclick="location.href='/'">Não, voltar para a listagem</button>
        <button type="submit">Sim, pode apagar!</button>        
    </div>

</form>

HTML;

endif;
