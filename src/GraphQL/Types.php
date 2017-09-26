<?php
namespace Xuplau\GraphQL;

use Xuplau\GraphQL\Type\QueryType;
use Xuplau\GraphQL\Type\PokemonType;
use Xuplau\GraphQL\Type\EvolutionType;
use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\NonNull;
use GraphQL\Type\Definition\Type;

class Types
{
    private static $pokemon;
    private static $evolution;
    private static $query;

    public static function pokemon(): PokemonType
    {
        return self::$pokemon ?: (self::$pokemon = new PokemonType);
    }

    public static function evolution(): EvolutionType
    {
        return self::$evolution ?: (self::$evolution = new EvolutionType);
    }

    public static function query(): QueryType
    {
        return self::$query ?: (self::$query = new QueryType);
    }

    public static function boolean()
    {
        return Type::boolean();
    }

    public static function float()
    {
        return Type::float();
    }

    public static function id()
    {
        return Type::id();
    }

    public static function int()
    {
        return Type::int();
    }

    public static function string()
    {
        return Type::string();
    }

    public static function listOf($type)
    {
        return new ListOfType($type);
    }

    public static function nonNull($type)
    {
        return new NonNull($type);
    }
}