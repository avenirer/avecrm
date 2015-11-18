<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<footer>
    <div class="container">
        <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
    </div>
</footer>
<script src="<?php echo site_url('assets/js/jquery-2.1.4.min.js');?>"></script>
<script src="<?php echo site_url('assets/js/bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/moment.js');?>"></script>
<script src="<?php echo site_url('assets/js/bootstrap-datetimepicker.min.js');?>"></script>
<?php echo $before_closing_body;?>
<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip();

    $('.datetimepicker').datetimepicker({
      locale: 'en',
      format: 'YYYY-MM-DD HH:mm:ss',
      useCurrent: true,
      sideBySide: true,
      showTodayButton: true
    });
  });
</script>
</body>
</html>