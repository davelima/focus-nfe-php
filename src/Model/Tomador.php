<?php

declare(strict_types=1);

namespace Davelima\FocusNfePhp\Model;

readonly class Tomador
{
    public function __construct(
        private string $cnpj,
        private string $razaoSocial,
        private string $email,
        private Endereco $endereco
    ) {
    }

    /**
     * @return array<string, string|array<string|int>>
     */
    public function getData(): array
    {
        return [
            'cnpj' => $this->cnpj,
            'razao_social' => $this->razaoSocial,
            'email' => $this->email,
            'endereco' => $this->endereco->getData()
        ];
    }
}
