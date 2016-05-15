<?php
// $Id: page.tpl.php,v 1.11.2.1 2009/04/30 00:13:31 goba Exp $

/**
 * @file page.tpl.php
 *
 * Theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $css: An array of CSS files for the current page.
 * - $directory: The directory the theme is located in, e.g. themes/garland or
 *   themes/garland/minelli.
 * - $is_front: TRUE if the current page is the front page. Used to toggle the mission statement.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Page metadata:
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $head_title: A modified version of the page title, for use in the TITLE tag.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $body_classes: A set of CSS classes for the BODY tag. This contains flags
 *   indicating the current layout (multiple columns, single column), the current
 *   path, whether the user is logged in, and so on.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $mission: The text of the site mission, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $search_box: HTML to display the search box, empty if search has been disabled.
 * - $primary_links (array): An array containing primary navigation links for the
 *   site, if they have been configured.
 * - $secondary_links (array): An array containing secondary navigation links for
 *   the site, if they have been configured.
 *
 * Page content (in order of occurrance in the default page.tpl.php):
 * - $left: The HTML for the left sidebar.
 *
 * - $breadcrumb: The breadcrumb trail for the current page.
 * - $title: The page title, for use in the actual HTML content.
 * - $help: Dynamic help text, mostly for admin pages.
 * - $messages: HTML for status and error messages. Should be displayed prominently.
 * - $tabs: Tabs linking to any sub-pages beneath the current page (e.g., the view
 *   and edit tabs when displaying a node).
 *
 * - $content: The main content of the current Drupal page.
 *
 * - $right: The HTML for the right sidebar.
 *
 * Footer/closing data:
 * - $feed_icons: A string of all feed icons for the current page.
 * - $footer_message: The footer message as defined in the admin settings.
 * - $footer : The footer region.
 * - $closure: Final closing markup from any modules that have altered the page.
 *   This variable should always be output last, after all other dynamic content.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 *
 * Updates:
 * 03/25/2014 - Updated BW Tag links to direct to correct URLS (JD)
 * 03/13/2014 - Added Breadcrumb code after Chrome (MD)
 *            - added legal verbiage from Business Wire afte head (JD)
 * 03/11/2014 - added HTML5SHIV.JS call (Requires JS/HTML5SHIV.JS now in Quash)
 * 03/08/2014 - added BW Tags for NewsHQ and InvestorHQ (MD)
 * 03/04/2014 - added IE9 identity crisis fix after Krispy Kreme issues
 * 03/03/2014 - added comments for client javascript inclusions based on bootstrap requirements
 *            - added optional ie9.css call
 * 
 */

$theme_path = $base_path . $directory;

?>
<!DOCTYPE html>
<html lang="<?php print $language->language ?>" class="no-js">

<head>
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- // IE9 IDENTITY CRISIS FIX -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php print $head; ?>
  <title><?php print $head_title; ?></title>

  <link rel="stylesheet" href="<?php print $theme_path; ?>/client_files/css/global.css"/>
  <?php print $external_styles; ?>
  <?php print $styles; ?>

  <script src="<?php print $theme_path; ?>/client_files/js/vendor/modernizr.js"></script>

  <!-- moved from footer -->
  <script src="<?php print $theme_path; ?>/client_files/js/vendor/jquery-2.1.1.min.js"></script> 
  <script src="<?php print $theme_path; ?>/client_files/js/vendor/vendor.min.js"></script> 
  <script src="<?php print $theme_path; ?>/client_files/js/main.min.js"></script> 
   <!-- end moved from footer -->
  <script type="text/javascript">var smq = jQuery.noConflict( true );</script>

  <!-- script src="<?php print $theme_path; ?>/client_files/js/vendor/jquery-2.1.1.js"></script> 
  <script src="<?php print $theme_path; ?>/client_files/js/vendor/jquery.mobile.custom.min.js"></script>
  <script src="<?php print $theme_path; ?>/client_files/js/vendor/fastclick.js"></script>
  <script src="<?php print $theme_path; ?>/client_files/js/main.js"></script> <!-- Resource jQuery -->
 

  <?php print $scripts; ?>

  <script type="text/javascript" src="<?php print $theme_path; ?>/bw_custom.js"></script> 
  
  <?php print $external_scripts; ?>
  <?php
  if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) {
    print $https_only_external_scripts;
  }
  else {
    print $http_only_external_scripts;
  }
  ?>
  <?php print $conditional_overrides; ?>
  <?php print $sharing_head; ?>
  
  <script type="text/javascript"><?php /* Needed to avoid Flash of Unstyled Content in IE */ ?> </script>
