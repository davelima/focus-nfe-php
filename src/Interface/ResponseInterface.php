<?php

declare(strict_types=1);

namespace Davelima\FocusNfePhp\Interface;

interface ResponseInterface
{
    /**
     * @return int
     */
    public function getStatus(): int;

    /**
     * @return array<string, array<array<bool|int|string>|bool|int|string>|bool|int|string>
     */
    public function getContent(): array;

    /**
     * @return DocumentInterface
     */
    public function getDocument(): DocumentInterface;
}
