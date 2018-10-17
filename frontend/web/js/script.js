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
    dataTable.addColumn('string', 'Номер опыта');
    dataTable.addColumn('number', 'Значение функции');
    dataTable.addRows(data);
    let options = {
        title: 'Статистическая функция',
        vAxis: {
            title: 'Значение функции'
        },
        hAxis: {
            title: 'Номер опыта'
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
    return `<div class="row">
                      <div class="col-md-11">
                        <div class="form-group">
                          <input type="number" name="values[]" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-md-1">
                        <div class="form-group">
                           <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm delete-value">
                                <i class="material-icons">close</i>
                           </button>
                        </div>
                      </div>
                    </div>`;
}


function getLab5Fields() {
    return `<div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="number" name="values[randomValue1][]" class="form-control" required>
                        </div>
                      </div>
                       <div class="col-md-5">
                        <div class="form-group">
                          <input type="number" name="values[randomValue2][]" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-md-1">
                        <div class="form-group">
                           <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm delete-value">
                                <i class="material-icons">close</i>
                           </button>
                        </div>
                      </div>
                    </div>`;
}

function getLab6Fields() {
    return `<div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="number" name="values[randomValue1][]" class="form-control" required>
                        </div>
                      </div>
                       <div class="col-md-4">
                        <div class="form-group">
                          <input type="number" name="values[randomValue2][]" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <input type="number" name="values[randomValue3][]" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-md-1">
                        <div class="form-group">
                           <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm delete-value">
                                <i class="material-icons">close</i>
                           </button>
                        </div>
                      </div>
                    </div>`;
}


$(document).ready(function () {
    let lab1Form = $('#lab1-form');
    let lab4Form = $('#lab4-form');
    let lab5Form = $('#lab5-form');
    let lab6Form = $('#lab6-form');
    let lab4Footer = $('.card-footer .stats');
    let lab5Footer = $('.card-footer .stats');
    let lab6Matrix = $('.matrix');
    let addValueButton = lab1Form.find('.add-value');
    let lab5addValueButton = lab5Form.find('.add-value');
    let lab6addValueButton = lab6Form.find('.add-value');
    let formContainer = lab1Form.find('.form-container');
    let lab5FormContainer = lab5Form.find('.form-container');
    let lab6FormContainer = lab6Form.find('.form-container');
    addValueButton.click(function () {
        formContainer.append(getInputField());
    });
    lab5addValueButton.click(function () {
        lab5FormContainer.append(getLab5Fields());
    });
    lab6addValueButton.click(function () {
        lab6FormContainer.append(getLab6Fields());
    });
    $(document).on('click', '.delete-value', function () {
        $(this).closest('.row').remove();
    });

    $submitBtn = $('form .btn');
    $chartContainer = $('.chart__container');
    lab1Form.submit(function (e) {
        e.preventDefault();
        clearAlerts();
        $(this).find('+.col-md-12').remove();
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
                $chartContainer.before(result['statisticRangeTable']);
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

    lab4Form.submit(function (e) {
        e.preventDefault();
        lab4Footer.html('');
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
                $submitBtn.button('reset');
                lab4Footer.append(`<i class="material-icons">info</i> ${result}`);
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

    lab5Form.submit(function (e) {
        e.preventDefault();
        lab5Footer.html('');
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
                $submitBtn.button('reset');
                lab5Footer.append(`<i class="material-icons">info</i> ${result}`);
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

    lab6Form.submit(function (e) {
        e.preventDefault();
        lab6Matrix.html('');
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
                $submitBtn.button('reset');
                lab6Matrix.append(`${result}`);
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