</head>
<body class="<?php print $body_classes; ?>">
    
    <!-- User Navigation -->
    <?php if ($user_nav && $logged_in) : ?>
      <div id="bw-user-nav"><?php print $user_nav; ?></div>
    <?php endif; ?>

  <header class="cd-main-header outer-container">
    <a class="cd-logo" href="http://www.servicemaster.com/"><img src="<?php print $theme_path; ?>/client_files/img/logo.svg" alt="Logo"></a>

     <!-- <div class="cd-overlay"></div> -->
    <ul class="cd-header-buttons">
      <li><a class="cd-nav-trigger" href="#cd-primary-nav">Menu<span></span></a></li>
    </ul> <!-- cd-header-buttons -->

  </header>

  <div class="cd-main-content">

    <?php if ($hero): ?>
      <?php print $hero; ?>
    <?php endif; ?>
      
    <div class="outer-container--pt <?php print ( $left && isset($node) ? 'layout-3-col' : ( $left || isset($node) ? 'layout-2-col' : '' ) ); ?> <?php print ( $is_front ? 'investors-lp' : ''); ?>">

      <?php if ($left): ?> 
        <aside class="aside-secondary" role="complementary">
          <?php print $left; ?> 
        </aside>
      <?php endif; ?>
      
      <main class="main-primary" id="content" role="main">

        <?php if ($breadcrumb): ?> 
          <!-- BW: breadcrumb --> 
            <?php print $breadcrumb; ?> 
          <!-- BW: End breadcrumb -->
        <?php endif; ?>

        <?php if ($title): ?>
          <h1><?php print $title; ?></h1>
        <?php endif; ?>

        <!-- Do not strip this code --> 
          <?php if ($tabs): ?>
            <div id="bw-tabs">
              <?php print $tabs; ?>
            </div>
          <?php endif; ?>

          <?php if ($messages): ?>
            <?php print $messages; ?>
          <?php endif; ?>
          <?php if ($help): ?>
            <?php print $help; ?>
          <?php endif; ?>

          <?php print $content; ?>
        
          <?php print $workflow_links; ?>
        <!--  END: Do no strip this code -->      

      </main> <!-- /#content -->

      <?php if (isset($node)): ?> 
        <aside class="aside-tertiary" role="complementary">
          <ul class="tertiary-icon-links__ul">   
               <li class="tertiary-icon-links__li">  
                   <a href="mailto:?subject=&amp;body=:%20http%3A%2F%2Fservicemaster.com" target="_blank" title="Email" onclick="window.open('mailto:?subject=' + encodeURIComponent(document.title) + '&amp;body=' +  encodeURIComponent(document.URL)); return false;"> <img src="<?php print $theme_path; ?>/client_files/img/icons/email.svg" alt="email icon" class="tertiary-icon-links__img"> <span class="tertiary-icon-links__span">Email</span> </a>   
               </li>   
               <li class="tertiary-icon-links__li">  
                   <a href="/printpdf/<?php print $node->nid; ?>"> <img src="<?php print $theme_path; ?>/client_files/img/icons/pdf.svg" alt="pdf icon" class="tertiary-icon-links__img"> <span class="tertiary-icon-links__span">Download PDF</span> </a>   
               </li>   
               <li class="tertiary-icon-links__li">  
                 <!-- href="javascript:window.print()" -->   
                   <a href="/print/<?php print $node->nid; ?>"> <img src="<?php print $theme_path; ?>/client_files/img/icons/print.svg" alt="print icon" class="tertiary-icon-links__img"> <span class="tertiary-icon-links__span">Print</span> </a>   
               </li>   
               <li class="tertiary-icon-links__li">  
                   <a href="https://twitter.com/intent/tweet?source=http%3A%2F%2Fservicemaster.com&amp;text=:%20http%3A%2F%2Fservicemaster.com&amp;via=ServiceMaster" target="_blank" title="Tweet" onclick="window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(document.title) + ':%20'  + encodeURIComponent(document.URL)); return false;"> <img src="<?php print $theme_path; ?>/client_files/img/icons/twitter.svg" alt="twitter icon" class="tertiary-icon-links__img"> <span class="tertiary-icon-links__span">Twitter</span> </a>   
               </li>   
               <li class="tertiary-icon-links__li">  
                   <a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fservicemaster.com&amp;t=" target="_blank" title="Share on Facebook" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(document.URL) + '&amp;t=' + encodeURIComponent(document.URL)); return false;"> <img src="<?php print $theme_path; ?>/client_files/img/icons/facebook.svg" alt="facebook icon" class="tertiary-icon-links__img"> <span class="tertiary-icon-links__span">Facebook</span> </a>   
               </li>   
           </ul>
        </aside>
      <?php endif; ?>
    </div> <!-- /.outer-container-pt -->

  

