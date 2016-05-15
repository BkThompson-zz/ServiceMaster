<?php
// $Id: panels-pane.tpl.php,v 1.1.2.1 2009/10/13 21:38:52 merlinofchaos Exp $
/**
 * @file panels-pane.tpl.php
 * Main panel pane template
 *
 * Variables available:
 * - $pane->type: the content type inside this pane
 * - $pane->subtype: The subtype, if applicable. If a view it will be the
 *   view name; if a node it will be the nid, etc.
 * - $title: The title of the content
 * - $content: The actual content
 * - $links: Any links associated with the content
 * - $more: An optional 'more' link (destination only)
 * - $admin_links: Administrative links associated with the content
 * - $feeds: Any feed icons or associated with the content
 * - $display: The complete panels display object containing all kinds of
 *   data including the contexts and all of the other panes being displayed.
 */
?>
<section class="<?php print $classes; ?>" <?php print $id; ?>>
  <?php echo '<!-- '. $pane->subtype .' -->'; ?>
  <?php if ($admin_links): ?>
    <div class="admin-links panel-hide">
      <?php print $admin_links; ?>
    </div>
  <?php endif; ?>
  <?php if ($title == 'Download' || $title == 'Download:'): ?>
    <h1 class="pane-title download-label"><?php print $title; ?></h1>
  <?php elseif ($title): ?>
    <h1<?php print ($pane->subtype == "bw_press_release-panel_pane_7" ? ' class="halfsies"' : '');  ?>><?php /* class="pane-title" */ ?>
      <?php print $title; ?>
      <?php if ($rss_icon): ?>
        <span class="rss-icon"><?php print $rss_icon; ?></span>
      <?php endif; ?>
    </h1>
  <?php endif; ?>

  <?php 
    if ($pane->subtype == "bw_press_release-panel_pane_7") {
  ?>
  <ul class="social-icons halfsies">
    <li class="social-icons__li">
      <a class="social-icons__a" href="https://www.facebook.com/ServiceMaster">
        <img src="<?php print $base_path . $directory; ?>/client_files/img/icons/facebook--white.svg" alt="facebook icon">
      </a>
    </li>
    <li class="social-icons__li">
      <a class="social-icons__a" href="https://twitter.com/ServiceMaster">
        <img src="<?php print $base_path . $directory; ?>/client_files/img/icons/twitter--white.svg" alt="twitter icon">
      </a>
    </li>
    <li class="social-icons__li">
      <a class="social-icons__a" href="https://www.linkedin.com/company/servicemaster">
        <img src="<?php print $base_path . $directory; ?>/client_files/img/icons/linkedin--white.svg" alt="linkedin icon">
      </a>
    </li>
    <li class="social-icons__li">
      <a class="social-icons__a" href="https://www.youtube.com/user/ServiceMasterVideos">
        <img src="<?php print $base_path . $directory; ?>/client_files/img/icons/youtube--white.svg" alt="youtube icon">
      </a>
    </li>
  </ul>

  <?php 
    }
  ?>
    
  <?php if ($feeds): ?>
    <div class="feed">
      <?php print $feeds; ?>
    </div>
  <?php endif; ?>

  <div class="pane-content">
    <?php print $content; ?>
  </div>

  <?php if ($links): ?>
    <div class="links">
      <?php print $links; ?>
    </div>
  <?php endif; ?>

  <?php if ($more): ?>
    <div class="more-link">
      <?php print $more; ?>
    </div>
  <?php endif; ?>
</section>
