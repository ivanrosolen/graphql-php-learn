# GraphQL

## Leitura Inicial

- [Oficial Learn](http://graphql.org/learn/)
- [GraphQL Basics - Fun Fun Function](https://www.youtube.com/watch?v=lAJWHHUz8_8)
- [More GraphQL - Fun Fun Function](https://www.youtube.com/watch?v=lAJWHHUz8_8)
- [Do We Need GraphQL?](http://kellysutton.com/2017/01/02/do-we-need-graphql.html)
- [GraphQL: 3 reasons not to use it](https://blog.hitchhq.com/graphql-3-reasons-not-to-use-it-7715f60cb934)
- [GraphQL and PHP](https://webonyx.github.io/graphql-php/getting-started/)

## Dúvidas

- Overengineering?
- É bom para...?
- Como documentar os filtros/atributos...?
- Como explicar pra quem vai consumir?
- Exportar para o Elastic Search não é mais simples?
- Qual impacto real no consumo dessas infos versus mais code?
- HTTP caching e CDNs?
- Versioning?

## Anotações

- API aggregation
- Schema que precisa ser definido
  - toda a lógica aqui
  - basicamente é o response da(s) API(s) "filtrado"
  - cuidado para não ficar "pesado"
    - Lazy Fetch
- Não substitui uma API, mas encapsula para expor dados
- Arguments para idiomas, unidades e conversões para um mesmo atributo
- Aliases podem ser interessantes porém adiciona um complexidade de manutenção, acho.
- Deprecated fields

## Extensão para testar no Browser

- [ChromeiQL](https://chrome.google.com/webstore/detail/chromeiql/fkkiamalmpiidkljmicmjfbieiclmeij/related)
- [Chrome Extension for Opera](https://addons.opera.com/en/extensions/details/download-chrome-extension-9/?display=en)

## Referências

- [PokePHP](https://github.com/danrovito/pokephp)
- [graphql-php](https://github.com/webonyx/graphql-php)

## POC
- Buscar Pokemon por número
  - 1 request
  - https://pokeapi.co/api/v2/pokemon/6/
- Buscar cadeia de evolução do pokemon
  - 3 requests
  - https://pokeapi.co/api/v2/pokemon/6/
  - https://pokeapi.co/api/v2/pokemon-species/6/
  - https://pokeapi.co/api/v2/evolution-chain/2/

## Run Project
- Clonar [Repo](https://github.com/ivanrosolen/graphql-learn)
- Rodar composer install --no-dev
- Rodar o server local PHP ``` php -S localhost:4242 public/index.php ```

- Abrir o **ChromeiQL** e definir o endpoint **localhost:4242**

## Testar

- Exemplos de Query:

```
{
  pokemon(number: 6)
}
```

```
{
  pokemon(number: 6) {
    name
  }
}
```

```
{
  pokemon(number: 6) {
    number
    name
    type
    evolutions
  }
}
```

```
{
  pokemon(number: 6) {
    number
    name
    type
    evolutions {
      name
    }
  }
}
```
