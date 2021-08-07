<?php
 

class tiempo
{

    private $time_start;
    private $time_end;


    public function microtime_float()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }

    function start()
    {
        $this->time_start = $this->microtime_float();
    }

    public function end($numeroDecimales=6)
    {
        $this->time_end = $this->microtime_float();
        return number_format(($time = $this->time_end - $this->time_start),$numeroDecimales);
    }

}



 /*
class tiempo
{
    private $_timeparts;
    private $_starttime;
 
    public function start() {
            $this->_timeparts = explode(" ",microtime());
            $this->_starttime = $this->_timeparts[1].substr($this->_timeparts[0],1);
            $this->_timeparts = explode(" ",microtime());
    }
 
    public function end() {
            $endtime = $this->_timeparts[1].substr($this->_timeparts[0],1);
            return bcsub($endtime,$this->_starttime,6);
    }
 
}*/