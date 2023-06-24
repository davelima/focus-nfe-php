<?php

declare(strict_types=1);

namespace Davelima\FocusNfePhp\Interface;

interface DocumentInterface
{
    /**
     * @return array<string, array<array<bool|int|string>|bool|int|string>|bool|int|string>
     */
    public function getData(): array;

    /**
     * @param bool|null $useQueryString
     * @return string
     */
    public function getDocumentPath(?bool $useQueryString = true): string;
}
