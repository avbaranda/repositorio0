/**
     * @Route("/response1", name="response1")
     */
    public function response1(): Response
    {
      $response = new Response(
        'Contenido de la respuesta',
        Response::HTTP_OK,
        array('content-type' => 'text/html')
      );
    
      return $response;
    }