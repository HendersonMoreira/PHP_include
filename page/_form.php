<?php
$options = array(
    'user'      => 'Usuário',
    'author'    => 'Autor',
    'moderator' => 'Moderador',
    'admin'     => 'Administrador'
);

$type_options = "\n";

foreach ($options as $key => $value) :

    if ($key == trim(strtolower($user_form['type'])))

        $type_options .= "<option value=\"{$key}\" selected>{$value}</option>\n";

    else

        $type_options .= "<option value=\"{$key}\">{$value}</option>\n";

endforeach;

$form_password = '';

if ($user_form['password']) :

    $form_password = <<<HTML

<div class="separator"></div>

<p>
    <label for="password">Senha temporária:</label>
    <span class="password">
        <input type="password" name="password" id="password" value="">
        <button type="button" id="toglePass"><i class="fa-solid fa-eye fa-fw"></i></button>
    </span>
</p>

HTML;

endif;

$form = <<<HTML

<form action="{$user_form['action']}" method="post" class="user-form">

    <p>
        <label for="name">Nome:</label>
        <input type="text" name="name" id="name" value="{$user_form['name']}">
    </p>

    <p>
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" value="{$user_form['email']}">
    </p>

    <p>
        <label for="avatar">URL do Avatar:</label>
        <input type="url" name="avatar" id="avatar" value="{$user_form['avatar']}">
    </p>

    <p>
        <label for="birth">Data de Nascimento:</label>
        <input type="date" name="birth" id="birth" value="{$user_form['birth']}">
    </p>

    <p>
        <label for="bio">Resumo:</label>
        <textarea name="bio" id="bio">{$user_form['bio']}</textarea>
    </p>

    {$form_password}

    <div class="separator"></div>

    <p>
        <label for="type">Tipo:</label>
        <select name="type" id="type">
            {$type_options}
        </select>
    </p>

    <div class="separator"></div>

    <p>
        <button type="submit">Salvar</button>
    </p>

</form>

HTML;