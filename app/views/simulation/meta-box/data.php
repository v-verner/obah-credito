<?php defined('ABSPATH') || exit('No direct script access allowed'); 
$simulation = loadSimulation( get_the_ID() );

?>

<table class="form-table">
    <tr>
        <th>
            UF
        </th>
        <td>
            <input type="text" value=" <?= $simulation->get('uf') ?> " readonly class="large-text">
        </td>
    </tr>
    <tr>
        <th>
            Perfil
        </th>
        <td>
            <input type="text" value=" <?= $simulation->get('perfil') ?> " readonly class="large-text">
        </td>
    </tr>
    <tr>
        <th>
            Condição
        </th>
        <td>
            <input type="text" value=" <?= $simulation->get('condicao') ?> " readonly class="large-text">
        </td>
    </tr>
    <tr>
        <th>
            Idade
        </th>
        <td>
            <input type="text" value=" <?= $simulation->get('idade') ?> " readonly class="large-text">
        </td>
    </tr>
    <tr>
        <th>
            Valor
        </th>
        <td>
            <input type="text" value=" <?= $simulation->get('valor') ? 'R$ ' . number_format_i18n($simulation->get('valor'), 2) : '' ?> " readonly class="large-text">
        </td>
    </tr>
    <tr>
        <th>
            Valor Financiado
        </th>
        <td>
            <input type="text" value=" <?= $simulation->get('valor_financ') ? 'R$ ' . number_format_i18n($simulation->get('valor_financ'), 2) : '' ?> " readonly class="large-text">
        </td>
    </tr>
    <tr>
        <th>
            Prazo
        </th>
        <td>
            <input type="text" value=" <?= $simulation->get('prazo') ?> " readonly class="large-text">
        </td>
    </tr>
    <tr>
        <th>
            Nome
        </th>
        <td>
            <input type="text" value=" <?= $simulation->get('nome') ?> " readonly class="large-text">
        </td>
    </tr>
    <tr>
        <th>
            Telefone
        </th>
        <td>
            <input type="text" value=" <?= $simulation->get('fone') ?> " readonly class="large-text">
        </td>
    </tr>
    <tr>
        <th>
            E-mail
        </th>
        <td>
            <input type="text" value=" <?= $simulation->get('email') ?> " readonly class="large-text">
        </td>
    </tr>
</table>
