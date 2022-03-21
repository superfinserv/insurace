<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>SuperSolutions</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">
  @media screen {
   @font-face {
      font-family: 'Source Sans Pro';
     font-style: normal;
      font-weight: 400;
      src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
    }
    @font-face {
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight: 700;
      src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
    }
  }

  body,table,td,a {
    -ms-text-size-adjust: 100%; /* 1 */
    -webkit-text-size-adjust: 100%; /* 2 */
  }
 
  table,td {
    mso-table-rspace: 0pt;
    mso-table-lspace: 0pt;
  }

 img {
    -ms-interpolation-mode: bicubic;
  }

  a[x-apple-data-detectors] {
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    color: inherit !important;
    text-decoration: none !important;
  }

  /**

   * Fix centering issues in Android 4.4.

   */

  div[style*="margin: 16px 0;"] {
    margin: 0 !important;
  }
  body {
    width: 100% !important;
    height: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
  }
  /**

   * Collapse table borders to avoid space between cells.

   */
  table {
    /*border-collapse: collapse !important;*/
  }

  a {
    color: #1a82e2;
  }

  img {

    height: auto;

    line-height: 100%;

    text-decoration: none;

    border: 0;

    outline: none;

  }

  </style>



</head>

<body style="background-color: #e9ecef;">
  <?php $partners = DB::table('our_partners')->where(['status'=>'ACTIVE'])->get(); ?>
  <!-- start body -->
  <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <!-- start header -->
    <tr>
      <td align="center" bgcolor="#e9ecef">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="    max-width: 600px;border-top: 35px solid #AC0F0B;border-right: 1px solid;border-left: 1px solid;border-top-left-radius: 25px;border-top-right-radius: 25px;">
              <tr >
            <td align="right" valign="top" style="padding:10px 10px;background: #fff;">
              <a href="{{url('/')}}" target="_blank" style="display: inline-block;">
                <img src="{{getAssets('logo/logo_5.png')}}" alt="SuperSolutions" border="0" width="180" style="display: block;width:50%;max-width:100%;">
              </a>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <!-- end header -->
    <!-- start body -->
    <tr>
      <td align="center">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;border-right: 1px solid;border-left: 1px solid;">
          <tr>
            <td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;">
              <?php  $html = ($body);echo $html;?>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    
    <!-- start footer -->
    <tr>
      <td align="center">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; border-bottom: 35px solid #AC0F0B;border-right: 1px solid;border-left: 1px solid;border-bottom-left-radius: 25px;border-bottom-right-radius: 25px;">
           <tr>
            <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 13px;line-height: 24px;">
              <p style="margin: 0;">Regards <br> Supersolutions Advisory Services Private Limited</p>
            </td>
          </tr>
          <tr>
            <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 24px;">
              <p style="margin: 0;">This is the system genrated e-mail.Please do not reply.</p>
            </td>
          </tr>
          <tr >
            <td align="right" valign="top" style="padding:10px 10px;background: #fff;">
              
               <ul  style="padding-left: 0;display: inline-flex;">
                   <?php foreach($partners as $pt){?>
                       <li style=" display: inline-block;width:20%"><a href="#"><img style="width: 100%;" src="<?=getAssets('partners/'.$pt->logo_image);?>" ></a></li>
                   <?php } ?>
            </ul>
            </td>
          </tr>
        </table>
      </td>
    </tr>
 <!-- end footer -->
  </table>
</body>
</html>