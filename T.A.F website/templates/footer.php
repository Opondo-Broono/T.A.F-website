<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package EpicSF
 * @since EpicSF 1.0
 */
?>
      <div class='push'></div>
    </div><!-- .site-content -->

    <footer id="footer" class="site-footer">
      <nav class="navbar container-fluid">
        <a href="/"><img src="/wp-content/uploads/2020/05/logo-black.svg" alt="Epic homepage" /></a>
        <div class="row">
        <?php if ( has_nav_menu( 'footer-watch' ) ) : ?>
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <strong>Watch</strong>
            <div aria-label="<?php esc_attr_e( 'Footer Watch Menu', 'epic' ); ?>">
              <?php
                wp_nav_menu( array(
                  'theme_location' => 'footer-watch',
                  'menu_class'     => 'nav navbar-nav',
                 ) );
              ?>
            </div>
          </div>
        <?php endif; ?>
        <?php if ( has_nav_menu( 'footer-connect' ) ) : ?>
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <strong>Connect</strong>
            <div aria-label="<?php esc_attr_e( 'Footer Connect Menu', 'epic' ); ?>">
              <?php
                wp_nav_menu( array(
                  'theme_location' => 'footer-connect',
                  'menu_class'     => 'nav navbar-nav',
                 ) );
              ?>
            </div>
          </div>
        <?php endif; ?>
        <?php if ( has_nav_menu( 'footer-give' ) ) : ?>
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <strong>Give</strong>
            <div aria-label="<?php esc_attr_e( 'Footer Give Menu', 'epic' ); ?>">
              <?php
                wp_nav_menu( array(
                  'theme_location' => 'footer-give',
                  'menu_class'     => 'nav navbar-nav',
                 ) );
              ?>
            </div>
          </div>
        <?php endif; ?>
        <?php if ( has_nav_menu( 'footer-social' ) ) : ?>
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 social-links">
            <div aria-label="<?php esc_attr_e( 'Footer Social Menu', 'epic' ); ?>">
              <?php
                wp_nav_menu( array(
                  'theme_location' => 'footer-social',
                  'menu_class'     => 'nav navbar-nav',
                 ) );
              ?>
            </div>
          </div>
        <?php endif; ?>
        </div> <!-- .row -->
      </nav>
      <div class="site-info">
      </div><!-- .site-info -->
    </footer><!-- .site-footer -->
  </div><!-- .site-inner -->
</div><!-- .site -->

<?php wp_footer(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script async src="https://player.vimeo.com/api/player.js"></script>
<script>window.Tether = {};</script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
<script>
$('.carousel').carousel({interval: 10000});
$('#prayerModal').on('show.bs.modal', function(e) {
  var button = $(e.relatedTarget);
  var post = button.parents('.forty-day');
  var title = post.find('.title-2');
  var body = post.find('.forty-day-content');
  var modal = $(this);
  modal.find('#prayerModalLabel').html(title.text());
  modal.find('.modal-body').html(body.html());
});
jQuery(function() {
  if (window.location
    && window.location.pathname.indexOf('2020-prayer-guide') > -1
    && window.location.hash.length > 1) {
    var id = window.location.hash.slice(1);
    setTimeout(function() {
      document.querySelector('[data-id="' + id + '"]').scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
      setTimeout(function() {
        document.querySelector('[data-id="' + id + '"] a').click();
      }, 400);
    }, 600);
  }
});
</script>
<script>
    jQuery(function() {
    var days, goLive, hours, intervalId, minutes, seconds;

    // Your churchonline.org url
    var churchUrl = "https://epicsf.churchonline.org"

    goLive = function() {
      if (!intervalId) {
        $('#churchonline_counter').fadeTo('slow', 1);
      }
      $("#churchonline_counter .countdown").hide();
      $("#churchonline_counter .msg").hide();
      $("#churchonline_counter .live").show();
    };
    var loadCountdown = function(data){
      var secondsTill, date, dateString;
      if (data.response.item.isLive) {
        return goLive();
      } else {
        // Parse ISO 8601 date string
        date = data.response.item.eventStartTime.match(/^(\d{4})-0?(\d+)-0?(\d+)[T ]0?(\d+):0?(\d+):0?(\d+)Z$/)
        dateString = date[2] + "/" + date[3] + "/" + date[1] + " " + date[4] + ":" + date[5] + ":" + date[6] + " +0000"

        function updateTime() {
          secondsTill = ((new Date(dateString)) - (new Date())) / 1000;
          days = Math.floor(secondsTill / 86400);
          hours = Math.floor((secondsTill % 86400) / 3600);
          minutes = Math.floor((secondsTill % 3600) / 60);
          seconds = Math.floor(secondsTill % 60);

          if (--seconds < 0) {
            seconds = 59;
            if (--minutes < 0) {
              minutes = 59;
              if (--hours < 0) {
                hours = 23;
                if (--days < 0) {
                  days = 0;
                }
              }
            }
          }
          if (days === 0) {
            $("#churchonline_counter .days").parent().hide();
          } else {
            $("#churchonline_counter .days").html(days);
          }
          $("#churchonline_counter .hours").html((hours.toString().length < 2 ? "0" + hours : hours));
          $("#churchonline_counter .minutes").html((minutes.toString().length < 2 ? "0" + minutes : minutes));

          if (!intervalId) {
            $('#churchonline_counter').fadeTo('slow', 1);
          }

          if (seconds === 0 && minutes === 0 && hours === 0 && days === 0) {
            goLive();
            return clearInterval(intervalId);
          }
        }
        updateTime();
        intervalId = setInterval(updateTime, 30000);
      }
    }
    days = void 0;
    hours = void 0;
    minutes = void 0;
    seconds = void 0;
    intervalId = void 0;
    eventUrl = churchUrl + "/api/v1/events/current"
    msie = /msie/.test(navigator.userAgent.toLowerCase())
    if (msie && window.XDomainRequest) {
        var xdr = new XDomainRequest();
        xdr.open("get", eventUrl);
        xdr.onload = function() {
          loadCountdown(jQuery.parseJSON(xdr.responseText))
        };
        xdr.send();
    } else {
      $.ajax({
        url: eventUrl,
        dataType: "json",
        crossDomain: true,
        success: function(data) {
          loadCountdown(data);
        },
        error: function(xhr, ajaxOptions, thrownError) {
          goLive();
          return console.log(thrownError);
        }
      });
    }
  });
</script>
</body>
</html>