<?php
namespace App\Core;

/**
 * Clase Request
 *
 * Esta clase encapsula la información de una solicitud HTTP, incluyendo el método, la URL,
 * los encabezados, los parámetros de la consulta (query), los parámetros del cuerpo (body),
 * la ruta (path) y la cadena de consulta (query).
 */
final class Request
{

    /**
     * Método HTTP de la solicitud (GET, POST, PUT, PATCH, DELETE, etc.).
     *
     * @var string
     */
    public string $method;

    /**
     * URL completa de la solicitud.
     *
     * @var string
     */
    public string $url;

    /**
     * Encabezados de la solicitud.
     *
     * @var array
     */
    public array $headers = [];

    /**
     * Parámetros de la consulta (query parameters) obtenidos de $_GET.
     *
     * @var array
     */
    public array $params = [];

    /**
     * Parámetros del cuerpo (body parameters) obtenidos del cuerpo de la solicitud.
     *
     * @var array
     */
    public array $bodyParams = [];

    /**
     * Ruta de la solicitud sin la cadena de consulta (query string).
     *
     * @var string
     */
    public string $path;

    /**
     * Cadena de consulta (query string) de la solicitud.
     *
     * @var string
     */
    public string $query;

    /**
     * Constructor de la clase Request.
     *
     * Inicializa las propiedades de la solicitud, incluyendo el método, la URL, los encabezados,
     * los parámetros de la consulta, los parámetros del cuerpo, la ruta y la cadena de consulta.
     */
    public function __construct()
    {
        // Establecer el método HTTP de la solicitud.
        $this->method = $_SERVER['REQUEST_METHOD'];

        // Establecer la URL completa de la solicitud.
        $this->url = $_SERVER['REQUEST_URI'];

        // Extraer la ruta (path) y la cadena de consulta (query) de la URL.
        $parsedUrl = parse_url($this->url);
        $this->path = trim($parsedUrl['path'] ?? '/'); // Si no hay ruta, usar '/'
        $this->query = $parsedUrl['query'] ?? ''; // Si no hay cadena de consulta, usar ''

        // Agregar encabezados desde $_SERVER.
        array_walk(
            $_SERVER, function ($value, $key) {
                if (strpos($key, 'HTTP_') === 0) {
                    // Normalizar el nombre del encabezado (ejemplo: HTTP_CONTENT_TYPE => content-type)
                    $name = str_replace('_', '-', substr(strtolower($key), 5));
                    $this->headers[$name] = $value;
                }
            }
        );

        // Obtener los parámetros de la consulta (query) desde $_GET.
        $this->params = $_GET;

        // Obtener los parámetros del cuerpo (body) según el método HTTP.
        if ($this->method === 'POST' || $this->method === 'PUT' || $this->method === 'PATCH') {
            // Para métodos que envían datos en el cuerpo (body)
            $this->bodyParams = $this->getBodyParams();
        }
    }

    /**
     * Obtiene los parámetros del cuerpo de la solicitud.
     *
     * Este método procesa el cuerpo de la solicitud según el tipo de contenido (Content-Type).
     * Soporta JSON y formularios enviados con POST o PUT.
     *
     * @return array Los parámetros del cuerpo de la solicitud.
     */
    private function getBodyParams(): array
    {
        // Si el contenido es JSON, decodificarlo.
        if (strpos($this->headers['content-type'] ?? '', 'application/json') !== false) {
            $input = file_get_contents('php://input');
            return json_decode($input, true) ?? [];
        }

        // Para formularios enviados con POST o PUT, usar $_POST.
        return $_POST;
    }

    /**
     * 
     * @param  string $name
     * @param  mixed  $default
     * @return mixed
     */
    public function get(string $name, mixed $default = null): mixed
    {
        return $this->params[$name] ?? $this->bodyParams[$name] ?? $default;
    }
}