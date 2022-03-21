<?php
 return array ( 
         "CARE" => array (
                        'status'=>true,
                        "agentId"=> "20008325",
                        "AppId"=>"516215",//554940
                        "timestamp"=>"1568801564676",
                        "signature"=> "JsnNW921WJDN51CUaadctSNkGDWlXo/28TrIKuKUIhc=",
                        "AuthUrl"=> "https://abacus.religarehealthinsurance.com/religare_api/api/web/v1/auth/access-token?formattype=json",
                        "Authsecret"=> "(IA@a2nvpD_s",
                        "ApiKey"=> "meRh5NCNLcxlqgtvqwNonbH4N6T3rKgs",
                        "QuickQuote"=>"https://abacus.religarehealthinsurance.com/religare_api/api/web/v1/abacus/partner?formattype=json",
                        "createPolicy"=>"https://apiuat.religarehealthinsurance.com/relinterfacerestful/religare/restful/createPolicy",
                        "pdf"=>"https://apiuat.religarehealthinsurance.com/relinterfacerestful/religare/restful/getPolicyPDFV2",
                        "payment_url"=>"https://apiuat.religarehealthinsurance.com/portalui/PortalPayment.run",
                        'policyStatus'=>"https://apiuat.religarehealthinsurance.com/relinterfacerestful/religare/secure/restful/getPolicyStatusV2"
                    ),
         "MANIPAL" => array( 
                       'status'=>true,
                       "appKey" => "12345",
                       "appIdQuote" => "240f9d2c",
                       "appIdAppNum" => "7b9cd9f7",
                       "appIdValidate" => "ee248f0c",
                       "appIdSave" => "ee248f0c",
                       "appIdGetPolicy" => "abbeb5c6",
                       "appIdDocsModule" => "aa9ea18e",
                       "XAuthToken" => "",
                       "Password" => "Cigna@123",
                       "QuickQuote" => "https://computequoteapi-3scale-apicast-staging.uatwebservices.manipalcigna.com/v1/rest/api/cigna/QuoteCompute",
                       "GetPolicyNum" =>"https://generateapplicationnumberapi-3scale-apicast-staging.uatwebservices.manipalcigna.com/o/mchi/generateApplicationNumber/",
                       "validateProposal" =>"https://saveproposalapi-3scale-apicast-staging.uatwebservices.manipalcigna.com/v1/api/cigna/SaveProposal",
                       "saveProposal" =>"https://saveproposalapi-3scale-apicast-staging.uatwebservices.manipalcigna.com/v1/api/cigna/SaveProposal",
                       "GetPolicyDetails" => "https://getpolicyapi-3scale-apicast-staging.uatwebservices.manipalcigna.com/v1/rest/api/cigna/rest/GetPolicy",
                       "DocsModule"=>"https://ccmdocfetch-3scale-apicast-staging.uatwebservices.manipalcigna.com/Download/MCHI/downloadfile",
                       "payment_url"=>"https://test.payu.in/_payment"
                     ),
        "DIGIT"=>array(
                      'status'=>true,
                      'ApiKey' => "1AJZE6FFGQVU7YGTYKHFYOHELU3QUHKV",
                      'TrApiKey' => "1AJZE6FFGQVU7YGTYKHFYOHELU3QUHKV",
                      'QuickQuote' => "https://preprod-healthpolicyissuance.godigit.com/healthpolicyissuance/v1/quickQuote",
                      'CreateQuote' => "https://preprod-healthpolicyissuance.godigit.com/healthpolicyissuance/policyservice/v1/partnerQuote",
                      'payment' => "",
                      'pdf' => "https://preprod-digitpolicyissuance.godigit.com/policyservice/v1/travel/policyDocument/",
                      'transaction' => "https://preprod-digitpolicyissuance.godigit.com/policyservice/v1/getTransactionDetails?transactionNo=",
                      
            )
     );
 ?>