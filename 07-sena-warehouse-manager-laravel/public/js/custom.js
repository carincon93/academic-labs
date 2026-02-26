/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 47);
/******/ })
/************************************************************************/
/******/ ({

/***/ 47:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(48);


/***/ }),

/***/ 48:
/***/ (function(module, exports) {

$(document).ready(function () {

    $('[data-toggle="tooltip"]').tooltip();

    // Obtener la fecha actual
    (function ($) {
        $.fn.getDate = function (format) {

            var gDate = new Date();
            var mDate = {
                'S': gDate.getSeconds(),
                'M': gDate.getMinutes(),
                'H': gDate.getHours(),
                'd': gDate.getDate(),
                'm': gDate.getMonth() + 1,
                'y': gDate.getFullYear()

                // Apply format and add leading zeroes
            };return format.replace(/([SMHdmy])/g, function (key) {
                return (mDate[key] < 10 ? '0' : '') + mDate[key];
            });

            return getDate(str);
        };
    })(jQuery);

    // Autofocus del input al abrir el modal de préstamo
    $('.modal').on('shown.bs.modal', function () {
        $(this).find('[autofocus]').focus();
        // $('.modal-busqueda').click(function (event) {
        //     $(this).find('[autofocus]').focus();
        // });
    });

    var url = window.location;

    $(document).ajaxStart(function () {
        $('#resultado_instructor').append('<img src="' + url + 'images/loader.gif" class="center-block" width="50">');
    }).ajaxStop(function () {
        $('#resultado_instructor').children('img').remove();
    });

    // Búsqueda mediante ajax - Número de documento del instructor
    var request = null;
    $('body').on('keyup', '#buscar_instructor', function (event) {
        var $numero_documento = $(this).val();
        if ($numero_documento > 0) {
            if (request != null) request.abort();

            request = $.get('instructorajax', { numero_documento: $numero_documento }, function (data, textStatus, xhr) {
                if (data) {
                    $('#resultado_instructor').html(data);
                } else {
                    $('#resultado_instructor').html('Resultados: No se encontró el instructor');
                }
            });
        } else {
            setTimeout(function () {
                $('#resultado_instructor').children().remove();
            }, 500);
        }
    });

    $('body').on('keyup', '#wnombre_ambiente', function (event) {
        var $nombre_ambiente = $(this).val();
        if ($nombre_ambiente != '') {
            if (request != null) request.abort();

            request = $.get('obtener_ambiente', { nombre_ambiente: $nombre_ambiente }, function (data, textStatus, xhr) {
                if (data) {
                    $('#classroom-resultados').html('<h2>Resultados:</h2>' + data);
                }
            });
        } else {
            $('#classroom-resultados').children().remove();
        }
    });

    $('body').on('click', '#btn-buscar-ambiente', function (event) {
        var $nombre_ambiente = $('#wnombre_ambiente').val();
        if ($nombre_ambiente != '') {
            if (request != null) request.abort();

            request = $.get('obtener_ambiente', { nombre_ambiente: $nombre_ambiente }, function (data, textStatus, xhr) {
                if (data) {
                    $('#classroom-resultados').html(data);
                }
            });
        } else {
            $('#classroom-resultados').children().remove();
        }
    });

    $('body').on('click', '#btn_instructor', function (event) {
        var $numero_documento = $('#buscar_instructor').val();
        if ($numero_documento > 0) {
            if (request != null) request.abort();

            request = $.get('instructorajax', { numero_documento: $numero_documento }, function (data, textStatus, xhr) {
                $('#resultado_instructor').html(data);
            });
        } else {
            setTimeout(function () {
                $('#resultado_instructor').children().remove();
            }, 500);
        }
    });

    // ======================== Setear modal de préstamo =========================================
    $('body').on('click', '.amb-disponible', function (e) {
        e.preventDefault();
        var $nombre_ambiente = $(this).find('h5').attr('data-nombre-ambiente'),
            $id_ambiente = $(this).attr('data-id-ambiente'),
            $form_prestamo = $('#form-prestamo');

        var $currentDate = $().getDate("y-m-d H:M:S");

        // Set Titulo modal con nombre de ambiente
        $('.modal-title').text($nombre_ambiente);
        // Set ID de ambiente
        $('#id_ambiente').attr('value', $id_ambiente);

        // Set url del form action.
        var url = window.location.href.split("#")[0];
        // url = url[0] + "//" + url[2] + "/";
        $form_prestamo.attr('action', url + 'solicitar_prestamo/' + $id_ambiente + '/aprobado');

        $form_prestamo.find('input[name=prestado_en]').val($currentDate);
    });

    $('button[name="button-import"]').attr('disabled', true);
    $('input[name="imported-file"]').change(function () {
        if ($(this).val().length != 0) $('button[name="button-import"]').attr('disabled', false);else $('button[name="button-import"]').attr('disabled', true);
    });

    $('.modal').on('click', '#btn-prestar-ambiente', function (event) {
        event.preventDefault();
        var $form_prestamo = $('#form-prestamo');
        $classroom_id = $form_prestamo.find('#id_ambiente').val(), $prestado_en = $form_prestamo.find('input[name=prestado_en]').val(), $id_instructor = $form_prestamo.find('input[name=instructor_id]').val(), $token = $form_prestamo.find('input[name=_token]').val(), $class_group_id = $form_prestamo.find('select[name=class_group_id]').val();
        if ($id_instructor > 0) {
            if ($class_group_id > 0) {
                disponibilidad_instructor($id_instructor, $token);
                disponibilidad_classgroup($class_group_id, $token);
                guardar_historial($token, $class_group_id, $id_instructor, $classroom_id, $prestado_en);
                setTimeout(function () {
                    $form_prestamo.submit();
                }, 1000);
            } else {
                $('#mensaje').text('*Debe seleccionar una ficha');
            }
        }
    });

    function disponibilidad_instructor($id_instructor, $token) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            }
        });
        $.post('disponibilidad_instructor/' + $id_instructor, { _token: $token }, function (data, textStatus, xhr) {
            /*optional stuff to do after success */
        });
    }
    function disponibilidad_classgroup($class_group_id, $token) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            }
        });
        $.post('disponibilidad_classgroup/' + $class_group_id, { _token: $token }, function (data, textStatus, xhr) {
            /*optional stuff to do after success */
        });
    }

    function guardar_historial($token, $class_group_id, $id_instructor, $classroom_id, $prestado_en) {
        if ($id_instructor > 0) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $token
                }
            });

            $.post('guardar_historial', { _token: $token, class_group_id: $class_group_id, instructor_id: $id_instructor, classroom_id: $classroom_id, prestado_en: $prestado_en }, function (data, textStatus, xhr) {
                /*optional stuff to do after success */
            });
        }
    }
    $('body').on('click', '.enviarfechas', function (event) {
        event.preventDefault();
        $inicio = $('input[name=inicio]').val();
        $fin = $('input[name=fin]').val();

        $.get('datesearch', { inicio: $inicio, fin: $fin }, function (data, textStatus, xhr) {
            $('.history').html(data);
        });
    });

    $('body').on('click', '.reset', function (event) {
        $('input[name=inicio]').val("");
        $('input[name=fin]').val("");
        $(".enviarfechas").click();
    });

    // ======================== Setear modal de entrega ========================================
    $('body').on('click', '.clr-entregar', function (e) {
        e.preventDefault();
        // Formulario de entrega
        var $form_entrega = $('#form-entrega'),
            $nombre_ambiente = $(this).find('h5').attr('data-nombre-ambiente'),
            $id_ambiente = $(this).attr('data-id-ambiente'),
            $fecha_prestamo = $(this).attr('data-prestamo'),
            $id_instructor = $(this).attr('data-id-instructor');
        $class_group_id = $(this).attr('data-id-classgroup');

        // Set Titulo modal con nombre de ambiente
        $('.modal-title').text($nombre_ambiente);

        $form_entrega.find('input[name=id]').attr('value', $id_ambiente);
        $form_entrega.find('input[name=prestado_en]').attr('value', $fecha_prestamo);
        $form_entrega.find('input[name=instructor_id]').attr('value', $id_instructor);
        $form_entrega.find('input[name=class_group_id]').attr('value', $class_group_id);

        // Construct the URL dynamically.
        var url = window.location.href.split("#")[0];
        // url = url[0] + "//" + url[2] + "/";
        $form_entrega.attr('action', url + 'entregar_ambiente/' + $id_ambiente + '/aprobado');
    });
    $('.modal').on('click', '#btn-entregar-ambiente', function (event) {
        event.preventDefault();
        var $form_entrega = $('#form-entrega'),
            $novedad = $form_entrega.find('textarea').val(),
            $fecha_prestamo = $form_entrega.find('input[name=prestado_en]').val(),
            $id_instructor = $form_entrega.find('input[name=instructor_id]').val(),
            $class_group_id = $form_entrega.find('input[name=class_group_id]').val(),
            $token = $form_entrega.find('input[name=_token]').val();
        modificar_ins_disponibilidad($token, $id_instructor);
        modificar_cg_disponibilidad($token, $class_group_id);
        agregar_novedad($token, $fecha_prestamo, $novedad);
        setTimeout(function () {
            $form_entrega.submit();
        }, 1000);
    });
    function agregar_novedad($token, $fecha_prestamo, $novedad) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $token
            }
        });

        $.post('agregar_novedad/' + $fecha_prestamo, { _token: $token, novedad: $novedad }, function (data, textStatus, xhr) {
            /*optional stuff to do after success */
        });
    }
    function modificar_ins_disponibilidad($token, $id_instructor) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $token
            }
        });
        $.post('modificar_disponibilidad_ins/' + $id_instructor, { _token: $token }, function (data, textStatus, xhr) {
            /*optional stuff to do after success */
        });
    }
    function modificar_cg_disponibilidad($token, $class_group_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $token
            }
        });
        $.post('modificar_disponibilidad_cg/' + $class_group_id, { _token: $token }, function (data, textStatus, xhr) {
            /*optional stuff to do after success */
        });
    }

    // ======================== Truncate class_groups ========================================
    $('body').on('click', '.form-truncate-ficha', function (e) {
        e.preventDefault();
        var $formTruncFic = $(this),
            $modalTrun = $('#confirm-delete');
        $modalTrun.find('.modal-title').text('Eliminar todos los registros');
        $modalTrun.find('.modal-body').text('Va a eliminar todos los registros de esta tabla. ¿Está seguro que desea eliminar todos los registros?');
        $modalTrun.find('#btn-delete').text('Eliminar todo');
        $modalTrun.modal({ backdrop: 'static', keyboard: false }).on('click', '#btn-delete', function () {
            setTimeout(function () {
                $formTruncFic.submit();
            }, 500);
        });
    });

    // Eliminar registros - Modal eliminar
    $('.table-full').on('click', '.btn-delete-tbl', function (e) {
        e.preventDefault();
        var $formDel = $(this),
            $nombre_elemento = $formDel.attr('data-nombre');

        $('#confirm-delete').find('.modal-title').text('Nombre: ' + $nombre_elemento);
        $('#confirm-delete').find('.modal-body').text('Está seguro que desea eliminar este registro?');
        $('#btn-delete').text('Eliminar');
        $('#confirm-delete').modal({ backdrop: 'static', keyboard: false }).on('click', '#btn-delete', function () {
            $formDel.submit();
        });
    });

    $('.table-full').on('click', '.novedad_nueva', function (e) {
        e.preventDefault();
        var $formNovedadNueva = $('#formNovedadNueva'),
            $id_historial = $(this).attr('data-id-historial');
        var url = window.location.href.split("#")[0];
        // url = url[0] + "//" + url[2] + "/";
        $formNovedadNueva.attr('action', url + '/' + $id_historial + '/novedad_nueva');

        $('.modal').on('click', '#btn-novedad-nueva', function () {
            $formNovedadNueva.submit();
        });
        $.get('obtener_novedad', { id: $id_historial }, function (data, textStatus, xhr) {
            $('#novedad_vieja').html(data);
        });
    });

    $('.modal').on('hidden.bs.modal', function (e) {
        $(this).find("input[type=search], input[name=id], input[name=prestado_en], input[id=nomInstructor], textarea[name=novedad], select").val('').end().find("input[type=checkbox], input[type=radio]").prop("checked", "").end().find("#resultado_instructor").children().remove();
    });

    $('#login').one('click', function (event) {
        event.preventDefault();
        $(this).closest('form').submit();
        $(this).prop('disabled', true);
    });

    // Modal-historial
    $('body').on('click', 'button[data-target="#modalHistorial"]', function (event) {
        event.preventDefault();
        $id = $(this).attr('data-id');
        // $nombre_aprendiz = $('button[data-target="#modalHistorial"]').attr('data-nombre');
        // $('#modalHistorial').find('.modal-title').text('Nombre: ' + $nombre_aprendiz);
        $('#modalHistorial').find('button[data-id]').attr('data-id', $id);
        $.get('obtener_historial', { id: $id }, function (data, textStatus, xhr) {
            $('#mbody-Historial').html(data);
        });
    });

    $('body').on('click', '.bloque-azul path', function (event) {
        event.preventDefault();
        /* Act on the event */
        alert($(this).attr('d'));
    });
});

/***/ })

/******/ });