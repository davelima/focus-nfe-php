<?php

declare(strict_types=1);

namespace Document;

use DateTime;
use PHPUnit\Framework\TestCase;
use Davelima\FocusNfePhp\Document\Nfse;
use Davelima\FocusNfePhp\Enum\NaturezaOperacao;
use Davelima\FocusNfePhp\Model\{Endereco, Prestador, Servico, Tomador};

final class NfseTest extends TestCase
{
    public function testCanGetNfseData(): void
    {
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
            valorServicos:    1.50,
            issRetido:        true,
            itemListaServico: '116',
            discriminacao:    'Serviço teste',
            codigoMunicipio:  '8765432'
        );

        $nfse = new Nfse(
            referencia:             'REF_TEST',
            dataEmissao:            $date,
            incentivadorCultural:   false,
            naturezaOperacao:       NaturezaOperacao::TributacaoNoMunicipio,
            optanteSimplesNacional: true,
            prestador:              $prestador,
            tomador:                $tomador,
            servico:                $servico
        );

        $expected = [
            'data_emissao' => '2022-10-10T14:45:00+03:00',
            'incentivador_cultural' => false,
            'natureza_operacao' => 1,
            'optante_simples_nacional' => true,
            'prestador' => [
                'cnpj' => '00000000000000',
                'inscricao_municipal' => '12345',
                'codigo_municipio' => '1234567'
            ],
            'tomador' => [
                'cnpj' => '11111111111111',
                'razao_social' => 'Tomador Teste LTDA',
                'email' => 'tomador@test.com',
                'endereco' => [
                    'bairro' => 'Bairro teste',
                    'cep' => '00000000',
                    'codigo_municipio' => '7654321',
                    'logradouro' => 'Rua do Teste',
                    'numero' => 123,
                    'uf' => 'SP'
                ]
            ],
            'servico' => array(
                'discriminacao' => 'Serviço teste',
                'iss_retido' => true,
                'item_lista_servico' => '116',
                'valor_servicos' => 1.50,
                'codigo_municipio' => '8765432'
            ),
        ];

