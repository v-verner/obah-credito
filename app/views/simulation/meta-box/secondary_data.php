<?php defined('ABSPATH') || exit('No direct script access allowed');
$hasSecondBuyer = get_post_meta(get_the_ID(), 'has-second_buyer');?>
<table class="form-table">
    <tr>
        <th>
            CPF
        </th>
        <td>
            <input type="text" name="cpf" value="<?= get_post_meta(get_the_ID(), 'cpf')[0] ?>" readonly class="large-text" id="cpf">
        </td>
    </tr>
    <tr>
        <th>
            Tipo de amortização
        </th>
        <td>
            <input type="text" name="amortization_type" value="<?= get_post_meta(get_the_ID(), 'amortization_type')[0] ?>" readonly class="large-text" id="amortization_type">
        </td>
    </tr>
    <tr>
        <th>
            Renda
        </th>
        <td>
            <input type="text" name="gross_income" value="R$ <?= number_format(get_post_meta(get_the_ID(), 'gross_income')[0], 2, ',', '.') ?>" readonly class="large-text" id="gross_income">
        </td>
    </tr>
    <tr>
        <th>
            Taxas ITBI?
        </th>
        <td>
            <input type="text" name="include_itbi_fee" value="<?= get_post_meta(get_the_ID(), 'include_itbi_fee')[0] ?>" readonly class="large-text" id="include_itbi_fee">
        </td>
    </tr>
    <tr>
        <th>
            Possui segundo comprador?
        </th>
        <td>
            <input type="text" name="has-second_buyer" value="<?= get_post_meta(get_the_ID(), 'has-second_buyer')[0] ?>" readonly class="large-text" id="has-second_buyer">
        </td>
    </tr>
</table>

<?php if ($hasSecondBuyer[0] === 'Sim') : ?>
    <h3>Dados do segundo comprador</h3>
    <div class="second-buyer-container">
        <table class="form-table">
            <tr>
                <th>
                    Nome
                </th>
                <td>
                    <input type="text" name="second_buyer-name" value="<?= get_post_meta(get_the_ID(), 'second_buyer-name')[0] ?>" readonly class="large-text" id="second_buyer-name">
                </td>
            </tr>
            <tr>
                <th>
                    Idade
                </th>
                <td>
                    <input type="text" name="second_buyer-age" value="<?= get_post_meta(get_the_ID(), 'second_buyer-age')[0] ?>" readonly class="large-text" id="second_buyer-age">
                </td>
            </tr>
            <tr>
                <th>
                    CPF
                </th>
                <td>
                    <input type="text" name="second_buyer-cpf" value="<?= get_post_meta(get_the_ID(), 'second_buyer-cpf')[0] ?>" readonly class="large-text" id="second_buyer-cpf">
                </td>
            </tr>
            <tr>
                <th>
                    Telefone
                </th>
                <td>
                    <input type="text" name="second_buyer-phone" value="<?= get_post_meta(get_the_ID(), 'second_buyer-phone')[0] ?>" readonly class="large-text" id="second_buyer-phone">
                </td>
            </tr>
            <tr>
                <th>
                    E-mail
                </th>
                <td>
                    <input type="text" name="second_buyer-email" value="<?= get_post_meta(get_the_ID(), 'second_buyer-email')[0] ?>" readonly class="large-text" id="second_buyer-email">
                </td>
            </tr>
        </table>
    </div>
<?php endif; ?>