  <!-- Essential javascripts for application to work-->
    <script src="{{asset('assets/js/jquery-3.7.0.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('assets/js/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/5epz8yj0x21yr44syk7fxgqd36mxwxpd9o14y1hnkwbe8gnb/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript">
      tinymce.init({
        selector: '#myTextarea',
        toolbar_sticky: true,
        autosave_ask_before_unload: true,
        autosave_interval: '30s',
        autosave_prefix: '{path}{query}-{id}-',
        autosave_restore_when_empty: false,
        autosave_retention: '2m',
        image_advtab: true,
        height:'300px',

      });
    </script>
   

    <!-- Page specific javascripts-->
    <script>
      // Enable all alerts on the page
      const alertList = document.querySelectorAll('.alert');
      const alerts = [...alertList].map(element => new bootstrap.Alert(element));
      
      // Enable all popovers on the page
      const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
      const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));
      
      // Enable all tooltips on the page
      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
      const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    </script>
    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-72504830-1', 'auto');
        ga('send', 'pageview');
      }
    </script>
    <script type="text/javascript">$('.selectpicker').select2();</script>
  </body>
</html>