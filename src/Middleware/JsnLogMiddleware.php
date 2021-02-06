<?php
declare(strict_types=1);

/**
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace JSNLog\Middleware;


use Cake\Core\Configure;
use Cake\Event\EventManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Cake\Routing\Router;

/**
 * Middleware that enables DebugKit for the layers below.
 */
class JsnLogMiddleware implements MiddlewareInterface
{

    /**
     * Invoke the middleware.
     *
     * DebugKit will augment the response and add the toolbar if possible.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request The request.
     * @param \Psr\Http\Server\RequestHandlerInterface $handler The request handler.
     * @return \Psr\Http\Message\ResponseInterface A response.
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        $response = $handler->handle($request);

        

         $body = $response->getBody();
        if (!$body->isSeekable() || !$body->isWritable()) {
            return $response;
        }
        $body->rewind();
        $contents = $body->getContents();

        $pos = strrpos($contents, '</head>');
        if ($pos === false) {
            return $response;
        }
        $url = Router::url('/', true);
        $cdn = '<script src="https://cdnjs.cloudflare.com/ajax/libs/jsnlog/2.30.0/jsnlog.min.js" integrity="sha512-FEWsl7Gw4o3qf/Xo/wTu1GDKraTeHuWtZQ/mUajP7RI2LhEh7XSJrr/zfnrR4CB+IVSIBZBY+GUdN8uxmRDNqw==" crossorigin="anonymous"></script>';
        $csrf = "<script> var csrf_token = ".json_encode($request->getAttribute('csrfToken'))."; </script>";
        $script = sprintf(
            '<script id="__jsn_log" data-url="%s" src="%s"></script>',
            $url,
            Router::url($this->getScriptUrl())
        );



        $contents = substr($contents, 0, $pos) . $csrf.$cdn . $script . substr($contents, $pos);

        $body->rewind();
        $body->write($contents);


        return $response->withBody($body);
    }

    public function getScriptUrl()
    {
        $url = 'js/jsnlog-config.js';
        // $filePaths = [
        //     str_replace('/', DIRECTORY_SEPARATOR, WWW_ROOT . 'debug_kit/' . $url),
        //     str_replace('/', DIRECTORY_SEPARATOR, CorePlugin::path('DebugKit') . 'webroot/' . $url),
        // ];
        $url = '/JSNLog/' . $url;
        // foreach ($filePaths as $filePath) {
        //     if (file_exists($filePath)) {
        //         return $url . '?' . filemtime($filePath);
        //     }
        // }

        return $url;
    }
}