<?php

require_once realpath(__DIR__.'/../bootstrap.php');

use Xuplau\GraphQL\Types;

use GraphQL\Type\Schema;
use GraphQL\GraphQL;
use GraphQL\Error\FormattedError;
use GraphQL\Error\Debug;

// Better debug for graphql
if (!empty($settings['debug'])) {
    set_error_handler(function($severity, $message, $file, $line) use (&$phpErrors) {
        throw new ErrorException($message, 0, $severity, $file, $line);
    });
    $debug = Debug::INCLUDE_DEBUG_MESSAGE | Debug::INCLUDE_TRACE;
}

try {

    $raw = file_get_contents('php://input') ?: '';
    $data = json_decode($raw, true);

    $data += ['query' => null, 'variables' => null];

    $schema = new Schema([
        'query' => Types::query()
    ]);

    $result = GraphQL::executeQuery(
        $schema,
        $data['query'],
        null,
        null,
        (array) $data['variables']
    );
    $output = $result->toArray($debug);
    $httpStatus = 200;

} catch (\Exception $error) {
    $httpStatus = 500;
    $output['errors'] = [
        FormattedError::createFromException($error, $debug)
    ];
}

header('Content-Type: application/json', true, $httpStatus);
echo json_encode($output);
