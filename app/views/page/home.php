<?php
$features = [
    'Simulação on-line em todos os bancos.',
    'Atendimento desde o crédito até o registro.',
    'Foco no financiamento imobiliário, facilidades para compradores, vendedores e instituição financeira.',
    'Avaliamos seu crédito em até 24h',
    'Consultores especializados',
    'Consultores especializados',
    'Processo 100% gratuito'
];
?>
<section class="section dark home hero">
    <div class="col large-12">        
        <div class="row row-large">
            <div class="col large-8">

                <div class="row">
                    <div class="col large-12">
                        <h1>Obah Crédito Correspondente Bancário</h1>
                    </div>
                    <div class="col large-2 medium-2 small-3">
                        <img class="banks-img mb-half" src="<?= VVerner\Assets::getInstance()->getImageFileUrl('logo-itau.png') ?>" alt="Itaú">
                    </div>
                    <div class="col large-2 medium-2 small-3">
                        <img class="banks-img mb-half" src="<?= VVerner\Assets::getInstance()->getImageFileUrl('logo-santander.png') ?>" alt="Santander">
                    </div>
                    <div class="col large-2 medium-2 small-3">
                        <img class="banks-img mb-half" src="<?= VVerner\Assets::getInstance()->getImageFileUrl('logo-caixa-economica-federal.png') ?>" alt="Caixa">
                    </div>
                    <div class="col large-2 medium-2 small-3">
                        <img class="banks-img mb-half" src="<?= VVerner\Assets::getInstance()->getImageFileUrl('logo-bradesco.png') ?>" alt="Bradesco">
                    </div>
                </div>

                <?php foreach ($features as $k => $v) : ?>
                    <?php if ($k % 2 === 0): ?>
                        <div class="row row-large">
                    <?php endif; ?>

                        <div class="col small-12 medium-6">
                            <div class="col-inner">
                                <div class="icon-box icon-box-left text-left">
                                    <div class="icon-box-img">
                                        <div class="icon">
                                            <div class="icon-inner">
                                                <i class="icon-checkmark"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="icon-box-text last-reset">
                                        <h3 class="thin-font">
                                            <?= $v ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php if ($k % 2 !== 0): ?>
                        </div> <!-- row row-large -->
                    <?php endif; ?>

                <?php endforeach; ?>

                <?php if ($k % 2 === 0): ?>
                    </div> <!-- row row-large -->
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>
