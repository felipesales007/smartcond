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
                    url: '{{ app('router')->has('user.data') ? route('user.data') : url('/') }}'
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
                                $('#getCountUsers').html(data.counts.getCount);
                                $('#getCountConfirmationUsers').html(data.counts.getCountConfirmation);
                                $('#getCountNotConfirmationUsers').html(data.counts.getCountNotConfirmation);
                                $('#getCountBlockedUsers').html(data.counts.getCountBlocked);

                                // evolutionary
                                if (document.querySelector('#users-evolutionary')) {
                                    charts.evolutionary(data);
                                }

                                // status
                                if (document.querySelector('#users-status')) {
                                    charts.status(data);
                                }

                                // genders
                                if (document.querySelector('#users-genders')) {
                                    charts.genders(data);
                                }
                            }

                            return true;
                        } catch (e) {
                            $('.fe-statistics').addClass('d-none');
                            clearTimeout(stopInterval);

                            return false;
                        }
                    }
                });
            },
            evolutionary: function (data) {
                let ctx = $('#users-evolutionary');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data.added.months,
                        datasets: [{
                            label: 'adicionados',
                            lineTension: 0.3,
                            backgroundColor: Charts.colors.theme.success_t,
                            borderColor: Charts.colors.theme.success,
                            pointRadius: 5,
                            pointBackgroundColor: Charts.colors.theme.success,
                            pointBorderColor: Charts.colors.theme.white,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: Charts.colors.theme.success,
                            pointHitRadius: 20,
                            pointBorderWidth: 2,
                            data: data.added.count_months
                        }],
                    },
                    options: {
                        scales: {
                            xAxes: {
                                gridLines: {
                                    display: false
                                }
                            }
                        },
                        legend: {
                            display: true
                        }
                    }
                });
            },
            status: function (data) {
                let ctx = $('#users-status');
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Total', 'Confirmados', 'Pendentes', 'Bloqueados'],
                        datasets: [{
                            data: [data.counts.getCount, data.counts.getCountConfirmation, data.counts.getCountNotConfirmation, data.counts.getCountBlocked],
                            backgroundColor: [Charts.colors.theme.success, Charts.colors.theme.info, Charts.colors.theme.warning, Charts.colors.theme.danger],
                            borderWidth: 3,
                            hoverBorderColor: Charts.colors.theme.white,
                            hoverBorderWidth: 3
                        }],
                    },
                    options: {
                        legend: {
                            display: true
                        }
                    }
                });
            },
            genders: function (data) {
                let ctx = $('#users-genders');
                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: data.genders.names,
                        datasets: [{
                            data: data.genders.count,
                            backgroundColor: [Charts.colors.theme.secondary, Charts.colors.theme.info, Charts.colors.theme.pink, Charts.colors.theme.yellow],
                            borderWidth: 3,
                            hoverBorderColor: Charts.colors.theme.white,
                            hoverBorderWidth: 3
                        }],
                    },
                    options: {
                        legend: {
                            display: true
                        }
                    }
                });
            }
        };

        charts.init();
    });
</script>
