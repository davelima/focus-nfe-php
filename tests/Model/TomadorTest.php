<?php

declare(strict_types=1);

namespace Model;

use DateTime;
use Davelima\FocusNfePhp\Model\Endereco;
use PHPUnit\Framework\TestCase;
use Davelima\FocusNfePhp\Model\Tomador;

final class TomadorTest extends TestCase
{
    public function testCanGetCnpjData(): void
    {
        $tomadorEndereco = new Endereco(
            logradouro:      'Rua do Teste',
            numero:          123,
            uf:              'SP',
            codigoMunicipio: '7654321',
            bairro:          'Bairro teste',
            cep:             '00000000'
        );

        $tomador = new Tomador(
            razaoSocial: 'Tomador Teste LTDA',
            email:       'tomador@test.com',
            endereco:    $tomadorEndereco,
            cnpj:        '11111111111111'
        );

        $data = $tomador->getData();
        $this->assertArrayhasKey('cnpj', $data);
        $this->assertArrayNotHasKey('cpf', $data);
    }

    public function testCanGetCpfData(): void
    {
        $tomadorEndereco = new Endereco(
            logradouro:      'Rua do Teste',
            numero:          123,
            uf:              'SP',
            codigoMunicipio: '7654321',
            bairro:          'Bairro teste',
            cep:             '00000000'
        );

        $tomador = new Tomador(
            razaoSocial: 'Tomador Pessoa Física',
            email:       'tomador@test.com',
            endereco:    $tomadorEndereco,
            cpf:         '00000000000'
        );

        $data = $tomador->getData();
        $this->assertArrayhasKey('cpf', $data);
        $this->assertArrayNotHasKey('cnpj', $data);
    }
}