<footer class="site-footer">
  <div class="outer-container">

    <div class="site-footer__icon-grid">
      <a class="site-footer__icon" href="https://www.facebook.com/ServiceMaster"><img src="<?php print $theme_path; ?>/client_files/img/icons/footer-facebook-icn.svg" alt="facebook icon"></a>
      <a class="site-footer__icon" href="https://twitter.com/ServiceMaster"><img src="<?php print $theme_path; ?>/client_files/img/icons/footer-twitter-icn.svg" alt="twitter icon"></a>
      <a class="site-footer__icon" href="https://www.linkedin.com/company/servicemaster"><img src="<?php print $theme_path; ?>/client_files/img/icons/footer-linkedin-icn.svg" alt="linkedin icon"></a>
      <a class="site-footer__icon" href="https://www.youtube.com/user/ServiceMasterVideos"><img src="<?php print $theme_path; ?>/client_files/img/icons/footer-youtube-icn.svg" alt="youtube icon"></a>
    </div>

    <nav class="site-footer__nav">
      <a class="site-footer__links" href="http://servicemaster.com/company/about/">About</a>
      <a class="site-footer__links" href="http://servicemaster.com/contact-us/">Contact</a>
      <a class="site-footer__links" href="http://servicemaster.com/careers/">Find Jobs</a>
      <a class="site-footer__links" href="http://www.ownafranchise.com">Franchising</a>
    </nav>

    <p class="site-footer__copyright">
      © <?php echo date('Y')?> The ServiceMaster Company, LLC. All rights reserved.

       <a class="site-footer__links" href="http://servicemaster.com/terms-of-use">Terms of Use</a> <a class="site-footer__links" href="http://servicemaster.com/privacy-policy">Privacy Policy</a>
    </p>

    <div id="bw_tag"><a href="http://www.businesswire.com/portal/site/home/ir-sites/" target="_blank">Business Wire InvestorHQ<sup>sm</sup></a></div>

  </div>

</footer>


      <!-- <div class="cd-overlay"></div> -->

