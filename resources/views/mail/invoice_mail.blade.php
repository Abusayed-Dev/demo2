<!DOCTYPE html>
<html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
   <head>
      <title></title>
      <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
      <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
      
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" type="text/css"/>
      <link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" type="text/css"/>
      <link href="https://fonts.googleapis.com/css?family=Droid+Serif" rel="stylesheet" type="text/css"/>
      <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css"/>
      <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet" type="text/css"/>
      <link href="https://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet" type="text/css"/>
      <link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet" type="text/css"/>
      <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"/>
      <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css"/>
      <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet" type="text/css"/>
      <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css"/>
      <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet" type="text/css"/>
      <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css"/>
      <!--<![endif]-->
      <style>
         * {
         box-sizing: border-box;
         }
         body {
         margin: 0;
         padding: 0;
         }
         a[x-apple-data-detectors] {
         color: inherit !important;
         text-decoration: inherit !important;
         }
         #MessageViewBody a {
         color: inherit;
         text-decoration: none;
         }
         p {
         line-height: inherit
         }
         @media (max-width:660px) {
         .icons-inner {
         text-align: center;
         }
         .icons-inner td {
         margin: 0 auto;
         }
         .row-content {
         width: 100% !important;
         }
         .column .border {
         display: none;
         }
         .stack .column {
         width: 100%;
         display: block;
         }
         }
      </style>
   </head>
   <body style="background-color: #fcefeb; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
      <table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fcefeb;" width="100%">
      <tbody>
         <tr>
            <td>
               <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fcefeb;" width="100%">
                  <tbody>
                     <tr>
                        <td>
                           <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-position: top center; background-color: #ffffff; color: #000000; background-image: url('{{ asset('public')}}/images/bg-top1.png'); background-repeat: no-repeat; width: 640px;" width="640">
                              <tbody>
                                 <tr>
                                    <td class="column column-1" style="text-align: center;" width="100%">
                                    	<strong style="color: greenyellow; font-size: 30px; padding:15px 0">Sucessfully Order Placed on our Ecommerce.</strong>
                                    </td>
                                 </tr>

                                 <tr>
                                    <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-bottom: 0px solid #FFFEFF; border-left: 0px solid #FFFEFF; border-right: 0px solid #FFFEFF; border-top: 0px solid #FFFEFF; padding-left: 20px; padding-right: 20px; padding-top: 30px; padding-bottom: 0px;" width="100%">

                                    	Date: <strong style="color: red;">{{$order['date']}}</strong>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-bottom: 0px solid #FFFEFF; border-left: 0px solid #FFFEFF; border-right: 0px solid #FFFEFF; border-top: 0px solid #FFFEFF; padding-left: 20px; padding-right: 20px; padding-top: 30px; padding-bottom: 0px;" width="100%">

                                    	OrderID: <strong style="color: red;">{{$order['order_id']}}</strong>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-bottom: 0px solid #FFFEFF; border-left: 0px solid #FFFEFF; border-right: 0px solid #FFFEFF; border-top: 0px solid #FFFEFF; padding-left: 20px; padding-right: 20px; padding-top: 30px; padding-bottom: 0px;" width="100%">

                                    	Name: <strong style="color: red;">{{$order['name']}}</strong>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-bottom: 0px solid #FFFEFF; border-left: 0px solid #FFFEFF; border-right: 0px solid #FFFEFF; border-top: 0px solid #FFFEFF; padding-left: 20px; padding-right: 20px; padding-top: 30px; padding-bottom: 0px;" width="100%">

                                    	Email: <strong style="color: red;">{{$order['email']}}</strong>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-bottom: 0px solid #FFFEFF; border-left: 0px solid #FFFEFF; border-right: 0px solid #FFFEFF; border-top: 0px solid #FFFEFF; padding-left: 20px; padding-right: 20px; padding-top: 30px; padding-bottom: 0px;" width="100%">

                                    	Phone Number: <strong style="color: red;">{{$order['phone']}}</strong>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-bottom: 0px solid #FFFEFF; border-left: 0px solid #FFFEFF; border-right: 0px solid #FFFEFF; border-top: 0px solid #FFFEFF; padding-left: 20px; padding-right: 20px; padding-top: 30px; padding-bottom: 0px;" width="100%">

                                    	Address: <strong style="color: red;">{{$order['shipping_address']}}</strong>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-bottom: 0px solid #FFFEFF; border-left: 0px solid #FFFEFF; border-right: 0px solid #FFFEFF; border-top: 0px solid #FFFEFF; padding-left: 20px; padding-right: 20px; padding-top: 30px; padding-bottom: 0px;" width="100%">

                                    	Total: <strong style="color: red;">{{$order['total']}}</strong>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
               <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-position: top center;" width="100%">
                  <tbody>
                     <tr>
                        <td>
                           <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 640px;" width="640">
                              <tbody>
                                 <tr>
                                    <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 10px; padding-bottom: 10px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                       <table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                          <tr>
                                             <td style="padding-bottom:10px;padding-left:30px;padding-right:30px;padding-top:35px;">
                                                <div style="font-family: sans-serif">
                                                   <div style="font-size: 12px; mso-line-height-alt: 21.6px; color: #605c7e; line-height: 1.8; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;">
                                                      <p style="margin: 0; text-align: center;"><span style=""><span style="font-size:16px;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </span><span style="font-size:16px;">Aenean commodo ligula eget dolor. Aenean massa. </span></span></p>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                       </table>
                                       <table border="0" cellpadding="10" cellspacing="0" class="social_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                          <tr>
                                             <td>
                                                <table align="center" border="0" cellpadding="0" cellspacing="0" class="social-table" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="144px">
                                                   <tr>
                                                      <td style="padding:0 2px 0 2px;"><a href="https://www.facebook.com/" target="_blank"><img alt="Facebook" height="32" src="{{ asset('public') }}/images/facebook2x.png" style="display: block; height: auto; border: 0;" title="facebook" width="32"/></a></td>
                                                      <td style="padding:0 2px 0 2px;"><a href="https://www.twitter.com/" target="_blank"><img alt="Twitter" height="32" src="{{ asset('public') }}/images/twitter2x.png" style="display: block; height: auto; border: 0;" title="twitter" width="32"/></a></td>
                                                      <td style="padding:0 2px 0 2px;"><a href="https://www.linkedin.com/" target="_blank"><img alt="Linkedin" height="32" src="{{ asset('public') }}/images/linkedin2x.png" style="display: block; height: auto; border: 0;" title="linkedin" width="32"/></a></td>
                                                      <td style="padding:0 2px 0 2px;"><a href="https://www.instagram.com/" target="_blank"><img alt="Instagram" height="32" src="{{ asset('public') }}/images/instagram2x.png" style="display: block; height: auto; border: 0;" title="instagram" width="32"/></a></td>
                                                   </tr>
                                                </table>
                                             </td>
                                          </tr>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
               <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                  <tbody>
                     <tr>
                        <td>
                           <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 640px;" width="640">
                              <tbody>
                                 <tr>
                                    <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                       <table border="0" cellpadding="0" cellspacing="0" class="icons_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                          <tr>
                                             <td style="vertical-align: middle; color: #9d9d9d; font-family: inherit; font-size: 15px; padding-bottom: 5px; padding-top: 5px; text-align: center;">
                                                <table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                   <tr>
                                                      <td style="vertical-align: middle; text-align: center;">
                                                            <table cellpadding="0" cellspacing="0" class="icons-inner" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block; margin-right: -4px; padding-left: 0px; padding-right: 0px;">
                                                               
                                                            </table>
                                                            </td>
                                                            </tr>
                                                         </table>
                                                      </td>
                                                   </tr>
                                                </table>
                                             </td>
                                          </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
               <!-- End -->
   </body>
</html>