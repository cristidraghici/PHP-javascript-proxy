<?php
/*
 http.class.php
*/
class http
{
    public $config  = array();
    public $request = array();
    
    private $errorNo   = 0;
    private $errorStr  = '';
    
    private $socket;
    public $result  = '';
    
    function http($timeout=30, $contenttype='application/xml', $agent='PHP HTTP Client')
    {
        $this->config = array(
            'timeout'       => $timeout,
            'contenttype'   => $contenttype,
            'agent'         => $agent
        );
    }
    
    function init($host, $port=80, $data=null)
    {
        $this->request = array(
            'host'=>$host,
            'port'=>$port,
            'data'=>$data,
            'path'=>'/'
        );
    }
    
    function connect()
    {
        $this->socket = @fsockopen($this->request['host'], $this->request['port'], $this->errorNo, $this->errorStr, $this->config['timeout'] );
        if (!$this->socket)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    
    function path($str)
    {
        $this->request['path'] = $str;
    }
    
    function send_request()
    {
        if ($this->connect())
        {
            $this->result = $this->request();
            return $this->result;
        }
        
        return false;
    }
    
    function request()
    {
        $buffer = '';
        
        @fwrite($this->socket,
            "POST ".$this->request['path']." HTTP/1.0\r\n".
            "Host:".$this->request['host'].":".$this->request['port']."\r\n".
            "User-Agent: ".$this->config['agent_name']."\r\n".
            "Content-Type: ".$this->config['contenttype']."\r\n".
            "Content-Length: ".strlen( $this->request['data'] ).
            "\r\n".
            "\r\n".$this->request['data'].
            "\r\n"
        );
        
        while(!@feof($this->socket))
        {
            $buffer .= @fgets($this->socket, 2048);
        }
        
        $this->close();
        return $buffer;
    }
    
    
    function close()
    {
        @fclose($this->socket);
    }
}
?>