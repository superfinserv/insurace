<?php
 return array ( 
         "DIGIT" => array (
            'tw'=>array(
                      'paymentKey' => "6BIQYBYDBOF2F7YU9VAVA90BHESPV8I1",
                      'password' => "digit123",
                      'username' => "51197558",
                      'QuickQuote' => "https://preprod-qnb.godigit.com/digit/motor-insurance/services/v2/quickquote?sourceChannel=PARTNER&isPremiumRecalculate=false&isUserSpecialDiscountOpted=true",
                      'recQuote'    => "https://preprod-qnb.godigit.com/digit/motor-insurance/services/v2/quickquote?sourceChannel=PARTNER&isPremiumRecalculate=true&isUserSpecialDiscountOpted=true",
                      'CreateQuote' => "https://preprod-qnb.godigit.com/digit/motor-insurance/services/v2/quote?isUserSpecialDiscountOpted=true&isDownloadQuote=true",
                      'generatePolicy' => "https://preprod-pdfgeneration.godigit.com/PDFGeneration/rest/digit/generatePolicy",
                      'transactionDetails' => "http://preprod-digitpolicyissuance.godigit.com/policyservice/v1/getTransactionDetails?transactionNo=",
                      'payment' => "https://preprod-digitpaymentgateway.godigit.com/DigitPaymentGateway/rest/insertPaymentOnline/EB/Motor",
                      'status' => true,
                ),
            'car'=>array(
                      'paymentKey' => "6BIQYBYDBOF2F7YU9VAVA90BHESPV8I1",
                      'password' => "digit123",
                      'username' => "25860711",
                      'QuickQuote' => "https://preprod-qnb.godigit.com/digit/motor-insurance/services/v2/quickquote?sourceChannel=PARTNER&isPremiumRecalculate=false&isUserSpecialDiscountOpted=false",
                      'recQuote'    => "https://preprod-qnb.godigit.com/digit/motor-insurance/services/v2/quickquote?sourceChannel=PARTNER&isPremiumRecalculate=true&isUserSpecialDiscountOpted=false",
                      'CreateQuote' => "https://preprod-qnb.godigit.com/digit/motor-insurance/services/v2/quote?isUserSpecialDiscountOpted=false&isDownloadQuote=true",
                      'generatePolicy' => "https://preprod-pdfgeneration.godigit.com/PDFGeneration/rest/digit/generatePolicy",
                      'transactionDetails' => "http://preprod-digitpolicyissuance.godigit.com/policyservice/v1/getTransactionDetails?transactionNo=",
                      'payment' => "https://preprod-digitpaymentgateway.godigit.com/DigitPaymentGateway/rest/insertPaymentOnline/EB/Motor",
                      'status' => true,
                      )
            
            ),
            
         "HDFCERGO" => array (
         
            'tw'=>array(
                        'mKey'=>'FINSERV',
                        'secretToken'=>'KxP8dEbeAWC+Ic7O7gFu9A==',
                        'agentCode'=>'TWC17722',
                        'masterData'=>'https://uatcp.hdfcergo.com/TWOnline/ChannelPartner/GetMasterData',
                        'calculatePremium'=>'https://uatcp.hdfcergo.com/TWOnline/ChannelPartner/CalculatePremium',
                        'proposalGeneration'=>'https://uatcp.hdfcergo.com/TWOnline/ChannelPartner/SaveTransaction',
                        'paymentGateway'=>'https://uatpg.hdfcergo.com/PaymentGateway/Payments.aspx',
                        'policyGeneration'=>'https://uatcp.hdfcergo.com/TWOnline/ChannelPartner/PolicyGeneration',
                        'policyDownload'=>'https://uatcp.hdfcergo.com/CPDownload/api/DownloadPolicy/PolicyDetails',
                       
                        'checksumGenerate'=>'https://uatcp.hdfcergo.com/PaymentUtilitiesAPI/api/PaymentUtilities/GenerateResponseCheck',
                        'status' => true,
                      ),
             'car'=>array(
                        'mKey'=>'FINSERV',
                        'secretToken'=>'oBByKfE6gpv2AWnhjpk1VA==',
                        'agentCode'=>'FWC17723',
                        'masterData'=>'https://uatcp.hdfcergo.com/PCOnline/ChannelPartner/GetMasterData',
                        'calculatePremium'=>'https://uatcp.hdfcergo.com/PCOnline/ChannelPartner/CalculatePremium',
                        'proposalGeneration'=>'https://uatcp.hdfcergo.com/PCOnline/ChannelPartner/SaveTransaction',
                        'paymentGateway'=>'https://uatpg.hdfcergo.com/PaymentGateway/Payments.aspx',
                        'policyGeneration'=>'https://uatcp.hdfcergo.com/PCOnline/ChannelPartner/PolicyGeneration',
                        'policyDownload'=>'https://uatcp.hdfcergo.com/CPDownload/api/DownloadPolicy/PolicyDetails',
                        'breakinDetails'=>'https://uatcp.hdfcergo.com/PCOnline/ChannelPartner/GetBreakinDetails',
                        'postInspectionDetails'=>'https://uatcp.hdfcergo.com/PCOnline/ChannelPartner/GetPostInspectionDetails', 
                        'postInspectionCalcultePremium'=>'https://uatcp.hdfcergo.com/PCOnline/ChannelPartner/PostInspectionCalculatePremium', 
                        'postInspectionProposalGeneration'=>'https://uatcp.hdfcergo.com/PCOnline/ChannelPartner/PostInspectionSaveTransaction', 
                        'shortTransaction'=>'https://uatcp.hdfcergo.com/PCOnline/ChannelPartner/ShortSaveTransaction',
                       
                        'checksumGenerate'=>'https://uatcp.hdfcergo.com/PaymentUtilitiesAPI/api/PaymentUtilities/GenerateResponseCheck',
                        'status' => true,
                )
            
            ),
        
     );
 ?>