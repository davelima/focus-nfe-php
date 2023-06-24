<?php

declare(strict_types=1);

namespace Davelima\FocusNfePhp\Document;

use DateTime;
use Davelima\FocusNfePhp\Enum\NaturezaOperacao;
use Davelima\FocusNfePhp\Interface\DocumentInterface;
use Davelima\FocusNfePhp\Model\{Prestador, Servico, Tomador};

readonly class Nfse implements DocumentInterface
{
    public function __construct(
        private string $referencia,
        private ?DateTime $dataEmissao = null,
        private ?bool $incentivadorCultural = null,
        private ?NaturezaOperacao $naturezaOperacao = null,
        private ?bool $optanteSimplesNacional = null,
        private ?Prestador $prestador = null,
        private ?Tomador $tomador = null,
        private ?Servico $servico = null
    ) {
    }

    /**
     * @return array|bool[]|bool[][]|bool[][][]|int[]|int[][]|int[][][]|string[]|string[][]|string[][][]
     */
    public function getData(): array
    {
        return [
            'data_emissao' => $this->dataEmissao?->format('c'),
            'incentivador_cultural' => $this->incentivadorCultural,
            'natureza_operacao' => $this->naturezaOperacao?->value,
            'optante_simples_nacional' => $this->optanteSimplesNacional,
            'prestador' => $this->prestador?->getData(),
            'tomador' => $this->tomador?->getData(),
            'servico' => $this->servico?->getData()
        ];
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
}