        $this->assertEquals($expected, $nfse->getData());
    }

    public function testCanGetNfsePartialOptionalData(): void
    {
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
            valorServicos:    1.50,
            issRetido:        true,
            itemListaServico: '116',
            discriminacao:    'Serviço teste',
            codigoMunicipio:  '8765432',
            valorDeducoes:    5.77,
            aliquota:         8.77
        );

        $nfse = new Nfse(
            referencia:             'REF_TEST',
            dataEmissao:            $date,
            incentivadorCultural:   false,
            naturezaOperacao:       NaturezaOperacao::TributacaoNoMunicipio,
            optanteSimplesNacional: true,
            prestador:              $prestador,
            tomador:                $tomador,
            servico:                $servico
        );

        $expected = [
            'data_emissao' => '2022-10-10T14:45:00+03:00',
            'incentivador_cultural' => false,
            'natureza_operacao' => 1,
            'optante_simples_nacional' => true,
            'prestador' => [
                'cnpj' => '00000000000000',
                'inscricao_municipal' => '12345',
                'codigo_municipio' => '1234567'
            ],
            'tomador' => [
                'cnpj' => '11111111111111',
                'razao_social' => 'Tomador Teste LTDA',
                'email' => 'tomador@test.com',
                'endereco' => [
                    'bairro' => 'Bairro teste',
                    'cep' => '00000000',
                    'codigo_municipio' => '7654321',
                    'logradouro' => 'Rua do Teste',
                    'numero' => 123,
                    'uf' => 'SP'
                ]
            ],
            'servico' => array(
                'discriminacao' => 'Serviço teste',
                'iss_retido' => true,
                'item_lista_servico' => '116',
                'valor_servicos' => 1.50,
                'codigo_municipio' => '8765432',
                'valor_deducoes' => 5.77,
                'aliquota' => 8.77
            ),
        ];

        $this->assertEquals($expected, $nfse->getData());
    }

    public function testCanGetNfseFullOptionalData(): void
    {
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
            valorCofins:               47,
            valorInss:                 99,
            valorCsll:                 56.77,
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
            naturezaOperacao:       NaturezaOperacao::TributacaoNoMunicipio,
            optanteSimplesNacional: true,
            prestador:              $prestador,
            tomador:                $tomador,
            servico:                $servico
        );

        $expected = [
            'data_emissao' => '2022-10-10T14:45:00+03:00',
            'incentivador_cultural' => false,
            'natureza_operacao' => 1,
            'optante_simples_nacional' => true,
            'prestador' => [
                'cnpj' => '00000000000000',
                'inscricao_municipal' => '12345',
                'codigo_municipio' => '1234567'
            ],
            'tomador' => [
                'cnpj' => '11111111111111',
                'razao_social' => 'Tomador Teste LTDA',
                'email' => 'tomador@test.com',
                'endereco' => [
                    'bairro' => 'Bairro teste',
                    'cep' => '00000000',
                    'codigo_municipio' => '7654321',
                    'logradouro' => 'Rua do Teste',
                    'numero' => 123,
                    'uf' => 'SP'
                ]
            ],
            'servico' => array(
                'discriminacao' => 'Serviço teste',
                'iss_retido' => true,
                'item_lista_servico' => '116',
                'valor_servicos' => 1.50,
                'codigo_municipio' => '8765432',
                'valor_deducoes' => 5.77,
                'valor_pis' => 1.44,
                'valor_cofins' => 47.0,
                'valor_inss' => 99.0,
                'valor_csll' => 56.77,
                'valor_iss' => 4.1,
                'valor_iss_retido' => 8.0,
                'outras_retencoes' => 9.0,
                'base_calculo' => 5.0,
                'aliquota' => 8.77,
                'desconto_incondicionado' => 14.0,
                'desconto_condicionado' => 99.4,
                'codigo_cnae' => '12344',
                'codigo_tributario_municipio' => '548754',
                'percentual_total_tributos' => 14.0,
                'fonte_total_tributos' => 'Fonte Total Tributos Teste'
            ),
        ];

        $this->assertEquals($expected, $nfse->getData());
    }

    public function testCanIgnoreZeroedValues(): void
    {
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
            valorCofins:               0, // Should not appear on result
            valorInss:                 99,
            valorCsll:                 0, // Should not appear on result
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
            naturezaOperacao:       NaturezaOperacao::TributacaoNoMunicipio,
            optanteSimplesNacional: true,
            prestador:              $prestador,
            tomador:                $tomador,
            servico:                $servico
        );

        $expected = [
            'data_emissao' => '2022-10-10T14:45:00+03:00',
            'incentivador_cultural' => false,
            'natureza_operacao' => 1,
            'optante_simples_nacional' => true,
            'prestador' => [
                'cnpj' => '00000000000000',
                'inscricao_municipal' => '12345',
                'codigo_municipio' => '1234567'
            ],
            'tomador' => [
                'cnpj' => '11111111111111',
                'razao_social' => 'Tomador Teste LTDA',
                'email' => 'tomador@test.com',
                'endereco' => [
                    'bairro' => 'Bairro teste',
                    'cep' => '00000000',
                    'codigo_municipio' => '7654321',
                    'logradouro' => 'Rua do Teste',
                    'numero' => 123,
                    'uf' => 'SP'
                ]
            ],
            'servico' => array(
                'discriminacao' => 'Serviço teste',
                'iss_retido' => true,
                'item_lista_servico' => '116',
                'valor_servicos' => 1.50,
                'codigo_municipio' => '8765432',
                'valor_deducoes' => 5.77,
                'valor_pis' => 1.44,
                'valor_inss' => 99.0,
                'valor_iss' => 4.1,
                'valor_iss_retido' => 8.0,
                'outras_retencoes' => 9.0,
                'base_calculo' => 5.0,
                'aliquota' => 8.77,
                'desconto_incondicionado' => 14.0,
                'desconto_condicionado' => 99.4,
                'codigo_cnae' => '12344',
                'codigo_tributario_municipio' => '548754',
                'percentual_total_tributos' => 14.0,
                'fonte_total_tributos' => 'Fonte Total Tributos Teste'
            ),
        ];

        $this->assertEquals($expected, $nfse->getData());
    }

    public function testCanGetDocumentPathWithQueryString(): void
    {
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
            valorCofins:               0, // Should not appear on result
            valorInss:                 99,
            valorCsll:                 0, // Should not appear on result
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
            naturezaOperacao:       NaturezaOperacao::TributacaoNoMunicipio,
            optanteSimplesNacional: true,
            prestador:              $prestador,
            tomador:                $tomador,
            servico:                $servico
        );

        $expected = '/v2/nfse?ref=REF_TEST';
        $authorizePath = $nfse->getDocumentPath();

        $this->assertSame($expected, $authorizePath);
    }

    public function testCanGetDocumentPathWithReference(): void
    {
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
            valorCofins:               0, // Should not appear on result
            valorInss:                 99,
            valorCsll:                 0, // Should not appear on result
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
            naturezaOperacao:       NaturezaOperacao::TributacaoNoMunicipio,
            optanteSimplesNacional: true,
            prestador:              $prestador,
            tomador:                $tomador,
            servico:                $servico
        );

        $expected = '/v2/nfse/REF_TEST';
        $authorizePath = $nfse->getDocumentPath(false);

        $this->assertSame($expected, $authorizePath);
    }
}
