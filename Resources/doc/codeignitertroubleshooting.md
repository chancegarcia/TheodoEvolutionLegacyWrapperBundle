#CodeIgniter Troubleshooting

##Redirect Handling

1) Extend the `AbstractCodeIgniterKernelBridge` class
    - you must implement the `getLegacyRedirectExceptionResponse`, `getLegacyAuthorizedExceptionResponse`, `getLegacyBridgeExceptionResponse` methods
    - in your CodeIgniter code, replace redirect code by throwing a  `LegacyRedirectException`
    
    some CI Controller:
        
        public function foo()
        {
            ...
            throw new LegacyRedirectException("http://example.com", LegacyRedirectException::REDIRECT_LOCATION);
            ...
        }

2) Using the `BasicCodeIgniterKernelBridge` class
