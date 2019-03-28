$(document).ready(function(){
    $('#start').on('change', function(){

        let start_date = $(this).val();
        let company = $('#company').val();
        $.ajax({
            method:'POST',
            dataType:'json',
            url: 'http://admin.gerox.x10host.com/sumrep',
            data: {
                sd : start_date,
                company: company
            },
            success: function(d){
                $('#rep-text').html(d.total);
                $('#expense-text').html(d.expense);
                $('#net-text').html(d.net);
                let label = 'Gross Income';
                let ctx = $('#myChart');
                let ctx1 = $('#myChart1');
                let ctx2 = $('#myChart2');
                let dn = []; //DATE NEEDED
                let ec= [] ; //NET OF EACH DATE;

                        
                $.each(d.dateGross, function(i,v){
                    dn.push(moment(v).format('LL'));
                });

                var reportsChart = new Chart(ctx, {
                    type: 'line',  
                    data: {
                        labels: dn,
                        datasets: [{
                            label:'Gross Income', 
                            data:  d.eachdate, 
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.2)',
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                            ],
                            fill: true,
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: { 
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                },
                            }]
                        }
                    }

                });

                var repChart1 = new Chart(ctx1, {
                    type: 'line',
                    data: {
                        labels: moment.months(),
                        datasets: [{
                            label: 'Gross Income',
                            data: d.monthlyGross, 
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.2)',
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                            ],
                            fill: true,
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
        
                });

                var repChart2 = new Chart(ctx2, {
                    type: 'line',
                    data: {
                        labels: data.yearLabel,
                        datasets: [{
                            label: 'Gross Income',
                            data: d.yearlyGross, 
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.2)',
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                            ],
                            fill: true,
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
        
                });

            }
        });
    });

    $('#company').on('change', function(){

        let start_date = $('#start').val();
        let company = $(this).val();
        $.ajax({
            method:'POST',
            dataType:'json',
            url: 'http://admin.gerox.x10host.com/sumrep',
            data: {
                sd : start_date,
                company: company
            },
            success: function(d){
                $('#rep-text').html(d.total);
                $('#expense-text').html(d.expense);
                $('#net-text').html(d.net);
                let label = 'Gross Income';
                let ctx = $('#myChart');
                let ctx1 = $('#myChart1');
                let ctx2 = $('#myChart2');
                let dn = []; //DATE NEEDED
                let ec= [] ; //NET OF EACH DATE;

                        
                $.each(d.dateGross, function(i,v){
                    dn.push(moment(v).format('LL'));
                });

                var reportsChart = new Chart(ctx, {
                    type: 'line',  
                    data: {
                        labels: dn,
                        datasets: [{
                            label:'Gross Income', 
                            data:  d.eachdate, 
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.2)',
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                            ],
                            fill: true,
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: { 
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                },
                            }]
                        }
                    }

                });

                var repChart1 = new Chart(ctx1, {
                    type: 'line',
                    data: {
                        labels: moment.months(),
                        datasets: [{
                            label: 'Gross Income',
                            data: d.monthlyGross, 
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.2)',
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                            ],
                            fill: true,
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
        
                });

                var repChart2 = new Chart(ctx2, {
                    type: 'line',
                    data: {
                        labels: d.yearLabel,
                        datasets: [{
                            label: 'Gross Income',
                            data: d.yearlyGross, 
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.2)',
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                            ],
                            fill: true,
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
        
                });

            }
        });
    });

    var sd = ()=> {
        let d = moment();
        let sdate = d.format('YYYY-MM');
        $('#start').val(sdate);
        return sdate;
    }
    $.post('http://admin.gerox.x10host.com/sumrep', {sd : sd} , function(result){
        let data = JSON.parse(result);
        let ctx = $('#myChart');
        let ctx1 = $('#myChart1');
        let ctx2 = $('#myChart2');
        let dn = []; //DATE NEEDED
        let ec= [] ; //NET OF EACH DATE;
        $('#rep-text').html(data.total);
        $('#expense-text').html(data.expense);
        $('#net-text').html(data.net);
        
        $.each(data.dateGross, function(i,v){
            dn.push(moment(v).format('LL'));
        });

        var repChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dn,
                datasets: [{
                    label: 'Gross Income',
                    data: data.eachdate, 
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                    ],
                    fill: true,
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });

        var repChart1 = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: moment.months(),
                datasets: [{
                    label: 'Gross Income',
                    data: data.monthlyGross, 
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                    ],
                    fill: true,
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }

        });

        var repChart2 = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: data.yearLabel,
                datasets: [{
                    label: 'Gross Income',
                    data: data.yearlyGross, 
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                    ],
                    fill: true,
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }

        });

    });
});