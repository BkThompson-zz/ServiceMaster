/* BW JS starting template for JS / JQuery customizations. All customizations will be stored in the BW_JS object - modify as needed */
window.BW_JS = { wceinit:function(){ var c=document.getElementsByTagName("body")[0].className,p,f,t=c.match(/node-type-(\S+)/i);if(!t){t=c.match(/-in\spage-(\S+)/i);if(t)p=t[1]}else{p='node-type-'+t[1]}

//Customization for all pages here


// Adding class to Contact- Shareholder services page
switch (window.location.pathname) {

    case "/webform/contact-shareholder-services":
    $(".node-type-webform").addClass("contact-shareholder-services");
 
}


// $(document).ready(function() {

   // Adding text to Shareholder Services submit to "Submit Form"
   $(".contact-shareholder-services #edit-submit").val("Submit Form");

   // Removing text from Events Page PDF links, only text is "Presentation"
   $(".page-events-calendar .view-id-bw_event .filefield-file a").text("Presentation");


   // Changing text on node-type events
   $(".node-type-event  .bw-multizone-date span").text("Starts");
   $(".node-type-event  .bw-multizone-date + .bw-multizone-date  span").text("Finish");
   $(".node-type-event  .bw-multizone-date + .bw-multizone-date + .bw-multizone-date span").text("Duration");

   // Changing text on Financial Press Release pager to "Older"
   //$(".page-press-releases .pager li.pager-current").text("Older");

   // Financial Reports Page - Changing text
   $(".page-financial-reports .views-field-teaser tbody tr > td a ").text("Press Release");
   $(".page-financial-reports .views-field-teaser tbody tr + tr > td a ").text("Presentation");
   $(".page-financial-reports .views-field-teaser tbody tr + tr + tr > td a ").text("Webcast");

   // Annual Reports Page - Changing text
   $(".page-annual-reports .views-field-title a ").text("2014 Annual Report");


   // Changing order or node date on press release nodes
   $(".node-type-press-release .pane-node-date ").after($(".node-type-press-release .field-field-press-release-subheadline ul"));

  // empty pager item styling
  $('.pager li').each(function(){
    $(this).html($(this).html().replace(/&nbsp;/g, ''));
  });

  // Adding active class to Financial News Articles and Event Posting 
  $(".node-type-press-release .aside-secondary ul.menu li:nth-child(3) a ").addClass("active");
  $(".node-type-event .aside-secondary ul.menu li:nth-child(7) a").addClass("active");

// });

   // Search Place Holder
  $('input:text').each(
    function(i,el) {
        if (!el.value || el.value == '') {
            el.placeholder = 'Search';
            /* or:
            el.placeholder = $('label[for=' + el.id + ']').text();
            */
        }
    });

  // Open social media icons in new window
  $(".aside-tertiary a, img [href^='http://']").attr("target","_blank");
  $(".site-footer__icon-grid a, img [href^='http://']").attr("target","_blank");
  $(".social-icons a ,img[href^='http://']").attr("target","_blank");



   // Tables Fix
  (function($, window, document){
    if($('body').hasClass('page-node')) {

        // Tables Fix
        mobileWideTables = function(el) {  
          
          var $elWidth = $(el).width(),
              $tableWidth = 0;

          $(el).find('table').each(function(){
            
            $tableWidth = $(this).width();
          
          $a = $(this).parent('div').hasClass('bw-zoom-table');
          $b = $(this).parent('div').hasClass('bw_mobileWideTables');

            if ($elWidth < $tableWidth ) {
            // console.log($a,' - ', $b);
            
                if ( !$a && !$b ) {

                    // console.log('add the div with class');
                    // if the table is not a zoom table OR if it is not inside another table, add the fix
                    $(this).wrap('<div class="bw_mobileWideTables"></div>');

                } 
            } else { 

                if ( $b ) {
                  //  console.log('replace the table and div (unwrap)');
                  // $(this).parent('div.bw_mobileWideTables').replaceWith($(this));
                  $(this).unwrap('div.bw_mobileWideTables');
                  }
            }
          });
        }

        // Run at load
        mobileWideTables('.page-node .pane-pr-body');

        // Run at resize


        var resizeTimer;
        $(window).resize( function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(mobileWideTables('.page-node .pane-pr-body'), 300);
        });


    }
  })(jQuery110, window, document)

}}; 

$(document).ready(function(){BW_JS.wceinit()});





