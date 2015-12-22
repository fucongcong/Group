<?php

namespace core\Group\Handlers;

use core\Group\App\App;
use core\Group\Events\ExceptionEvent;

class ExceptionsHandler
{
    /**
     * App
     *
     * @var App
     */
    protected $app;

    /**
     * Bootstrap the given application.
     *
     * @param  App  $app
     * @return void
     */
    public function bootstrap(App $app)
    {
        $this -> app = $app;

        error_reporting(-1);

        set_error_handler([$this, 'handleError']);

        set_exception_handler([$this, 'handleException']);

        register_shutdown_function([$this, 'handleShutdown']);

        if ($this -> app -> container -> getEnvironment() == 'prod') {
            ini_set('display_errors', 'Off');
        }
    }

    /**
     * Convert a PHP error to an ErrorException.
     *
     * @param  int  $level
     * @param  string  $message
     * @param  string  $file
     * @param  int  $line
     * @param  array  $context
     * @return void
     *
     * @throws \ErrorException
     */
    public function handleError($level, $message, $file = '', $line = 0, $context = [])
    {
        if (error_reporting() & $level) {
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    public function handleException($e)
    {
        $error = [
            'message' => $e -> getMessage(),
            'file'    => $e -> getFile(),
            'line'    => $e -> getLine(),
            'trace'   => $e -> getTraceAsString(),
            'type'    => $e -> getCode(),
        ];

        $this -> record($error);
        if ($this -> app -> container -> runningInConsole()) {
            $this -> renderForConsole($error);
        } else {
            $this -> renderHttpResponse($error);
        }
    }

    protected function renderForConsole($e)
    {
        
    }

    /**
     * Render an exception as an HTTP response and send it.
     *
     * @param  \Exception  $e
     * @return void
     */
    protected function renderHttpResponse($e)
    {
        //dev下面需要render信息
        if ($this -> app -> container -> getEnvironment() == 'prod') {
            $controller = new \Controller($this -> app);
            $e = $controller -> twigInit() -> render(\Config::get('view::error'));
        }else {
            $e = '';
        }

        \EventDispatcher::dispatch('throw.exception', new ExceptionEvent($e));
    }

    /**
     * Handle the PHP shutdown event.
     *
     * @return void
     */
    public function handleShutdown()
    {
        if ($e = error_get_last()) {

            if ($this -> isFatal($e['type'])) {
                $this -> record($e);
                if ($this -> app -> container -> runningInConsole()) {
                    $this -> renderForConsole($e);
                } else {
                    $this -> renderHttpResponse('');
                }
            }
                
        }
    }

    protected function record($e)
    {
        \Log::error('[' . $e['type'] . '] ' . $e['message'] . '[' . $e['file'] . ' : ' . $e['line'] . ']', []);
    }

    /**
     * Determine if the error type is fatal.
     *
     * @param  int  $type
     * @return bool
     */
    protected function isFatal($type)
    {
        return in_array($type, [E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_PARSE]);
    }
}
