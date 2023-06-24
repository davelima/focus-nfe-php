<?php

declare(strict_types=1);

namespace Davelima\FocusNfePhp\Response;

use Davelima\FocusNfePhp\Interface\{DocumentInterface, ResponseInterface};

/**
 * @codeCoverageIgnore
 */
readonly class DocumentResponse implements ResponseInterface
{
    /**
     * @param int $status
     * @param DocumentInterface $document
     * @param array $content
     */
    public function __construct(
        private int $status,
        private DocumentInterface $document,
        private array $content
    ) {
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return DocumentInterface
     */
    public function getDocument(): DocumentInterface
    {
        return $this->document;
    }

    /**
     * @return array
     */
    public function getContent(): array
    {
        return $this->content;
    }
}
