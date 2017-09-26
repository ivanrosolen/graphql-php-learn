<?php
namespace Xuplau\GraphQL\Type;

use Xuplau\GraphQL\PokePHP\Api;
use Xuplau\GraphQL\Entity\Pokemon;
use Xuplau\GraphQL\Types;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

class PokemonType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Pokemon',
            'description' => 'Pokemon Info',
            'fields' => function() {
                return [
                    'number' => [
                        'type' => Types::int(),
                        'description' => 'Pokémon Number'
                    ],
                    'name' => [
                        'type' => Types::string(),
                        'description' => 'Pokémon Name'
                    ],
                    'type' => [
                        'type' => Types::string(),
                        'description' => 'Pokémon Type'
                    ],
                    'evolutions' => [
                        'type' => Types::listOf(Types::evolution()),
                        'description' => 'List of Pokémon Evolution'
                    ]
                ];
            },
            'resolveField' => function($value, $args, $context, ResolveInfo $info) {
                $method = 'resolve' . ucfirst($info->fieldName);
                if (method_exists($this, $method)) {
                    return $this->{$method}($value, $args, $context, $info);
                } else {
                    return $value->{$info->fieldName};
                }
            }
        ];
        parent::__construct($config);
    }

    public function resolveEvolutions(Pokemon $pokemon, $args): array
    {
        $api = new Api;
        return $api->findEvolutionsByNumber($pokemon->number);
    }
}