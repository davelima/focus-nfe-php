<?php

declare(strict_types=1);

namespace Davelima\FocusNfePhp\Model;

readonly class Servico
{
    /**
     * @param float $valorServicos
     * @param bool $issRetido
     * @param string $itemListaServico
     * @param string $discriminacao
     * @param string $codigoMunicipio
     * @param float|null $valorDeducoes
     * @param float|null $valorPis
     * @param float|null $valorCofins
     * @param float|null $valorInss
     * @param float|null $valorCsll
     * @param float|null $valorIss
     * @param float|null $valorIssRetido
     * @param float|null $outrasRetencoes
     * @param float|null $baseCalculo
     * @param float|null $aliquota
     * @param float|null $descontoIncondicionado
     * @param float|null $descontoCondicionado
     * @param string|null $codigoCnae
     * @param string|null $codigoTributarioMunicipio
     * @param float|null $percentualTotalTributos
     * @param string|null $fonteTotalTributos
     */
    public function __construct(
        private float $valorServicos,
        private bool $issRetido,
        private string $itemListaServico,
        private string $discriminacao,
        private string $codigoMunicipio,
        private ?float $valorDeducoes = 0,
        private ?float $valorPis = 0,
        private ?float $valorCofins = 0,
        private ?float $valorInss = 0,
        private ?float $valorCsll = 0,
        private ?float $valorIss = 0,
        private ?float $valorIssRetido = 0,
        private ?float $outrasRetencoes = 0,
        private ?float $baseCalculo = 0,
        private ?float $aliquota = 0,
        private ?float $descontoIncondicionado = 0,
        private ?float $descontoCondicionado = 0,
        private ?string $codigoCnae = '',
        private ?string $codigoTributarioMunicipio = '',
        private ?float $percentualTotalTributos = 0,
        private ?string $fonteTotalTributos = ''
    ) {
    }

    /**
     * @return array<string, string|float|bool>
     */
    public function getData(): array
    {
        $optionalKeys = [
            'valor_deducoes' => 'valorDeducoes',
            'valor_pis' => 'valorPis',
            'valor_cofins' => 'valorCofins',
            'valor_inss' => 'valorInss',
            'valor_csll' => 'valorCsll',
            'valor_iss' => 'valorIss',
            'valor_iss_retido' => 'valorIssRetido',
            'outras_retencoes' => 'outrasRetencoes',
            'base_calculo' => 'baseCalculo',
            'aliquota' => 'aliquota',
            'desconto_incondicionado' => 'descontoIncondicionado',
            'desconto_condicionado' => 'descontoCondicionado',
            'codigo_cnae' => 'codigoCnae',
            'codigo_tributario_municipio' => 'codigoTributarioMunicipio',
            'percentual_total_tributos' => 'percentualTotalTributos',
            'fonte_total_tributos' => 'fonteTotalTributos'
        ];

        $result = [
            'valor_servicos' => $this->valorServicos,
            'iss_retido' => $this->issRetido,
            'item_lista_servico' => $this->itemListaServico,
            'discriminacao' => $this->discriminacao,
            'codigo_municipio' => $this->codigoMunicipio
        ];

        array_walk($optionalKeys, function ($label, $key) use (&$result)
        {
            $result[$key] = $this->{$label};
        });

        return array_filter($result);
    }
}

