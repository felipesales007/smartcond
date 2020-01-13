<script>
    $(function () {
        let verify = null;

        let stopInterval = setInterval(function () {
            charts.init();
        }, 10000);

        let charts = {
            init: function () {
                this.charts();
            },
            charts: function () {
                let request = $.ajax({
                    method: 'get',
                    url: '{{ app('router')->has('condominium.service.data') ? route('condominium.service.data') : url('/') }}'
                });
                request.done(function (data) {
                    // se houver erro
                    if (data.align && data.from) {
                        $('.fe-statistics').addClass('d-none');
                        clearTimeout(stopInterval);
                        notify(data);
                    } else {
                        try {
                            let response = JSON.stringify(data);

                            JSON.parse(response);
                            $('.fe-statistics').removeClass('d-none');

                            if (verify !== response) {
                                verify = response;

                                // cards
                                $('#getCountCondominiumServices').html(data.counts.getCount);
                                $('#getCountDeletedCondominiumServices').html(data.counts.getCountDeleted);
                            }

                            return true;
                        } catch (e) {
                            $('.fe-statistics').addClass('d-none');
                            clearTimeout(stopInterval);

                            return false;
                        }
                    }
                });
            }
        };

        charts.init();
    });
</script>
