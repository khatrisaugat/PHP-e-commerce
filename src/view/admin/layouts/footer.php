<!--footer start-->
</div>
</section>
</section>
<!--main content end-->


</section>
<!-- js placed at the end of the document so the pages load faster -->
<script src="<?=$baseUrl?>/assets/lib/jquery/jquery.min.js"></script>

<script src="<?=$baseUrl?>/assets/lib/bootstrap/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="<?=$baseUrl?>/assets/lib/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?=$baseUrl?>/assets/lib/jquery.scrollTo.min.js"></script>
<script src="<?=$baseUrl?>/assets/lib/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?=$baseUrl?>/assets/lib/jquery.sparkline.js"></script>
<!--common script for all pages-->
<script src="<?=$baseUrl?>/assets/lib/common-scripts.js"></script>
<script type="text/javascript" src="<?=$baseUrl?>/assets/lib/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="<?=$baseUrl?>/assets/lib/gritter-conf.js"></script>
<!--script for this page-->
<script src="<?=$baseUrl?>/assets/lib/sparkline-chart.js"></script>
<script src="<?=$baseUrl?>/assets/lib/zabuto_calendar.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    var unique_id = $.gritter.add({
      // (string | mandatory) the heading of the notification
      title: 'Welcome to Admin Panel!',
      // (string | mandatory) the text inside the notification
      text: 'Edit information for the site here',
      // (string | optional) the image to display on the left
      // (bool | optional) if you want it to fade out on its own or just sit there
      sticky: false,
      // (int | optional) the time you want it to be alive for before fading out
      time: 8000,
      // (string | optional) the class name you want to apply to that specific message
      class_name: 'my-sticky-class'
    });

    return false;
  });
</script>
<script type="application/javascript">
  $(document).ready(function() {
    $("#date-popover").popover({
      html: true,
      trigger: "manual"
    });
    $("#date-popover").hide();
    $("#date-popover").click(function(e) {
      $(this).hide();
    });

    $("#my-calendar").zabuto_calendar({
      action: function() {
        return myDateFunction(this.id, false);
      },
      action_nav: function() {
        return myNavFunction(this.id);
      },
      ajax: {
        url: "show_data.php?action=1",
        modal: true
      },
      legend: [{
          type: "text",
          label: "Special event",
          badge: "00"
        },
        {
          type: "block",
          label: "Regular event",
        }
      ]
    });
  });

  function myNavFunction(id) {
    $("#date-popover").hide();
    var nav = $("#" + id).data("navigation");
    var to = $("#" + id).data("to");
    console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
  }
</script>
<script>
  $(document).ready(function() {

    setTimeout(function() {
      $('.alert').hide('slow')
    }, 3000);
  })
</script>



<style>
  .size {
    height: 60px;
    width: 60px;
  }
</style>
</body>

</html>
<style>
  body {
    background-color: #fcfcfa;
  }
</style>
<!--footer end-->