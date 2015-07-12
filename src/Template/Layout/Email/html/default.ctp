<?php

if (empty($title)) {
    $title = 'Email';
}

$this->assign('title', $title);

if (empty($backgroundColor)) {
    $backgroundColor = '#FFFFFF';
}

$this->assign('backgroundColor', $backgroundColor);

if (empty($fontColor)) {
    $fontColor = '#000000';
}

$this->assign('fontColor', $fontColor);

if (empty($foregroundColor)) {
    $foregroundColor = '#cecece';
}

$this->assign('foregroundColor', $foregroundColor);

if (empty($company)) {
    $company = '';
}

$this->assign('company', $company);

if (!empty($url)) {
    $this->assign('urlLink', "<a href=\"$url\">$url</a>");
} else {
    $this->assign('urlLink', '');
}

if (!empty($facebook)) {
    $this->assign('facebookLink', "<a href=\"$facebook\" class=\"socialLink\"><svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"
	 viewBox=\"0 0 36 36\" enable-background=\"new 0 0 36 36\" xml:space=\"preserve\">
<path id=\"XMLID_2_\" fill-rule=\"evenodd\" clip-rule=\"evenodd\" fill=\"$fontColor\" d=\"M18,0.2C8.1,0.2,0,8.2,0,18s8.1,17.8,18,17.8
	c9.9,0,18-8,18-17.8S27.9,0.2,18,0.2z M21.8,18h-2.4v8.6h-3.6V18h-1.8v-3h1.8v-1.8c0-2.4,1-3.9,4-3.9h2.4v3h-1.5
	c-1.1,0-1.2,0.4-1.2,1.2l0,1.5h2.8L21.8,18z\"/>
</svg> Facebook</a>");
} else {
    $this->assign('facebookLink', '');
}

if (!empty($twitter)) {
    $this->assign('twitterLink', "<a href=\"$twitter\" class=\"socialLink\"><svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"
	 viewBox=\"0 0 36 36\" enable-background=\"new 0 0 36 36\" xml:space=\"preserve\">
<path id=\"XMLID_4_\" fill-rule=\"evenodd\" clip-rule=\"evenodd\" fill=\"$fontColor\" d=\"M18,0.4c-9.9,0-18,8-18,17.8S8.1,36,18,36
	c9.9,0,18-8,18-17.8S27.9,0.4,18,0.4z M26.6,13.9c0,0.2,0,0.4,0,0.6c0,5.8-4.5,12.4-12.6,12.4c-2.5,0-4.8-0.7-6.8-2
	c0.3,0,0.7,0.1,1.1,0.1c2.1,0,4-0.7,5.5-1.9c-1.9,0-3.6-1.3-4.1-3c0.3,0.1,0.5,0.1,0.8,0.1c0.4,0,0.8-0.1,1.2-0.2
	c-2-0.4-3.6-2.2-3.6-4.3c0,0,0,0,0-0.1c0.6,0.3,1.3,0.5,2,0.5c-1.2-0.8-2-2.1-2-3.6c0-0.8,0.2-1.6,0.6-2.2c2.2,2.6,5.5,4.4,9.1,4.6
	c-0.1-0.3-0.1-0.7-0.1-1c0-2.4,2-4.4,4.4-4.4c1.3,0,2.4,0.5,3.2,1.4c1-0.2,2-0.6,2.8-1.1c-0.3,1-1,1.9-1.9,2.4
	c0.9-0.1,1.8-0.3,2.5-0.7C28.2,12.5,27.5,13.2,26.6,13.9z\"/>
</svg> Twitter</a>");
} else {
    $this->assign('twitterLink', '');
}

if (!empty($logo)) {
    $this->assign('logo', "<img src=\"$logo\" id=\"headerImage\" />");
} else {
    $this->assign('logo', '');
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $this->fetch('title'); ?></title>
        <style type="text/css">
			/* /\/\/\/\/\/\/\/\/ CLIENT-SPECIFIC STYLES /\/\/\/\/\/\/\/\/ */
			#outlook a{padding:0;} /* Force Outlook to provide a "view in browser" message */
			.ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
			.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing */
			body, table, td, p, a, li, blockquote{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
			table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up */
			img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */

			/* /\/\/\/\/\/\/\/\/ RESET STYLES /\/\/\/\/\/\/\/\/ */
			body{margin:0; padding:0;}
			img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
			table{border-collapse:collapse !important;}
			body, #bodyTable, #bodyCell{height:100% !important; margin:0; padding:0; width:100% !important;}

			/* /\/\/\/\/\/\/\/\/ TEMPLATE STYLES /\/\/\/\/\/\/\/\/ */

			#bodyCell{padding:20px;}
			#templateContainer{width:600px;}
            
            .fullWidthWrapper{
                width: 100%;
                text-align: center;
            }

			/* ========== Page Styles ========== */

			/**
			* @tab Page
			* @section background style
			* @tip Set the background color and top border for your email. You may want to choose colors that match your company's branding.
			* @theme page
			*/
			body, #bodyTable{
				/*@editable*/ background-color:<?php echo $this->fetch('backgroundColor'); ?>;
			}

			/**
			* @tab Page
			* @section background style
			* @tip Set the background color and top border for your email. You may want to choose colors that match your company's branding.
			* @theme page
			*/
			#bodyCell{

			}

			/**
			* @tab Page
			* @section email border
			* @tip Set the border for your email.
			*/
			#templateContainer{

			}

			/**
			* @tab Page
			* @section heading 1
			* @tip Set the styling for all first-level headings in your emails. These should be the largest of your headings.
			* @style heading 1
			*/
			h1{
				/*@editable*/ color:<?php echo $this->fetch('fontColor'); ?> !important;
				display:block;
				/*@editable*/ font-family:'Helvetica Neue',Helvetica;
				/*@editable*/ font-size:26px;
				/*@editable*/ font-style:normal;
				/*@editable*/ font-weight:bold;
				/*@editable*/ line-height:100%;
				/*@editable*/ letter-spacing:normal;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				/*@editable*/ text-align:left;
			}

			/**
			* @tab Page
			* @section heading 2
			* @tip Set the styling for all second-level headings in your emails.
			* @style heading 2
			*/
			h2{
				/*@editable*/ color:<?php echo $this->fetch('fontColor'); ?> !important;
				display:block;
				/*@editable*/ font-family:'Helvetica Neue',Helvetica;
				/*@editable*/ font-size:20px;
				/*@editable*/ font-style:normal;
				/*@editable*/ font-weight:bold;
				/*@editable*/ line-height:100%;
				/*@editable*/ letter-spacing:normal;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				/*@editable*/ text-align:left;
			}

			/**
			* @tab Page
			* @section heading 3
			* @tip Set the styling for all third-level headings in your emails.
			* @style heading 3
			*/
			h3{
				/*@editable*/ color:<?php echo $this->fetch('fontColor'); ?> !important;
				display:block;
				/*@editable*/ font-family:'Helvetica Neue',Helvetica;
				/*@editable*/ font-size:16px;
				/*@editable*/ font-style:italic;
				/*@editable*/ font-weight:normal;
				/*@editable*/ line-height:100%;
				/*@editable*/ letter-spacing:normal;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				/*@editable*/ text-align:left;
			}

			/**
			* @tab Page
			* @section heading 4
			* @tip Set the styling for all fourth-level headings in your emails. These should be the smallest of your headings.
			* @style heading 4
			*/
			h4{
				/*@editable*/ color:<?php echo $this->fetch('fontColor'); ?> !important;
				display:block;
				/*@editable*/ font-family:'Helvetica Neue',Helvetica;
				/*@editable*/ font-size:14px;
				/*@editable*/ font-style:italic;
				/*@editable*/ font-weight:normal;
				/*@editable*/ line-height:100%;
				/*@editable*/ letter-spacing:normal;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				/*@editable*/ text-align:left;
			}

			/* ========== Header Styles ========== */

			/**
			* @tab Header
			* @section header style
			* @tip Set the background color and borders for your email's header area.
			* @theme header
			*/
			#templateHeader{

			}

			/**
			* @tab Header
			* @section header text
			* @tip Set the styling for your email's header text. Choose a size and color that is easy to read.
			*/
			.headerContent{
				/*@editable*/ color:<?php echo $this->fetch('fontColor'); ?>;
				/*@editable*/ font-family:'Helvetica Neue',Helvetica;
				/*@editable*/ font-size:20px;
				/*@editable*/ font-weight:bold;
				/*@editable*/ line-height:100%;
				/*@editable*/ padding-top:10px;
				/*@editable*/ padding-right:0;
				/*@editable*/ padding-bottom:30px;
				/*@editable*/ padding-left:0;
				/*@editable*/ text-align:left;
				/*@editable*/ vertical-align:middle;
			}

			/**
			* @tab Header
			* @section header link
			* @tip Set the styling for your email's header links. Choose a color that helps them stand out from your text.
			*/
			.headerContent a:link, .headerContent a:visited, /* Yahoo! Mail Override */ .headerContent a .yshortcuts /* Yahoo! Mail Override */{
				/*@editable*/ color:<?php echo $this->fetch('fontColor'); ?>;
				/*@editable*/ font-weight:normal;
				/*@editable*/ text-decoration:underline;
			}

			#headerImage{
				height:auto;
				max-width:600px;
			}

			/* ========== Body Styles ========== */

			/**
			* @tab Body
			* @section body style
			* @tip Set the background color and borders for your email's body area.
			*/
			#templateBody{
				/*@editable*/ background-color:<?php echo $this->fetch('foregroundColor'); ?>;
			}

			/**
			* @tab Body
			* @section body text
			* @tip Set the styling for your email's main content text. Choose a size and color that is easy to read.
			* @theme main
			*/
			.bodyContent{
				/*@editable*/ color:<?php echo $this->fetch('fontColor'); ?>;
				/*@editable*/ font-family:'Helvetica Neue',Helvetica;
				/*@editable*/ font-size:14px;
				/*@editable*/ line-height:150%;
				padding-top:20px;
				padding-right:20px;
				padding-bottom:20px;
				padding-left:20px;
				/*@editable*/ text-align:left;
			}

			/**
			* @tab Body
			* @section body link
			* @tip Set the styling for your email's main content links. Choose a color that helps them stand out from your text.
			*/
			.bodyContent a:link, .bodyContent a:visited, /* Yahoo! Mail Override */ .bodyContent a .yshortcuts /* Yahoo! Mail Override */{
				/*@editable*/ color:<?php echo $this->fetch('fontColor'); ?>;
				/*@editable*/ font-weight:normal;
				/*@editable*/ text-decoration:underline;
			}

			.bodyContent img{
				display:inline;
				height:auto;
				max-width:560px;
			}

			/* ========== Footer Styles ========== */

			/**
			* @tab Footer
			* @section footer style
			* @tip Set the background color and borders for your email's footer area.
			* @theme footer
			*/
			#templateFooter{

			}

			/**
			* @tab Footer
			* @section footer text
			* @tip Set the styling for your email's footer text. Choose a size and color that is easy to read.
			* @theme footer
			*/
			.footerContent{
				/*@editable*/ color:<?php echo $this->fetch('fontColor'); ?>;
				/*@editable*/ font-family:'Helvetica Neue',Helvetica;
				/*@editable*/ font-size:12px;
				/*@editable*/ line-height:150%;
				padding-top:20px;
				padding-right:20px;
				padding-bottom:20px;
				padding-left:20px;
				/*@editable*/ text-align:left;
			}
            
            .footerContent hr{
                border: none;
                border-top: 2px solid <?php echo $this->fetch('backgroundColor'); ?>;
            }
            
            /**
			* @tab Footer
			* @section footer link
			* @tip Set the styling for your email's footer links. Choose a color that helps them stand out from your text.
			*/
			.footerContent a:link, .footerContent a:visited, /* Yahoo! Mail Override */ .footerContent a .yshortcuts, .footerContent a span /* Yahoo! Mail Override */{
                /*@editable*/ font-size:12px;
				/*@editable*/ color:<?php echo $this->fetch('fontColor'); ?>;
				/*@editable*/ font-weight:normal;
				/*@editable*/ text-decoration:none;
			}
            
            .footerContent.socialLinks{
                padding-top:0;
                text-align:right;
                height:30px;
            }
            
            .footerContent.socialLinks a{
                float: right;
                margin-left:5px;
            }
            
            .footerContent.socialLinks svg{
                width:20px;
                position:relative;
                top:5px;
            }
            
            .footerContent.companyName{
                padding-top:0;
                height:30px;
            }

			/* /\/\/\/\/\/\/\/\/ MOBILE STYLES /\/\/\/\/\/\/\/\/ */

            @media only screen and (max-width: 480px){
				/* /\/\/\/\/\/\/ CLIENT-SPECIFIC MOBILE STYLES /\/\/\/\/\/\/ */
				body, table, td, p, a, li, blockquote{-webkit-text-size-adjust:none !important;} /* Prevent Webkit platforms from changing default text sizes */
                body{width:100% !important; min-width:100% !important;} /* Prevent iOS Mail from adding padding to the body */

				/* /\/\/\/\/\/\/ MOBILE RESET STYLES /\/\/\/\/\/\/ */
				#bodyCell{padding:10px !important;}

				/* /\/\/\/\/\/\/ MOBILE TEMPLATE STYLES /\/\/\/\/\/\/ */

				/* ======== Page Styles ======== */

				/**
				* @tab Mobile Styles
				* @section template width
				* @tip Make the template fluid for portrait or landscape view adaptability. If a fluid layout doesn't work for you, set the width to 300px instead.
				*/
				#templateContainer{
					max-width:600px !important;
					/*@editable*/ width:100% !important;
				}

				/**
				* @tab Mobile Styles
				* @section heading 1
				* @tip Make the first-level headings larger in size for better readability on small screens.
				*/
				h1{
					/*@editable*/ font-size:20px !important;
					/*@editable*/ line-height:100% !important;
				}

				/**
				* @tab Mobile Styles
				* @section heading 2
				* @tip Make the second-level headings larger in size for better readability on small screens.
				*/
				h2{
					/*@editable*/ font-size:18px !important;
					/*@editable*/ line-height:100% !important;
				}

				/**
				* @tab Mobile Styles
				* @section heading 3
				* @tip Make the third-level headings larger in size for better readability on small screens.
				*/
				h3{
					/*@editable*/ font-size:16px !important;
					/*@editable*/ line-height:100% !important;
				}

				/**
				* @tab Mobile Styles
				* @section heading 4
				* @tip Make the fourth-level headings larger in size for better readability on small screens.
				*/
				h4{
					/*@editable*/ font-size:14px !important;
					/*@editable*/ line-height:100% !important;
				}

				/* ======== Header Styles ======== */

				#templatePreheader{display:none !important;} /* Hide the template preheader to save space */

				/**
				* @tab Mobile Styles
				* @section header image
				* @tip Make the main header image fluid for portrait or landscape view adaptability, and set the image's original width as the max-width. If a fluid setting doesn't work, set the image width to half its original size instead.
				*/
				#headerImage{
					height:auto !important;
					/*@editable*/ max-width:600px !important;
					/*@editable*/ width:100% !important;
				}

				/**
				* @tab Mobile Styles
				* @section header text
				* @tip Make the header content text larger in size for better readability on small screens. We recommend a font size of at least 16px.
				*/
				.headerContent{
					/*@editable*/ font-size:16px !important;
					/*@editable*/ line-height:125% !important;
				}

				/* ======== Body Styles ======== */

				/**
				* @tab Mobile Styles
				* @section body image
				* @tip Make the main body image fluid for portrait or landscape view adaptability, and set the image's original width as the max-width. If a fluid setting doesn't work, set the image width to half its original size instead.
				*/
				#bodyImage{
					height:auto !important;
					/*@editable*/ max-width:560px !important;
					/*@editable*/ width:100% !important;
				}

				/**
				* @tab Mobile Styles
				* @section body text
				* @tip Make the body content text larger in size for better readability on small screens. We recommend a font size of at least 16px.
				*/
				.bodyContent{
					/*@editable*/ font-size:14px !important;
					/*@editable*/ line-height:125% !important;
				}

				/* ======== Footer Styles ======== */

				/**
				* @tab Mobile Styles
				* @section footer text
				* @tip Make the body content text larger in size for better readability on small screens.
				*/
				.footerContent{
					/*@editable*/ font-size:12px !important;
					/*@editable*/ line-height:115% !important;
				}

				.footerContent a{display:block !important;} /* Place footer social and utility links on their own lines, for easier access */
			}
		</style>
    </head>
    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
    	<center>
        	<table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
            	<tr>
                	<td align="center" valign="top" id="bodyCell">
                    	<!-- BEGIN TEMPLATE // -->
                    	<table border="0" cellpadding="0" cellspacing="0" id="templateContainer">
                        	<tr>
                            	<td align="center" valign="top">
                                	<!-- BEGIN HEADER // -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateHeader">
                                        <tr>
                                            <td valign="top" class="headerContent">
                                            	<div class="fullWidthWrapper">
                                                    <?php echo $this->fetch('logo'); ?>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // END HEADER -->
                                </td>
                            </tr>
                        	<tr>
                            	<td align="center" valign="top">
                                	<!-- BEGIN BODY // -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody">
                                        <tr>
                                            <td valign="top" class="bodyContent">
                                                <?php echo $this->fetch('content'); ?>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // END BODY -->
                                </td>
                            </tr>
                        	<tr>
                            	<td align="center" valign="top">
                                	<!-- BEGIN FOOTER // -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateFooter">
                                        <tr>
                                            <td valign="top" class="footerContent" colspan="2">
                                                <div class="fullWidthWrapper">
                                                    <?php echo $this->fetch('urlLink'); ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" class="footerContent" colspan="2">
                                                <hr />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="bottom" class="footerContent companyName">
                                                <?php echo $this->fetch('company'); ?>
                                            </td>
                                            <td valign="bottom" class="footerContent socialLinks">
                                                <?php echo $this->fetch('facebookLink'); ?>
                                                <?php echo $this->fetch('twitterLink'); ?>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // END FOOTER -->
                                </td>
                            </tr>
                        </table>
                        <!-- // END TEMPLATE -->
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>