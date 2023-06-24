# Focus NFE PHP Client

## PT-BR

#### :warning: Esse projeto é um trabalho em andamento :warning:

Client para a API da [FocusNFE](https://focusnfe.com.br). Este client é feito para abstrair algumas
das principais funcionalidades da API dentro do ecossistema PHP.

Apesar de utilizar alguns pacotes do Symfony, este projeto pode ser usado em qualquer aplicação PHP, independente de
qualquer framework.

### Funcionalidades suportadas:

#### NFSe

- [x] Geração/autorização
- [x] Cancelamento
- [x] Consulta
- [x] Envio por email (através da API)

### TO DO:

- [ ] NFe
- [ ] NFCe

Exemplos das funcionalidades suportadas podem ser encontrados em `examples/`

### Dependências

- PHP >= 8.2

### Testes e controle de qualidade

Além de testes unitários, este projeto utiliza o [PHPStan](https://github.com/phpstan/phpstan) e
o [PHPMetrics](https://github.com/phpmetrics/PhpMetrics/) para
controle de qualidade.

Para executar os testes: `composer test`

Para executar os testes e gerar um report de coverage: `composer test-with-coverage` (resultados serão exportados em
HTML dentro de `tests/coverage/`)

Para executar o phpstan: `composer phpstan`

Para executar o phpmetrics: `composer phpmetrics` (resultados serão exportados em HTML dentro de `phpmetrics/`)

É possível também visualizar o status atual de coverage e phpmetrics dentro deste repositório.

## EN
#### :warning: This project is a work in progress :warning:

This is a client for [FocusNFE](https://focusnfe.com.br)'s API. This client is made to abstract
some of the API features inside PHP's ecosystem.

This project uses some Symfony packages, but it can be used in any PHP application in a framework-agnostic way.

### Supported features:

#### NFSe

- [x] Authorization
- [x] Cancel
- [x] Retrieving
- [x] Email sending (through the API)

### TO DO:

- [ ] NFe
- [ ] NFCe

You can find examples of the supported features in `examples/`

### Dependencies

- PHP >= 8.2

### Testing and quality control

In addition to unit tests, we use [PHPStan](https://github.com/phpstan/phpstan)
and [PHPMetrics](https://github.com/phpmetrics/PhpMetrics/) to ensure quality control in this project.

To run tests: `composer test`

To run tests and get a coverage report: `composer test-with-coverage` (results will be written in HTML
inside `tests/coverage/`)

To run phpstan: `composer phpstan`

To run phpmetrics: `composer phpmetrics` (results will be written in HTML inside `phpmetrics/`)
