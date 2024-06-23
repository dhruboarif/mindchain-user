<script src="{{asset('assetsnew/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="{{asset('assetsnew/js/bootstrap.min.js')}}"></script>
    <!-- wow JS
		============================================ -->
    <script src="{{asset('assetsnew/js/wow.min.js')}}"></script>
    <!-- price-slider JS
		============================================ -->
        
	<script src="{{asset('assetsnew/js/countdown-timer.js')}}"></script>
    <!-- Timer counter js file
    ============================================ -->
    <script src="{{asset('assetsnew/js/jquery-price-slider.js')}}"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="{{asset('assetsnew/js/jquery.meanmenu.js')}}"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="{{asset('assetsnew/js/owl.carousel.min.js')}}"></script>
    <!-- sticky JS
		============================================ -->
    <script src="{{asset('assetsnew/js/jquery.sticky.js')}}"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="{{asset('assetsnew/js/jquery.scrollUp.min.js')}}"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="{{asset('assetsnew/js/scrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{asset('assetsnew/js/scrollbar/mCustomScrollbar-active.js')}}"></script>
    <!-- metisMenu JS
		============================================ -->
    <script src="{{asset('assetsnew/js/metisMenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('assetsnew/js/metisMenu/metisMenu-active.js')}}"></script>
    <!-- sparkline JS
		============================================ -->
    <script src="{{asset('assetsnew/js/sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('assetsnew/js/sparkline/jquery.charts-sparkline.js')}}"></script>
    <!-- calendar JS
		============================================ -->
    <script src="{{asset('assetsnew/js/calendar/moment.min.js')}}"></script>
    <script src="{{asset('assetsnew/js/calendar/fullcalendar.min.js')}}"></script>
    <script src="{{asset('assetsnew/js/calendar/fullcalendar-active.js')}}"></script>
	<!-- float JS
		============================================ -->
    <script src="{{asset('assetsnew/js/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('assetsnew/js/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('assetsnew/js/flot/curvedLines.js')}}"></script>
    <script src="{{asset('assetsnew/js/flot/flot-active.js')}}"></script>
    <!-- plugins JS
		============================================ -->
    <script src="{{asset('assetsnew/js/plugins.js')}}"></script>
    <!-- main JS
		============================================ -->
    <script src="{{asset('assetsnew/js/main.js')}}"></script>

    <!-- Backend Bundle JavaScript -->
<script src="{{asset('assets/js/libs.min.js')}}"></script>

    <script>
        $('.moreless-button').click(function () {
            $('.moretext').slideToggle();
            if ($('.moreless-button').text() == "Load more") {
                $(this).text("Load less")
            } else {
                $(this).text("Load more")
            }
        });
    </script>




<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
$(document).ready( function () {
    $('#myTable1').DataTable();
} );
$(document).ready( function () {
    $('#myTable2').DataTable();
} );
$(document).ready( function () {
    $('#myTable3').DataTable();
} );
$(document).ready( function () {
    $('#myTable4').DataTable();
} );

</script>

@stack('scripts')
