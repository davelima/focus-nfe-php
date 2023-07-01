<?php

require_once(__DIR__ . '/../../vendor/autoload.php');

use Davelima\FocusNfePhp\Client\FocusClient;
use Davelima\FocusNfePhp\Document\Nfse;
use Davelima\FocusNfePhp\Enum\NaturezaOperacao;
use Davelima\FocusNfePhp\Model\Endereco;
use Davelima\FocusNfePhp\Model\Prestador;
use Davelima\FocusNfePhp\Model\Servico;
use Davelima\FocusNfePhp\Model\Tomador;


$client = new FocusClient(
    environment: FocusClient::ENV_HOMOLOG,
    token:       'TOKEN_FOCUS_NFE'
);

$date = new DateTime('2022-10-10 14:45:00+0300');
$prestador = new Prestador(
    cnpj:               '00000000000000',
    inscricaoMunicipal: '12345',
    codigoMunicipio:    '1234567'
);

$tomadorEndereco = new Endereco(
    bairro:          'Bairro teste',
    cep:             '00000000',
    codigoMunicipio: '7654321',
    logradouro:      'Rua do Teste',
    numero:          123,
    uf:              'SP'
);

$tomador = new Tomador(
    cnpj:        '11111111111111',
    razaoSocial: 'Tomador Teste LTDA',
    email:       'tomador@test.com',
    endereco:    $tomadorEndereco
);

$servico = new Servico(
    valorServicos:             1.50,
    issRetido:                 true,
    itemListaServico:          '116',
    discriminacao:             'Serviço teste',
    codigoMunicipio:           '8765432',
    valorDeducoes:             5.77,
    valorPis:                  1.44,
    valorCofins:               0,
    valorInss:                 99,
    valorCsll:                 0,
    valorIss:                  4.1,
    valorIssRetido:            8,
    outrasRetencoes:           9,
    baseCalculo:               5,
    aliquota:                  8.77,
    descontoIncondicionado:    14,
    descontoCondicionado:      99.4,
    codigoCnae:                '12344',
    codigoTributarioMunicipio: '548754',
    percentualTotalTributos:   14,
    fonteTotalTributos:        'Fonte Total Tributos Teste'
);

$nfse = new Nfse(
    referencia:             'REF_TEST',
    dataEmissao:            $date,
    incentivadorCultural:   false,
    naturezaOperacao:       NaturezaOperacao::TRIBUTACAO_NO_MUNICIPIO,
    optanteSimplesNacional: true,
    prestador:              $prestador,
    tomador:                $tomador,
    servico:                $servico
);


try {
    $response = $client->cancel($nfse);
} catch (\Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface $e) {
    print_r($e->getResponse()->getContent(false));
}
