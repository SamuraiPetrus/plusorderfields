# Plus Order Fields

Plus Order Fields é o primeiro plugin desenvolvido por mim, [Petrus Nogueira](https://github.com/SamuraiPetrus), para a plataforma WordPress. Sua função é simplesmente adicionar campos adicionais ao pedido através de uma requisição a sua respectiva referência na API do PagSeguro.

## Requisitos

* [WooCommerce](https://br.wordpress.org/plugins/woocommerce/)
* [PagSeguro for WooCommerce](https://br.wordpress.org/plugins/woocommerce-pagseguro/)

É importante que o site já esteja integrado ao PagSeguro antes de acionar a funcionalidade desse plugin, visto que o mesmo não fornece suporte a essa função. (Por enquanto!! hehe)

## Funcionalidade

Ao instalar o plugin, busque pela opção "Plus Order Fields" no Dashboard da área administrativa do seu site (wp-admin) e forneça os dados necessários para a integração com o PagSeguro, se sua loja virtual estiver em fase de testes, habilite a integração com a API do Sandbox.

Simples assim!

## Fluxo de desenvolvimento

### plusorderfields.php
Arquivo inicial do plugin. Lá são definidas as variáveis globais, e o ordenamento da arquitetura de todas as funcionalidades.

### settings.php
Responsável por construir o painel de configurações da integração, nele o usuário irá fornecer os dados de autenticação para a integração com a API do PagSeguro acontecer. Para mais informações a respeito da sua funcionalidade, consulte a [Settings API do WordPress.](https://developer.wordpress.org/plugins/settings/settings-api/)

### transaction.php
Algoritmo que obtém os dados da API do PagSeguro relacionados a um pedido recém finalizado.

### metadata.php
Algoritmo responsável por cadastrar o resultado da integração de **transactions.php** aos metadados do pedido, através do hook:

```php
add_action( "woocommerce_thankyou", "..." );
```

### notices.php
Responsável por emitir alertas ao administrador do site, por conta de incompatibilidades, notificações, ou demais informações relevantes acerca do plugin.


## Para mais informações

Uma descrição mais aprofundada da lógica utilizada pelo plugin pode ser encontrada nos comentários de cada um dos arquivos citados na seção: [Fluxo de desenvolvimento](https://github.com/SamuraiPetrus/plusorderfields/#fluxo-de-desenvolvimento)

Abaixo, uma espécie de "bibliografia" das referências utilizadas por mim para o desenvolvimento do plugin "Plus Order Fields".
* [Endpoint consumido na API do PagSeguro](https://dev.pagseguro.uol.com.br/reference/checkout-transparente#api-checkout-transparente-consulta-transacoes-por-data-ou-codigo-de-referencia)
* [WordPress Settings API](https://developer.wordpress.org/plugins/settings/settings-api/)
* ["woocommerce_thankyou" Hook](http://hookr.io/actions/woocommerce_thankyou/)
* [Conceito de "Lambdas" e "Closures"](https://culttt.com/2013/03/25/what-are-php-lambdas-and-closures/)
