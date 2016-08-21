<?php
class EmailAdapter
{
    /**
     * All transactions happen through API
     */
    private $api;
    /**
     * Email headers and message components
     */
    private $from;
    private $subject;
    private $body;
    private $recepients = [];
    
    
    /**
     * $apiObject is an instance representing the 3rd party
     * API being used to manage all trasmissions.
     */
    public function __construct($apiObject)
    {
        $this->api = $apiObject;
    }
    
    
    /**
     * From: header
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }
    
    public function getFrom()
    {
        return $this->from;
    }
    
    
    /**
     * Subject line
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }
    
    public function getSubject()
    {
        return $this->subject;
    }
    
    
    /**
     * HTML Body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }
    
    public function getBody()
    {
        return $this->body;
    }
    
    
    /**
     * Recepients
     * $recepients is a simple array of email addresses
     */
    public function addRecepients(array $recepients)
    {
        foreach ($recepients as $recepient) {
            $this->addRecepient($recepient);
        }
    }
    
    /**
     * Set a single recepient at a time
     * $recepient is a string of an email address
     */
    public function addRecepient($recepient)
    {
        $this->recepients[] = [
            'address' => [
                'email' => $recepient
            ]
        ];
    }
    
    
    /**
     * Send email
     * Return a status of the transmission.
     */
    public function send()
    {
        $status = $this->api->send([
            'from' => $this->from,
            'html' => $this->body,
            'subject' => $this->subject,
            'recepients' => $this->recepients
        ]);
        
        return $status;
    }
}
