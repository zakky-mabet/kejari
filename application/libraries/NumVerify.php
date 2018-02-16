<?php 
/* 
numverify class - Verify Phone Number 
version 0.1 beta 10/2/2015 

API reference at https://numverify.com/documentation 

Copyright (c) 2015, Wagon Trader 

This program is free software: you can redistribute it and/or modify 
it under the terms of the GNU General Public License as published by 
the Free Software Foundation, either version 3 of the License, or 
(at your option) any later version. 

This program is distributed in the hope that it will be useful, 
but WITHOUT ANY WARRANTY; without even the implied warranty of 
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the 
GNU General Public License for more details. 

You should have received a copy of the GNU General Public License 
along with this program. If not, see <http://www.gnu.org/licenses/>. 
*/ 
class numVerify{ 
    
    //********************************************************* 
    // Settings 
    //********************************************************* 
    
    //Your numverify API key 
    //Available at https://numverify.com/product 
    private $apiKey = 'YOUR_API_KEY_HERE'; 
    
    //API endpoint 
    //only needs to change if the API changes location 
    private $endPoint = 'http://apilayer.net/api/validate'; 
    
    //holds the error code, if any 
    public $errorCode; 
    
    //holds the error text, if any 
    public $errorText; 
    
    //response object 
    public $response; 
    
    //JSON response from API 
    public $responseAPI; 
    
    /* 
    method: isValid 
    usage: isValid(string phoneNumber[string countryCode=''][,bool formatJSON=false][,string callBack='']); 
    params: phoneNumber = the phone number to be validated 
             countryCode = 2-letter country code 
             formatJSON = true to use pretified JSON for debugging 
             callback = JSONP callback function. Not currently implemented in this class 
    
    This method prepares the API request to verify the supplied phone number. 
    If the phone number provided does not contain the country calling code, then you must proved the 2-letter 
    country code. 
    
    returns: true if phone number is valid or false if not 
    */ 
    public function isValid($phoneNumber,$countryCode='',$formatJSON=false,$callBack=''){ 
        
        $request = $this->endPoint.'?access_key='.$this->apiKey.'&number='.$phoneNumber; 
        
        $request .= ( empty($countryCode) ) ? '' : '&country_code='.$countryCode; 
        
        $request .= ( empty($formatJSON) ) ? '' : '&format=1'; 
        
        $this->response = $this->sendRequest($request); 
        
        if( !empty($this->response->error->code) ){ 
            
            $this->errorCode = $this->response->error->code; 
            $this->errorText = $this->response->error->info; 
            
            return false; 
            
        }elseif( empty($this->response->valid) ){ 
            
            return false; 
            
        }else{}{ 
            
            return true; 
            
        } 
        
    } 
    
    /* 
    method: sendRequest 
    usage: sendRequest(string request); 
    params: request = full endpoint for API request 
    
    This method sends the API request and decodes the JSON response. 
    
    returns: object of request results 
    */ 
    public function sendRequest($request){ 
        
        $this->responseAPI = file_get_contents($request); 
        
        $return = json_decode($this->responseAPI); 
        
        return $return; 
        
    } 
    
} 
?> 