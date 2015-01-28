<?php


    
    define("ENV_PRODUCTION", 'production');
    define("ENV_SANDBOX", 'sandbox');
    
    function getBulkDataExchangeServiceEndpoint($environment)
    {
	    if ( $environment == ENV_PRODUCTION ) {
	        $endpoint = 'https://webservices.ebay.com/BulkDataExchangeService';    
	    }
	    elseif ( $environment == ENV_SANDBOX ) {  
	    	$endpoint = 'https://webservices.sandbox.ebay.com/BulkDataExchangeService';              
	    }
	    else {
	    	die("Invalid Environment: $environment");  
	    }
	    
	    return $endpoint;
    }
    
    function getFileTransferServiceEndpoint($environment)
    {
    	if ( $environment == ENV_PRODUCTION ) {
	        $endpoint = 'https://storage.ebay.com/FileTransferService';    
	    }
	    elseif ( $environment == ENV_SANDBOX ) {  
	    	$endpoint = 'https://storage.sandbox.ebay.com/FileTransferService';              
	    }
	    else {
	    	die("Invalid Environment: $environment");    
	    }
	    
	    return $endpoint;
    }
    
    function getSecurityToken($environment)
    {
	    if ( $environment === ENV_PRODUCTION ) {
	        $securityToken = 'AgAAAA**AQAAAA**aAAAAA**aoSCUQ**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wBkoanCpSFpAqdj6x9nY+seQ**Q9MBAA**AAMAAA**dOjZS2JREg5V0r7NYTTJg3LZ+d3MbaA/5uBfLryrLBxqon/EM5mFkg/bj7lR2zLs8R85ebf8LGhQNlanIYQrdBLL32U1n1gw0S+LQBb7/e8Cg8wJE9zt4rotwGcqlvru1jGnaE+br7rc2GILmDRGxAFXSiUdxVN9q93e17NVySj2fs5eUGn8p1bMLkIZNt1ew92RA3Zp8j+oClpMeqdkQ2f8rWT6WA9CJ6hEejYqiLKEIElyNGaok1EJhCmCqNnkH/3Nfsm635KK1w+KKK+zm1stedYD3hY7uE1Ez+E4ResBJ9L7pzlIolbUBMv1dLXHDDZpCvNVQiPscE8BaIWxtTIHyGvUAzwHIaiWm2niruYcOpHqbf334DHppM0cHK0rWvnVUYlwyeKf/vPqRVvGo5IomUYnsJ26W9tb6skgCN9B/YKjRdrLGZrWqQ+PBe3X5oY2aJGO/C5UBRk3oOoZUWMUBLh9ohBK9i6mcbiQ4KsMIt6OyOH5T6QC706X3JkL+F6ULgkxLXCjjw2vK0pzpupHoQueONfP2ug0Z3q8a23wut8HvARAAsh5IZs9KQMSJ1Giz3/RJVqVts6T8K6ApzQdur3KynT6PN88ygnxTny6kjQ332HUwh9wlBDUbo+cUR57s8j5lcUdD43ibVfmwDGWml6N6QVCC/wGmTEtP6rK6Qc0N+xgDHP3/lS5ldEqDwLx+arCQ0s/E/yRwS8XNxHyg09WYOJ94841I7UZP0PA+fQWdmP2hQIsOM/RP4rX';
	    }
	    elseif ( $environment === ENV_SANDBOX ) {  
	        $securityToken = 'AgAAAA**AQAAAA**aAAAAA**vZaCUQ**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wFk4GhCpOBpwSdj6x9nY+seQ**cSoCAA**AAMAAA**WwMXi3ZZceuZcdVqvI1Z/V2p7IJxkW0DfyTP82UX3odJL0A9SiIBBYuxennSDxJsND3Q+QdaoUKXLN58PEEmktZ1axKCLjnYpBWoizPhvBMukEDIoyNO5s4hZh4L3kDKkDZHKp4r+Madz2fXb5tXneZNb49yTF1+55QEl0IRTJmMYK69g00jc3yCNoDTg0LpCBS4HlD7FxH10QLBMgxkwBFYTtIDoqzO8szIHgCFJ9Ntz264IJhqfGETqwMcH9UNi9iG7VsI1KAXzN0cAgpFDMKCLVg05tieddlHG65mw3ZEwFRu7TfZLbygpJG9oVHI26fNu1YB3Wh7NtA115DZ/JxpKnYdp6Rc5v0Az2IwpGpRfUPRgp5nYynnHeYLhpsqjb7BXUkIGWQ7BdK8smydsHTLkqIZJak9oxlINNVR8soCd8kvbWtzjquF6b2i0YggvoW1QyDnd5FiZ5BBRXVgln2FEp9CSlhXUFAvxRt+3TC+dW+hSLMnNwYSSwt91scy8yRA8/sF8eNAB/avDOZfnCpd19Z0rZlKywSGryc9tXbQBsu2bG8hNvjughiH0o5XyWOwiOzuLBNnwSNBBijO00JjclknI7Bs1T2YVmFkMzBjFUoQvhv3aAhNl6KxPdhdy5j9WsKF2+ScJVeSjoIxziFoqazzAZ5bLwJsVT1ioNxbSB153HeX8S359vXDNXHzGFsuWNUa5FLwojcQLtm2ytLabmlusjA9B31GiyIMKK+orb6R6QKPziHeODTLNEu+';                 
	    }
	    else {
	    	die("Invalid Environment: $environment");   
	    }
	    
	    return $securityToken;
    }

?>