<?php
namespace Xuplau\GraphQL\Type;

use Xuplau\GraphQL\PokePHP\Api;
use Xuplau\GraphQL\Types;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

class EvolutionType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Evolution',
            'description' => 'Pokemon Evolution Info',
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
                    ]
                ];
            },
            'resolveField' => function($value, $args, $context, ResolveInfo $info) {
                return $value->{$info->fieldName};
            }
        ];
        parent::__construct($config);
    }
}