<nav class="cd-nav" role="navigation">
  <ul id="cd-primary-nav" class="cd-primary-nav is-fixed">

    <li class="has-children top-level-link">  <!-- company -->
      <a class="close-submenu-block close-submenu hide-on-mobile"></a>
      <a class="company-link" href="http://servicemaster.com/company/">Company</a>

      <ul class="cd-secondary-nav background-override is-hidden company-submenu submenu">
        <li class="go-back"><a href="#">Back to Main Menu</a></li>
        <li class="hide-on-desktop"><a href="http://servicemaster.com/company/">Overview</a></li>

        <li class="has-children">
          <a href="http://servicemaster.com/company/about">About</a>
          <ul class="is-hidden">
            <li class="go-back"><a href="#">Back to Company</a></li>
            <li class="hide-on-desktop"><a href="http://servicemaster.com/company/about/">Overview</a></li>
            <li><a href="http://servicemaster.com/company/about/vision">Vision</a></li>
            <li><a href="http://servicemaster.com/company/about/history">History</a></li>
            <li><a href="http://servicemaster.com/company/about/corporate-governance">Corporate <br> Governance</a></li>
          </ul>
        </li>

        <li class="has-children">
          <a href="http://servicemaster.com/company/our-brands">Our Brands</a>
          <ul class="is-hidden">
            <li class="go-back"><a href="#">Back to Company</a></li>
            <li class="hide-on-desktop"><a href="http://servicemaster.com/company/our-brands">Overview</a></li>
            <li><a href="http://servicemaster.com/company/our-brands/american-home-shield">American Home Shield</a></li>
            <li><a href="http://servicemaster.com/company/our-brands/amerispec">AmeriSpec</a></li>
            <li><a href="http://servicemaster.com/company/our-brands/furniture-medic">Furniture Medic</a></li>
            <li><a href="http://servicemaster.com/company/our-brands/merry-maids">Merry Maids</a></li>
            <li><a href="http://servicemaster.com/company/our-brands/servicemaster-clean">ServiceMaster Clean</a></li>
            <li><a href="http://servicemaster.com/company/our-brands/servicemaster-restore">ServiceMaster Restore</a></li>
            <li><a href="http://servicemaster.com/company/our-brands/terminix">Terminix</a></li>
          </ul>
        </li>

        <li class="has-children">
          <a href="http://servicemaster.com/company/community">Community</a>
          <ul class="is-hidden">
            <li class="go-back"><a href="#">Back to Company</a></li>
            <li class="hide-on-desktop"><a href="http://servicemaster.com/company/community">Overview</a></li>
            <li><a href="http://servicemaster.com/company/community/diversity">Diversity</a></li>
            <li><a href="http://servicemaster.com/company/community/giving">Giving</a></li>
            <li><a href="http://servicemaster.com/company/community/environment">Environment</a></li>
            <li><a href="http://servicemaster.com/company/community/we-serve">We Serve</a></li>
          </ul>
        </li>

        <li><a href="http://servicemaster.com/company/insights">Insights</a></li>

        <li class="has-children">
          <a href="http://mediacenter.servicemaster.com/">News Room</a>
          <ul class="is-hidden">
            <li class="go-back"><a href="#">Back to Company</a></li>
            <li class="hide-on-desktop"><a href="http://servicemaster.com/news-room/">Overview</a></li>
            <li><a href="http://mediacenter.servicemaster.com/News-Archives">News Archives</a></li>
            <li><a href="http://mediacenter.servicemaster.com/Audio-Archives">Audio Archives</a></li>
            <li><a href="http://mediacenter.servicemaster.com/Video-Archives">Video Archives</a></li>
            <li><a href="http://mediacenter.servicemaster.com/Brand-Assets">Brand Assets</a></li>
          </ul>
        </li>

      </ul>
    </li>  <!-- end -->

    <li class="has-children top-level-link"> <!-- careers -->
      <a href="http://servicemaster.com/careers">Careers</a>

      <ul class="cd-secondary-nav background-override is-hidden careers-submenu submenu">
        <li class="go-back"><a href="#">Back to Main Menu</a></li>
        <li class="top-submenu-links hide-on-desktop"><a href="http://www.servicemaster.com/careers/">Overview</a></li>
        <li class="top-submenu-links"><a href="http://jobs.servicemaster.com/">Find Jobs</a></li>
        <li class="top-submenu-links"><a href="http://servicemaster.com/careers/university-recruits">University Recruits</a></li>
        <li class="top-submenu-links"><a href="http://servicemaster.com/careers/career-benefits">Career Benefits</a></li>
        <li class="top-submenu-links"><a href="http://servicemaster.com/company/community">Community</a></li>
      </ul>

    </li> <!-- end -->

    <li class="has-children top-level-link"> <!-- investors -->
      <a href="/" class="active">Investors</a>
      <?php 
        $primary_links_full_tree = menu_tree_page_data('primary-links'); // or use menu_tree_all_data('primary-links') to show sub navs on all pages, useful for mobile
        print ( isset($primary_links_full_tree) ? servicemaster_investorhq_2016_custom_primary_links($primary_links_full_tree) : '');
      ?>
    </li> <!-- end  -->

    <li class="top-level-link close-submenu"> <!-- franchies -->
      <a href="http://servicemaster.com/franchises">Franchising</a>
    </li> <!-- end  -->

    <li class="top-level-link">  <!-- experience -->
      <a href="http://servicemaster.com/experience">Experience</a>
    </li> <!-- end -->

  </ul> <!-- primary-nav -->
</nav> <!-- cd-nav -->


</div> <!-- cd-main-content -->

  <!-- DO NOT REMOVE -->
  <?php print $sharing_body ?>
  <?php print $closure; ?>
  <!-- END DO NOT REMOVE -->
</body>
</html>