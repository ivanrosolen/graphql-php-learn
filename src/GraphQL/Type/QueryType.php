<?php
namespace Xuplau\GraphQL\Type;

use Xuplau\GraphQL\PokePHP\Api;
use Xuplau\GraphQL\Entity\Pokemon;
use Xuplau\GraphQL\Types;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

class QueryType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Query',
            'fields' => [
                'pokemon' => [
                    'type' => Types::pokemon(),
                    'description' => 'Pokémon Data by Number',
                    'args' => [
                        'number' => Types::nonNull(Types::int())
                    ]
                ]
            ],
            'resolveField' => function($val, $args, $context, ResolveInfo $info) {
                return $this->{$info->fieldName}($val, $args, $context, $info);
            }
        ];
        parent::__construct($config);
    }

    public function pokemon($rootValue, $args): Pokemon
    {
        $api = new Api;
        return $api->findByNumber($args['number']);
    }
}