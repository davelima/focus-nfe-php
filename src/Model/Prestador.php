<?php

declare(strict_types=1);

namespace Davelima\FocusNfePhp\Model;

readonly class Prestador
{
    public function __construct(
        private string $cnpj,
        private string $inscricaoMunicipal,
        private string $codigoMunicipio
    ) {
    }

    /**
     * @return array<string, string>
     */
    public function getData(): array
    {
        return [
            'cnpj' => $this->cnpj,
            'inscricao_municipal' => $this->inscricaoMunicipal,
            'codigo_municipio' => $this->codigoMunicipio
        ];
    }
}
