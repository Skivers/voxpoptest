<?php

class TranslationProcessor {

    private $jsonfile;
    protected $timeCodes;
    protected $tranlation;
    protected $wordTimeCodes;
    private $dataFromFile;
    
    
    public function __construct(string $jsonFile){
        $this->jsonfile = $jsonFile;
    }

    public function translateTextWithTimeCodes()
    {
        $this->dataFromFile = $this->getDecodedJsonFileContents();

        
        $this->setTimeCodes();
        $this->setWordTimeCode();
        $this->setTranslation();
        $this->mapTimecodesAndTranslation();
      
        return $this;
    }


    private function mapTimecodesAndTranslation()
    {
        $translationArray = $this->getTranslationArray();

        foreach($this->timeCodes as $key =>  &$timeCodes)
        {
            $timeCodes['tranlation'] = $translationArray[$key];
        }
        
    }

    public function toJson()
    {
        return json_encode($this->timeCodes);
    }

    private function getTranslationArray(): array
    {
        $results =  array_filter(explode('.',$this->translation));
        foreach($results as &$sentence){
            $sentence .= ".";            
        }
        return $results;
    }


    private function getDecodedJsonFileContents()
    {
        return  json_decode(
            file_get_contents($this->jsonfile),
            true
        );

    }

    private function setTimeCodes(){
        $this->timeCodes = $this->dataFromFile['time_codes'] ?? [] ;
       
    }

    private function setTranslation(){
        $this->translation = $this->dataFromFile['translation'] ?? [] ;
        
    }


    private function setWordTimeCode(){
        $this->wordTimeCodes = $this->dataFromFile['word_time_codes'] ?? [] ;
    }

}