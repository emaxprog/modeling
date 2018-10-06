google.charts.load('current', {packages: ['corechart', 'bar']});

function drawStatisticRange(data) {
    let dataTable = new google.visualization.DataTable();
    dataTable.addColumn('string', 'Границы интервалов');
    dataTable.addColumn('number', 'Частота');
    dataTable.addRows(data);
    let options = {
        title: 'Гистограмма статистического ряда',
        hAxis: {
            title: 'Интервал'
        },
        vAxis: {
            title: 'Частота'
        }
    };

    let chart = new google.visualization.ColumnChart(document.getElementById('statistic-range-chart'));
    chart.draw(dataTable, options);
}

function drawStatisticFunction(data) {
    let dataTable = new google.visualization.DataTable();
    dataTable.addColumn('string', 'Значение случайной величины');
    dataTable.addColumn('number', 'Значение функции');
    dataTable.addRows(data);
    let options = {
        title: 'Статистическая функция',
        vAxis: {
            title: 'Значение функции'
        },
        hAxis: {
            title: 'Значение случайной величины'
        },
        curveType: 'function',
    };

    let chart = new google.visualization.LineChart(document.getElementById('statistic-function-chart'));
    chart.draw(dataTable, options);
}

function clearAlerts() {
    $('.alert').remove();
}

function getInputField() {
    return `<div class="form-group"><div class="col-md-10"><input type="number" name="values[]" class="form-control" required></div><div class="col-md-2"><button type="button" class="btn btn-danger delete-value"><span class="glyphicon glyphicon-trash"></span></button></div></div>`;
}

$(document).ready(function () {
    let randomValueForm = $('#random-value-form');
    let addValueButton = randomValueForm.find('.add-value');
    let formContainer = randomValueForm.find('.form-container');
    addValueButton.click(function () {
        formContainer.append(getInputField());
    });
    $(document).on('click', '.delete-value', function () {
        $(this).closest('.form-group').remove();
    });


    $submitBtn = $('form .btn');
    $chartContainer = $('.chart__container');
    $('form').submit(function (e) {
        e.preventDefault();
        clearAlerts();
        $submitBtn.button('loading');
        let form = $(this),
            formAction = form.attr('action'),
            formData = new FormData(form[0]),
            formMethod = 'POST';
        $.ajax({
            type: formMethod,
            url: formAction,
            data: formData,
            contentType: false,
            processData: false,
            success: function (result) {
                let statisticRangeData = [];
                let statisticFunctionData = [];
                $.each(result['statisticRange'], function (index, value) {
                    statisticRangeData.push([index, value]);
                });
                $.each(result['statisticFunction'], function (index, value) {
                    statisticFunctionData.push([index, value]);
                });
                $submitBtn.button('reset');
                $chartContainer.show();
                google.charts.setOnLoadCallback(drawStatisticRange(statisticRangeData));
                google.charts.setOnLoadCallback(drawStatisticFunction(statisticFunctionData));
            },
            error: function (msg) {
                let error = msg.responseJSON.error;
                if (error) {
                    $('form .form-container').after(`<div class="alert alert-danger" role="alert">${error}</div>`);
                }
                $submitBtn.button('reset');
            }
        });
        return false;
    });

});