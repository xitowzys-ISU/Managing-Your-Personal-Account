<?php

class View
{
    /**
     * The template used in the application
     *
     * @var string
     */
    public $template;

    /**
     * Constructor of the View class
     *
     * @param array $route
     */
    public function __construct()
    {
        $this->template = TEMPLATE;
    }

    /**
     * Rendering a template to a page
     *
     * @param string $title
     * @param array $data
     * @return void
     */
    public function render($body, $data = [])
    {
        $path = '';
        $content = '';
        $bodyPath = TEMPLATES_DIR . $this->template  . $body . '.tpl';
        
        $data['{TEMPLATE_SRC}'] = 'templates/' . TEMPLATE;

        if (!file_exists($bodyPath)) {
            throw new Exception('Body not found:' . $bodyPath);
        }

        $pagePath = [
            'header' => TEMPLATES_DIR . $this->template  . 'header' . '.tpl',
            'body' => $bodyPath,
            'footer' => TEMPLATES_DIR . $this->template . 'footer' . '.tpl'
        ];

        foreach ($pagePath as $key => $value) {
            if (file_exists($value)) {

                $path = file_get_contents($value);

                foreach ($data as $find => $replace) {
                    $path = str_replace($find, $replace, $path);
                }

                $path = preg_replace('/{.+[a-zA-Z0-9]}/', '', $path);

                $content .= $path;
            } else {
                throw new Exception('Template not found:' . $value);
                break;
            }
        }

        echo $content;
    }

    /**
     * Throw out the error and display it on the page
     *
     * @param integer $code
     * @return void
     */
    public function errorCode($code)
    {
        http_response_code($code);

        $data = [
            '{TITLE}' => 'Ошибка ' . $code
        ];

        $this->render($data, 'errors/' . $code);
    }
}
