


    @if ($google_analytics_code =  app(\App\Settings\Site::class)->google_analytics_code)
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script  async src="https://www.googletagmanager.com/gtag/js?id={{ $google_analytics_code }}" ></script>
        <script >
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', "{{ $google_analytics_code}}");
        </script>
        <!-- End Global site tag (gtag.js) - Google Analytics -->
    @endif


