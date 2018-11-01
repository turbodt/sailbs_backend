<?php


/*
 |------------------------------------------------
 | Tokens
 |------------------------------------------------
 |
 |
 |
 */

/**
 * @api {get} /tokens Get Session Token
 * @apiName GetToken
 * @apiGroup Token
 *
 * @apiHeader {String} api-token Your application token.
 *
 * @apiSuccess {Array} errors An array with errors.
 */

$router->get('/tokens',[
    'as' => 'getToken',
    'uses' => 'TokenController@getSessionToken',
]);