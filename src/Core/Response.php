<?php
namespace App\Core;

/**
 * Clase final Response
 *
 * Esta clase se encarga de manejar y enviar respuestas HTTP desde la aplicación.
 * Permite enviar datos en diferentes formatos (HTML, JSON) y establecer el código de estado HTTP.
 * Al ser una clase final, no puede ser extendida por otras clases.
 */
final class Response
{
    /**
     * Envía una respuesta al cliente.
     *
     * @param mixed $data Los datos que se enviarán en la respuesta.
     * @param int $status El código de estado HTTP. Por defecto es 200 (OK).
     * @param string $format El formato de la respuesta. Puede ser 'html' o 'json'. Por defecto es 'html'.
     * @return void
     */
    public function send($content, int $status = 200, string $format = 'html'): void
    {
        // Determina el tipo de contenido (Content-Type) según el formato especificado.
        $contentType = match ($format) {
            'json' => 'application/json', // Si el formato es JSON, se usa 'application/json'.
            default => 'text/html'         // Por defecto, se usa 'text/html'.
        };
        
        // Obtiene la codificación de caracteres interna de PHP.
        $charset = mb_internal_encoding();
        
        // Establece el código de estado HTTP.
        http_response_code($status);
        
        // Establece el encabezado Content-Type con el tipo de contenido y la codificación de caracteres.
        header("Content-Type: $contentType; charset=$charset");
        
        // Envía los datos y termina la ejecución del script.
        exit($content);
    }
    
    /**
     * Envía una respuesta en formato JSON.
     *
     * @param array|object $data Los datos que se enviarán en formato JSON.
     * @param int $status El código de estado HTTP. Por defecto es 200 (OK).
     * @return void
     */
    public function json(array|object $data, int $status = 200): void
    {
        // Llama al método send, especificando el formato 'json'.
        $this->send($data, $status, __FUNCTION__);
    }
    
    
    /**
     * Prepara los datos para ser enviados en formato JSON.
     *
     * @param mixed $data Los datos que se codificarán en JSON.
     * @return string Los datos codificados en JSON o los datos originales si falla la codificación.
     */
    protected function prepare(mixed $data): string
    {
        // Intenta codificar los datos en formato JSON.
        $encoded = json_encode($data);
        
        // Verifica si hubo un error durante la codificación JSON.
        // Si no hay error, devuelve los datos codificados; de lo contrario, devuelve los datos originales.
        return json_last_error() ? $data : $encoded;
    }
}