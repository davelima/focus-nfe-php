<?php

declare(strict_types=1);

namespace Davelima\FocusNfePhp\Document;

use DateTime;
use Davelima\FocusNfePhp\Interface\DocumentInterface;
use Davelima\FocusNfePhp\Model\{Prestador, Servico, Tomador};
use Davelima\FocusNfePhp\Enum\{NaturezaOperacao, RegimeEspecialTributacao, Status};

class Nfse implements DocumentInterface
{
    public function __construct(
        private string $referencia,
        private ?DateTime $dataEmissao = null,
        private ?bool $incentivadorCultural = null,
        private ?NaturezaOperacao $naturezaOperacao = null,
        private ?bool $optanteSimplesNacional = null,
        private ?Prestador $prestador = null,
        private ?Tomador $tomador = null,
        private ?Servico $servico = null,
        private ?RegimeEspecialTributacao $regimeEspecialTributacao = null,
        private ?string $codigoObra = null,
        private ?string $art = null,
        private ?string $serieRpsSubstituido = null,
        private ?string $tipoRpsSubstituido = null,
        private Status $status = Status::Pendente
    ) {
    }

    /**
     * @return array|bool[]|bool[][]|bool[][][]|int[]|int[][]|int[][][]|string[]|string[][]|string[][][]
     */
    public function getData(): array
    {
        $result = [
            'data_emissao' => $this->dataEmissao?->format('c'),
            'incentivador_cultural' => $this->incentivadorCultural,
            'natureza_operacao' => $this->naturezaOperacao?->value,
            'optante_simples_nacional' => $this->optanteSimplesNacional,
            'regime_especial_tributacao' => $this->regimeEspecialTributacao?->value,
            'codigo_obra' => $this->codigoObra,
            'art' => $this->art,
            'serie_rps_substituido' => $this->serieRpsSubstituido,
            'tipo_rps_substituido' => $this->tipoRpsSubstituido,
            'prestador' => $this->prestador?->getData(),
            'tomador' => $this->tomador?->getData(),
            'servico' => $this->servico?->getData()
        ];

        return array_filter($result, function($value) {return !is_null($value);});
    }

    /**
     * @param bool $useQueryString
     * @return string
     */
    public function getDocumentPath(?bool $useQueryString = true): string
    {
        $reference = match ($useQueryString) {
            true => sprintf('?ref=%s', $this->referencia),
            default => sprintf('/%s', $this->referencia),
        };

        return '/v2/nfse' . $reference;
    }

    /**
     * @return Status
     *
     * @codeCoverageIgnore
     */
    public function getStatus(): Status
    {
        return $this->status;
    }
}
