// notificação
function notify(data) {
    let enter;
    let exit;

    if (data.from === 'top') {
        enter = 'fadeInDown';
        exit  = 'fadeOutUp';
    } else {
        enter = 'fadeInUp';
        exit  = 'fadeOutDown';
    }

    $.notify({
        icon: 'alert-icon ' + data.icon,
        title: data.title,
        message: data.message
    }, {
        type: data.type,
        timer: 2000,
        placement: {
            from: data.from,
            align: data.align
        },
        animate: {
            enter: 'animated ' + enter,
            exit: 'animated ' + exit
        },
        template:
            '<div data-notify="container" class="col-xs-11 col-sm-3 alert-dismissible alert-notify alert alert-{0}" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">' +
            '<span aria-hidden="true">&times;</span>' +
            '</button>' +
            '<span data-notify="icon"></span>' +
            '<div class="alert-text">' +
            '<span class="alert-title" data-notify="title">{1}</span>' +
            '<span data-notify="message">{2}</span>' +
            '</div>' +
            '</div>'
    });
}

// notificação de erro
function notifyError(message) {
    $.notify({
        icon: 'alert-icon fas fa-exclamation-triangle',
        title: 'Notificação',
        message: message
    }, {
        type: 'warning',
        timer: 2000,
        placement: {
            from: 'top',
            align: 'center'
        },
        template:
            '<div data-notify="container" class="col-xs-11 col-sm-3 alert-dismissible alert-notify alert alert-{0}" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">' +
            '<span aria-hidden="true">&times;</span>' +
            '</button>' +
            '<span data-notify="icon"></span>' +
            '<div class="alert-text">' +
            '<span class="alert-title" data-notify="title">{1}</span>' +
            '<span data-notify="message">{2}</span>' +
            '</div>' +
            '</div>'
    });
}

// notificação de erro na validação
function notifyValidate(message) {
    $.notify({
        icon: 'alert-icon fas fa-ban',
        title: 'Notificação',
        message: message
    }, {
        type: 'info',
        timer: 2000,
        placement: {
            from: 'bottom',
            align: 'right'
        },
        animate: {
            enter: 'animated fadeInUp',
            exit: 'animated fadeOutDown'
        },
        template:
            '<div data-notify="container" class="col-xs-11 col-sm-3 alert-dismissible alert-notify alert alert-{0}" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">' +
            '<span aria-hidden="true">&times;</span>' +
            '</button>' +
            '<span data-notify="icon"></span>' +
            '<div class="alert-text">' +
            '<span class="alert-title" data-notify="title">{1}</span>' +
            '<span data-notify="message">{2}</span>' +
            '</div>' +
            '</div>'
    });
}

// notificação de bloqueio de grupo
$('.notify-block-group').on('click', function () {
    $.notify({
        icon: 'alert-icon fas fa-ban',
        title: 'Notificação',
        message: 'Grupo bloqueado para acesso.<br><small>Procure o Administrador para obter mais informações.</small>'
    }, {
        type: 'warning',
        timer: 2000,
        placement: {
            from: 'top',
            align: 'center'
        },
        template:
            '<div data-notify="container" class="col-xs-11 col-sm-3 alert-dismissible alert-notify alert alert-{0}" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">' +
            '<span aria-hidden="true">&times;</span>' +
            '</button>' +
            '<span data-notify="icon"></span>' +
            '<div class="alert-text">' +
            '<span class="alert-title" data-notify="title">{1}</span>' +
            '<span data-notify="message">{2}</span>' +
            '</div>' +
            '</div>'
    });
});

// notificação de bloqueio de rota
$('.notify-block-route').on('click', function () {
    $.notify({
        icon: 'alert-icon fas fa-ban',
        title: 'Notificação',
        message: 'Rota bloqueada para acesso.<br><small>Procure o Administrador para obter mais informações.</small>'
    }, {
        type: 'warning',
        timer: 2000,
        placement: {
            from: 'top',
            align: 'center'
        },
        template:
            '<div data-notify="container" class="col-xs-11 col-sm-3 alert-dismissible alert-notify alert alert-{0}" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">' +
            '<span aria-hidden="true">&times;</span>' +
            '</button>' +
            '<span data-notify="icon"></span>' +
            '<div class="alert-text">' +
            '<span class="alert-title" data-notify="title">{1}</span>' +
            '<span data-notify="message">{2}</span>' +
            '</div>' +
            '</div>'
    });
});
