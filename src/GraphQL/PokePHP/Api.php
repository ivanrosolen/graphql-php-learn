<?php
namespace Xuplau\GraphQL\PokePHP;

use Xuplau\GraphQL\Entity\Pokemon;
use PokePHP\PokeApi;

class Api
{

    private $evolutions = [];


    public function findByNumber(int $number): Pokemon
    {

        $api = new PokeApi;
        $result = $api->pokemon($number);

        $result = json_decode($result);

        $pokemon = new Pokemon;
        $pokemon->number = $result->id;
        $pokemon->name = $result->name;
        $pokemon->type = $result->types[0]->type->name;

        return $pokemon;
    }

    public function findEvolutionsByNumber(int $number): array
    {

        $api = new PokeApi;
        $result = $api->pokemonSpecies($number);

        $result = json_decode($result);
        $data = explode('/', $result->evolution_chain->url);
        end($data);

        $chain = prev($data);

        $result = $api->evolutionChain($chain);

        $result = json_decode($result);

        $evos = $result->chain->evolves_to;

        if (empty($evos)) return [];

        $this->evolutions[] = $result->chain->species->name;

        $this->getEvolutions($evos[0]);

        $names = $this->evolutions;

        $pokemon = new Pokemon;
        $return = [];

        foreach ($names as $name) {
            $result = $api->pokemon($name);

            $result = json_decode($result);

            $pokemon->number = $result->id;
            $pokemon->name = $result->name;
            $pokemon->type = $result->types[0]->type->name;

            $return[] = clone $pokemon;
        }

        return $return;

    }

    private function getEvolutions($obj):void
    {

        $this->evolutions[] = $obj->species->name;

        if ( !empty($obj->evolves_to) ) {
            $this->getEvolutions($obj->evolves_to[0]);
        }

    }
}