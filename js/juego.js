$(function() {
    var situacion = 0;
    var nivel = 1;
    var puntosr = 0;
    var puntost = 0;
    var preguntan = 0;
    var tiempo = 10;
    var Timer;
    var TotalSeconds;
    var TimeO;
    var estado = $('#estado');
    var dpregunta = $('#pregunta');
    var p = $('#p');
    var ra = $('#ra');
    var rb = $('#rb');
    var rc = $('#rc');
    var rd = $('#rd');
    var mensaje = $('#mensaje');
    var mp = $('#mensaje div');
    var mb = $('#mensaje a');
    var erradas = $('.erradas');
    $("#cargando").on("ajaxStart", function() {
        $(this).show()
    }).on("ajaxStop", function() {
        $(this).hide()
    });
    $(document).on('click', '.mb-cp', cargar_pregunta);
    $(document).on('click', '#pregunta a', responder);
    $(document).on('click', '.segundos', ayuda_segundos);
    $(document).on('click', '.avanza', ayuda_avanza);
    $(document).on('click', '.erradas', ayuda_erradas);
    $(document).on('click', '.nd', function(e) {
        e.preventDefault()
    });
    control();

    function actualizar_datos() {
        $('#nivel').text(nivel);
        $('#numero_pregunta').text(preguntan);
        $('#puntos').text(puntosr);
        $('#total_puntos').text(puntost)
    }

    function ayuda_avanza(e) {
        $.post('jugar/ayuda', {
            a: 3
        }, usar_ayuda);
        e.preventDefault()
    }

    function ayuda_erradas(e) {
        $.post('jugar/ayuda', {
            a: 2
        }, usar_ayuda);
        e.preventDefault()
    }

    function ayuda_segundos(e) {
        $.post('jugar/ayuda', {
            a: 1
        }, usar_ayuda);
        e.preventDefault()
    }

    function cargar_pregunta(e) {
        $.post('jugar/cargarpregunta', mostrar_pregunta);
        e.preventDefault()
    }

    function control() {
        $.post('jugar/control', get_control)
    }

    function error() {}

    function get_control(data) {
        situacion = data.s;
        nivel = data.n;
        preguntan = data.pn;
        puntosr = data.pr;
        puntost = data.pt;
        tiempo = parseInt(data.t);
        ayudas = data.a;
        setear_ayudas();
        inicializar()
    }

    function inicializar() {
        actualizar_datos();
        switch (situacion) {
            case 1:
                mostrar_mensaje(1);
                break;
            case 2:
                cargar_pregunta();
                break;
            case 3:
                mostrar_mensaje(3);
                break;
            case 4:
                mostrar_mensaje(4);
                break;
            case 5:
                mostrar_mensaje(5);
                break;
            case 6:
                mostrar_mensaje(6);
                break;
            case 7:
                mostrar_mensaje(7);
                break
        }
    }

    function mostrar_mensaje(caso) {
        ocultar_pregunta();
        switch (caso) {
            case 1:
                mp.html('<h3>Para poder iniciar el juego necesitas recordar esto:</h3><ul><li>Tienes solo dos oportunidades para jugar diariamente.</li><li>Acumulas puntos por cada respuesta correcta que tengas.</li><li>Las preguntas son sobre: Medellín, los deportes de los Juegos Olímpicos Juveniles y la importancia de la convivencia.</li><!--<li>Si la pregunta está muy difícil puedes utilizar 3 ayudas: cambiar la pregunta, pedir 10 segundos más para responderla o eliminar dos de las posibles respuestas.</li>--><li>El tiempo de la primera pregunta empieza a correr cuando presiones el botón “jugar”.</li></ul>');
                mb.text('Jugar');
                mb.addClass('mb-cp');
                break;
            case 3:
                mp.html('<h3>¡La respuesta es correcta!</h3>');
                mb.text('Ir a la siguiente pregunta');
                mb.addClass('mb-cp');
                break;
            case 4:
                mp.html('<h3>¡Esta no era la respuesta!</h3><p>Ha terminado esta ronda</p>');
                mb.text('Salir de esta ronda');
                mb.attr('href', 'puntajes');
                break;
            case 5:
                mp.html('<h3>¡La respuesta es correcta, además avanzas al siguiente nivel!</h3>');
                mb.text('Ir a la pregunta del siguiente nivel');
                mb.addClass('mb-cp');
                break;
            case 6:
                mp.html('<h3>¡Felicitaciones, has terminado esta ronda!</h3>');
                mb.text('Ver la tabla de puntajes');
                mb.attr('href', 'puntajes').removeAttr('class');
                break;
            case 7:
                mp.html('<h3>Se agotó el tiempo, ha finalizado esta ronda</h3>');
                mb.text('Ver la tabla de puntajes');
                mb.attr('href', 'puntajes').removeAttr('class');
                break
        }
        mensaje.show('slow')
    }

    function mostrar_pregunta(data) {
        if (!data.s) {
            if (data.pregunta && data.respuestas) {
                situacion = 2;
                tiempo = parseInt(data.t);
                tmp_pregunta = data.pregunta;
                tmp_respuestas = data.respuestas.sort(function() {
                    return 0.5 - Math.random()
                });
                p.text(tmp_pregunta.pregunta);
                ra.text(tmp_respuestas[0].respuesta).addClass(tmp_respuestas[0].id);
                rb.text(tmp_respuestas[1].respuesta).addClass(tmp_respuestas[1].id);
                rc.text(tmp_respuestas[2].respuesta).addClass(tmp_respuestas[2].id);
                rd.text(tmp_respuestas[3].respuesta).addClass(tmp_respuestas[3].id);
                ocultar_mensaje();
                preguntan = data.pn;
                $('#numero_pregunta').text(preguntan);
                dpregunta.show('fast');
                if (localStorage.getItem('t') == null) {
                    CreateTimer('tiempo', tiempo)
                } else {
                    CreateTimer('tiempo', localStorage.getItem('t'))
                }
            } else {
                inicializar()
            }
        } else {
            situacion = data.s;
            inicializar()
        }
    }

    function mostrar_respuesta(data) {
        situacion = data.s;
        nivel = data.n;
        preguntan = data.pn;
        puntosr = data.pr;
        puntost = data.pt;
        ayudas = data.a;
        setear_ayudas();
        inicializar()
    }

    function ocultar_mensaje() {
        mensaje.hide();
        mp.empty();
        mb.empty().attr('href', '#').removeClass()
    }

    function ocultar_pregunta() {
        dpregunta.hide();
        p.empty();
        ra.empty().removeAttr('class');
        rb.empty().removeAttr('class');
        rc.empty().removeAttr('class');
        rd.empty().removeAttr('class')
    }

    function responder(e) {
        var id = e.target.id;
        var respuesta_id = $('#' + id).attr('class');
        if (parseInt(respuesta_id) == respuesta_id) {
            $.post('jugar/responder', {
                r: respuesta_id,
                t: TotalSeconds
            }, mostrar_respuesta);
            localStorage.removeItem('t');
            clearTimeout(TimeO);
            ra.removeAttr('class');
            rb.removeAttr('class');
            rc.removeAttr('class');
            rd.removeAttr('class');
            $('#' + id).addClass('active')
        }
        e.preventDefault()
    }

    function setear_ayudas() {
        for (ayuda in ayudas) {
            var c;
            switch (ayudas[ayuda]) {
                case '1':
                    c = '.segundos';
                    $(document).off('click', c, ayuda_segundos);
                    break;
                case '2':
                    c = '.erradas';
                    $(document).off('click', c, ayuda_erradas);
                    break;
                case '3':
                    c = '.avanza';
                    $(document).off('click', c, ayuda_avanza);
                    break
            }
            $(c).addClass('nd')
        }
    }

    function usar_ayuda(data) {
        if (data.d == 's') {
            switch (data.a) {
                case '1':
                    clearTimeout(TimeO);
                    TotalSeconds += 10;
                    CreateTimer('tiempo', TotalSeconds);
                    break;
                case '2':
                    malas = data.malas;
                    for (mala in malas) {
                        $('.' + malas[mala].id).empty().removeAttr('class')
                    }
                    break;
                case '3':
                    clearTimeout(TimeO);
                    localStorage.removeItem('t');
                    p.empty();
                    ra.empty().removeAttr('class');
                    rb.empty().removeAttr('class');
                    rc.empty().removeAttr('class');
                    rd.empty().removeAttr('class');
                    inicializar();
                    break
            }
        }
    }

    function CreateTimer(TimerID, Time) {
        Timer = document.getElementById(TimerID);
        TotalSeconds = Time;
        UpdateTimer();
        TimeO = setTimeout(Tick, 1000)
    }

    function Tick() {
        if (TotalSeconds <= 0) {
            localStorage.removeItem('t');
            $.post('jugar/tiempo', get_control);
            ra.text('').removeAttr('class');
            rb.text('').removeAttr('class');
            rc.text('').removeAttr('class');
            rd.text('').removeAttr('class');
            return
        }
        TotalSeconds -= 1;
        UpdateTimer();
        TimeO = setTimeout(Tick, 1000)
    }

    function UpdateTimer() {
        localStorage.setItem('t', TotalSeconds);
        var Seconds = TotalSeconds;
        var TimeStr = LeadingZero(Seconds);
        Timer.innerHTML = TimeStr
    }

    function LeadingZero(Time) {
        return (Time < 10) ? "0" + Time : +Time
    }

    $("button[id=responder]").on('click', function(evt) {
        var id = $(this).prev().val();
        var pregunta = $($(this).parent().prev().children().get(0)).text();

        $('#content-page').hide();

        $('#progress').html($('<h4/>', {'class': 'texto-cargando'}).text('En un momento listaremos las respuestas disponibles...').prepend($('<img>', {
            'src': 'images/loading.gif',
        }).css({
            'width': '58',
            'float': 'right'
        })).css({
            'width': '68%',
            'margin': '0 auto',
            'padding-top': '14%',
            'text-transform':'uppercase',
            'font-size': '30px',
            'text-align': 'center'
        })).show('clip').css({
            'height':'300px'
        });

        $.ajax({
            url: 'participar/responder',
            method: 'POST',
            data: {id:id,pregunta:pregunta},
            success: function(data)
            {
                $('#progress').css({'height':'0','display':'none'}).html('');
                $('#content-page').show('clip');

                $('#content-page').html(data.html);
            }
        });

        evt.preventDefault();
    });

    $("button[id=respuesta]").on('click', function(evt) {
        var id = $(this).prev().val();

        $('#content-page').hide();

        $('#progress').html($('<h4/>', {'class': 'texto-cargando'}).text('En el momento estamos analizando tu respuesta...').prepend($('<img>', {
            'src': 'images/loading.gif',
        }).css({
            'width': '58',
            'float': 'right'
        })).css({
            'width': '68%',
            'margin': '0 auto',
            'padding-top': '14%',
            'text-transform':'uppercase',
            'font-size': '30px',
            'text-align': 'center',
            'class': 'texto-cargando'
        })).css({
            'text-align':'center'
        }).show('clip');

        $.ajax({
            url: 'participar/respuesta',
            method: 'POST',
            data: {id:id},
            success: function(data)
            {
                var r = data;
                var h4 = $('#progress').children();
                var img = $('#progress').children().children();

                img.attr('src','images/' + r.status + '.png');
                $('#progress').html(h4.text(r.message).append('<p>Has ganado ' + r.puntos + ' puntos.').prepend(img));
                $('.ctn_main').append($('<span id="clock"></span>'));
                $('#clock').append('<a href="" class="btn-general_md">Volver</a>');
                $('#clock').appendTo('#progress');
            }
        });

        evt.preventDefault();
    });

    $('#goBack').on('click', function(evt) {
        window.location = '/participar';
        evt.preventDefault();
    });

    $('#meses').on('change', function(evt) {
        var mes = $(this).val();
        $.ajax({
            url: '/consultar-ranking',
            method: 'POST',
            data: {mes:mes},
            success: function(data)
            {
                 var data = data.r;
                 var ul = $('#total-mes > ul');
                 ul.html('');
                 $.each(data, function(k, v) {
                     ul.append('<li id="jugador-' + v.top + '"></li>');
                     var li = $('#jugador-' + v.top);
                     li.append('<span class="lugar">' + v.top + '</span>');
                     li.append(v.jugador);
                     li.append('<span class="total">' + v.puntaje + '</span>');
                 });

                 if (ul.is(':empty'))
                     ul.append('<li style="text-align:center;">No se han encontrado resultados.</li>');
            }
        });
        evt.preventDefault();
    });

    $(window).on('load', function(evt) {
        var date = new Date();
        date = date.toLocaleDateString();
        date = date.split('/');
        var month = toSt(date[1]);
        $('#meses').val(month);
    });
});

function toSt(n) {
    s=""
    if(n<10) s+="0"
    return s+n.toString();
}