
        <!-- ============================================
        ============== Vendor JavaScripts ===============
        ============================================= -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="<?php echo site_url();?>assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="<?php echo site_url();?>assets/js/vendor/bootstrap/bootstrap.min.js"></script>

        <script src="<?php echo site_url();?>assets/js/vendor/jRespond/jRespond.min.js"></script>

        <script src="<?php echo site_url();?>assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

        <script src="<?php echo site_url();?>assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

        <script src="<?php echo site_url();?>assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>

        <script src="<?php echo site_url();?>assets/js/vendor/screenfull/screenfull.min.js"></script>

        <script src="<?php echo site_url();?>assets/js/vendor/parsley/parsley.min.js"></script>
        <!--/ vendor javascripts -->




        <!-- ============================================
        ============== Custom JavaScripts ===============
        ============================================= -->
        <script src="<?php echo site_url();?>assets/js/main.js"></script>
        <!--/ custom javascripts -->

        <!-- ===============================================
        ============== Page Specific Scripts ===============
        ================================================ -->
       

<script>

var alphabeticallyOrderedDivs = $('.refendable11').sort(function(a, b) {
    console.log($(a).data('price'));
    return String.prototype.localeCompare.call($(a).data('price').toLowerCase(), $(b).data('price').toLowerCase());
});

var container = $("#navigation");
container.detach().empty().append(alphabeticallyOrderedDivs);
$('.meus').append(container);

</script>

    </body>
</html>
