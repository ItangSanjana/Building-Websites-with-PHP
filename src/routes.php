<?php
// Routes

// Home
$app->get('/', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Get route name
    $routeName = $request->getAttribute('route')->getName();

    // Render index view
    return $this->renderer->render($response, 'index.phtml', ['routeName' => $routeName]);
})->setName('home');

// Contact
$app->get('/contact', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/contact' route");

    // Get route name
    $routeName = $request->getAttribute('route')->getName();

    // Render index view
    return $this->renderer->render($response, 'contact.phtml', ['routeName' => $routeName]);
})->setName('contact');

// Contact post
$app->post('/contact', function ($request, $response, $args) {
    // Collect post request
    $data = $request->getParsedBody();
    $name = filter_var($data['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
    $msg = filter_var($data['msg'], FILTER_SANITIZE_STRING);
    if ($name && $email && $msg) {
        // The Swift_Message
        $message = $this->messager->setFrom(array($email => $name))->setTo(array('itang@sanjana'))->setBody($msg);

        // The Swift_Mailer
        $mailer = $this->mailer;

        // Process Swift and redirection
        $sent = $mailer->send($message);
        if ($sent) {
            // Send a message that says thank you.
            $response = $response->withStatus(302)->withHeader('Location', '/');
        } else {
            // Send a message to the user that the message failed to send log
            // that there was an error
            $response = $response->withStatus(302)->withHeader('Location', '/contact');
        }
    } else {
        // Message the user that there was a problem
        $response = $response->withStatus(302)->withHeader('Location', '/contact');
    }
    return $response;
});
