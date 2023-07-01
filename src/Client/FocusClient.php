<?php

declare(strict_types=1);

namespace Davelima\FocusNfePhp\Client;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Validator\Validation;
use Davelima\FocusNfePhp\Response\DocumentResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Davelima\FocusNfePhp\Exception\InvalidDocumentException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Davelima\FocusNfePhp\Interface\{DocumentInterface, ResponseInterface};
use Symfony\Contracts\HttpClient\Exception\{
    ServerExceptionInterface,
    ClientExceptionInterface,
    RedirectionExceptionInterface,
    TransportExceptionInterface
};

/**
 * @codeCoverageIgnore
 */
class FocusClient
{
    public const ENV_HOMOLOG = 'https://homologacao.focusnfe.com.br';

    public const ENV_PRODUCTION = 'https://api.focusnfe.com.br';

    /**
     * @var HttpClientInterface
     */
    private readonly HttpClientInterface $httpClient;

    /**
     * @var ValidatorInterface
     */
    private readonly ValidatorInterface $validator;

    /**
     * @param string $environment
     * @param string $token
     */
    public function __construct(
        string $environment,
        string $token
    ) {
        $this->httpClient = HttpClient::createForBaseUri($environment)
                                      ->withOptions(['auth_basic' => [$token, '']]);

        $this->validator = Validation::createValidatorBuilder()
                                     ->addYamlMapping(__DIR__ . '/../../config/validator/validation.yaml')
                                     ->getValidator();
    }

    /**
     * @param DocumentInterface $document
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws InvalidDocumentException
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function authorize(DocumentInterface $document): ResponseInterface
    {
        $violations = $this->validator->validate($document);

        if ($violations->count()) {
            $result = [];
            foreach ($violations as $violation) {
                $result[] = sprintf('%s: %s', $violation->getPropertyPath(), $violation->getMessage());
            }

            throw new InvalidDocumentException((string)json_encode($result));
        }

        $request = $this->httpClient->request('POST', $document->getDocumentPath(), [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode($document->getData())
        ]);

        $content = (array)json_decode($request->getContent(), true);
        $code = $request->getStatusCode();

        return new DocumentResponse(
            status:   $code,
            document: $document,
            content:  $content
        );
    }

    /**
     * @param DocumentInterface $document
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function cancel(DocumentInterface $document): ResponseInterface
    {
        $request = $this->httpClient->request('DELETE', $document->getDocumentPath(useQueryString: false), [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode($document->getData())
        ]);

        $content = (array)json_decode($request->getContent(), true);
        $code = $request->getStatusCode();

        return new DocumentResponse(
            status:   $code,
            document: $document,
            content:  $content
        );
    }

    /**
     * @param DocumentInterface $document
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     *
     * @TODO Create DocumentInterface.hydrate method to fill data from response
     */
    public function get(DocumentInterface $document): ResponseInterface
    {
        $request = $this->httpClient->request('GET', $document->getDocumentPath(useQueryString: false));

        $content = (array)json_decode($request->getContent(), true);
        $code = $request->getStatusCode();

        return new DocumentResponse(
            status:   $code,
            document: $document,
            content:  $content
        );
    }

    /**
     * @param DocumentInterface $document
     * @param array<string> $emails
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function send(DocumentInterface $document, array $emails): ResponseInterface
    {
        $payload = [
            'emails' => $emails
        ];
        $endpoint = sprintf('%s/email', $document->getDocumentPath(useQueryString: false));
        $request = $this->httpClient->request('POST', $endpoint, [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode($payload)
        ]);

        $content = (array)json_decode($request->getContent(), true);
        $code = $request->getStatusCode();

        return new DocumentResponse(
            status:   $code,
            document: $document,
            content:  $content
        );
    }
}
