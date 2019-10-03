$(function() {
    "use strict";
    $(function() {
        $(".preloader").fadeOut()
    }), jQuery(document).on("click", ".mega-dropdown", function(e) {
        e.stopPropagation()
    });
    var e = function() {
        var e = window.innerWidth > 0 ? window.innerWidth : this.screen.width,
            i = 0;
        1170 > e ? ($("body").addClass("mini-sidebar"), $(".navbar-brand span").hide(), $(".sidebartoggler i").addClass("ti-menu")) : ($("body").removeClass("mini-sidebar"), $(".navbar-brand span").show());
        var n = (window.innerHeight > 0 ? window.innerHeight : this.screen.height) - 1;
        n -= i, 1 > n && (n = 1), n > i && $(".page-wrapper").css("min-height", n + "px")
    };
    $(window).ready(e), $(window).on("resize", e), $(".search-box a, .search-box .app-search .srh-btn").on("click", function() {
        $(".app-search").toggle(200)
    }), $(".right-side-toggle").click(function() {
        $(".right-sidebar").slideDown(50), $(".right-sidebar").toggleClass("shw-rside")
    }), $(".floating-labels .form-control").on("focus blur", function(e) {
        $(this).parents(".form-group").toggleClass("focused", "focus" === e.type || this.value.length > 0)
    }).trigger("blur"), $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    }), $(function() {
        $('[data-toggle="popover"]').popover()
    }), $(function() {
        $("#sidebarnav").AdminMenu()
    }), $(".scroll-sidebar, .right-side-panel, .message-center, .right-sidebar").perfectScrollbar(), $("body").trigger("resize"), $(".list-task li label").click(function() {
        $(this).toggleClass("task-done")
    }), $('a[data-action="collapse"]').on("click", function(e) {
        e.preventDefault(), $(this).closest(".card").find('[data-action="collapse"] i').toggleClass("ti-minus ti-plus"), $(this).closest(".card").children(".card-body").collapse("toggle")
    }), $('a[data-action="expand"]').on("click", function(e) {
        e.preventDefault(), $(this).closest(".card").find('[data-action="expand"] i').toggleClass("mdi-arrow-expand mdi-close"), $(this).closest(".card").toggleClass("card-fullscreen")
    }), $('a[data-action="close"]').on("click", function() {
        $(this).closest(".card").removeClass().slideUp("fast")
    })
});

// Wave Effect
!function (t) { "use strict"; function e(t) { return null !== t && t === t.window } function n(t) { return e(t) ? t : 9 === t.nodeType && t.defaultView } function a(t) { var e, a, i = { top: 0, left: 0 }, o = t && t.ownerDocument; return e = o.documentElement, "undefined" != typeof t.getBoundingClientRect && (i = t.getBoundingClientRect()), a = n(o), { top: i.top + a.pageYOffset - e.clientTop, left: i.left + a.pageXOffset - e.clientLeft } } function i(t) { var e = ""; for (var n in t) t.hasOwnProperty(n) && (e += n + ":" + t[n] + ";"); return e } function o(t) { if (d.allowEvent(t) === !1) return null; for (var e = null, n = t.target || t.srcElement; null !== n.parentElement;) { if (!(n instanceof SVGElement || -1 === n.className.indexOf("waves-effect"))) { e = n; break } if (n.classList.contains("waves-effect")) { e = n; break } n = n.parentElement } return e } function r(e) { var n = o(e); null !== n && (c.show(e, n), "ontouchstart" in t && (n.addEventListener("touchend", c.hide, !1), n.addEventListener("touchcancel", c.hide, !1)), n.addEventListener("mouseup", c.hide, !1), n.addEventListener("mouseleave", c.hide, !1)) } var s = s || {}, u = document.querySelectorAll.bind(document), c = { duration: 750, show: function (t, e) { if (2 === t.button) return !1; var n = e || this, o = document.createElement("div"); o.className = "waves-ripple", n.appendChild(o); var r = a(n), s = t.pageY - r.top, u = t.pageX - r.left, d = "scale(" + n.clientWidth / 100 * 10 + ")"; "touches" in t && (s = t.touches[0].pageY - r.top, u = t.touches[0].pageX - r.left), o.setAttribute("data-hold", Date.now()), o.setAttribute("data-scale", d), o.setAttribute("data-x", u), o.setAttribute("data-y", s); var l = { top: s + "px", left: u + "px" }; o.className = o.className + " waves-notransition", o.setAttribute("style", i(l)), o.className = o.className.replace("waves-notransition", ""), l["-webkit-transform"] = d, l["-moz-transform"] = d, l["-ms-transform"] = d, l["-o-transform"] = d, l.transform = d, l.opacity = "1", l["-webkit-transition-duration"] = c.duration + "ms", l["-moz-transition-duration"] = c.duration + "ms", l["-o-transition-duration"] = c.duration + "ms", l["transition-duration"] = c.duration + "ms", l["-webkit-transition-timing-function"] = "cubic-bezier(0.250, 0.460, 0.450, 0.940)", l["-moz-transition-timing-function"] = "cubic-bezier(0.250, 0.460, 0.450, 0.940)", l["-o-transition-timing-function"] = "cubic-bezier(0.250, 0.460, 0.450, 0.940)", l["transition-timing-function"] = "cubic-bezier(0.250, 0.460, 0.450, 0.940)", o.setAttribute("style", i(l)) }, hide: function (t) { d.touchup(t); var e = this, n = (1.4 * e.clientWidth, null), a = e.getElementsByClassName("waves-ripple"); if (!(a.length > 0)) return !1; n = a[a.length - 1]; var o = n.getAttribute("data-x"), r = n.getAttribute("data-y"), s = n.getAttribute("data-scale"), u = Date.now() - Number(n.getAttribute("data-hold")), l = 350 - u; 0 > l && (l = 0), setTimeout(function () { var t = { top: r + "px", left: o + "px", opacity: "0", "-webkit-transition-duration": c.duration + "ms", "-moz-transition-duration": c.duration + "ms", "-o-transition-duration": c.duration + "ms", "transition-duration": c.duration + "ms", "-webkit-transform": s, "-moz-transform": s, "-ms-transform": s, "-o-transform": s, transform: s }; n.setAttribute("style", i(t)), setTimeout(function () { try { e.removeChild(n) } catch (t) { return !1 } }, c.duration) }, l) }, wrapInput: function (t) { for (var e = 0; e < t.length; e++) { var n = t[e]; if ("input" === n.tagName.toLowerCase()) { var a = n.parentNode; if ("i" === a.tagName.toLowerCase() && -1 !== a.className.indexOf("waves-effect")) continue; var i = document.createElement("i"); i.className = n.className + " waves-input-wrapper"; var o = n.getAttribute("style"); o || (o = ""), i.setAttribute("style", o), n.className = "waves-button-input", n.removeAttribute("style"), a.replaceChild(i, n), i.appendChild(n) } } } }, d = { touches: 0, allowEvent: function (t) { var e = !0; return "touchstart" === t.type ? d.touches += 1 : "touchend" === t.type || "touchcancel" === t.type ? setTimeout(function () { d.touches > 0 && (d.touches -= 1) }, 500) : "mousedown" === t.type && d.touches > 0 && (e = !1), e }, touchup: function (t) { d.allowEvent(t) } }; s.displayEffect = function (e) { e = e || {}, "duration" in e && (c.duration = e.duration), c.wrapInput(u(".waves-effect")), "ontouchstart" in t && document.body.addEventListener("touchstart", r, !1), document.body.addEventListener("mousedown", r, !1) }, s.attach = function (e) { "input" === e.tagName.toLowerCase() && (c.wrapInput([e]), e = e.parentElement), "ontouchstart" in t && e.addEventListener("touchstart", r, !1), e.addEventListener("mousedown", r, !1) }, t.Waves = s, document.addEventListener("DOMContentLoaded", function () { s.displayEffect() }, !1) }(window);


function requestFullScreen(el = 'body') {

     if (document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement) {
         if (document.exitFullscreen) {
             document.exitFullscreen();
         } else if (document.mozCancelFullScreen) {
             document.mozCancelFullScreen();
         } else if (document.webkitExitFullscreen) {
             document.webkitExitFullscreen();
         } else if (document.msExitFullscreen) {
             document.msExitFullscreen();
         }
     } else {
         element = $('' + el + '').get(0);
         if (element.requestFullscreen) {
             element.requestFullscreen();
         } else if (element.mozRequestFullScreen) {
             element.mozRequestFullScreen();
         } else if (element.webkitRequestFullscreen) {
             element.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
         } else if (element.msRequestFullscreen) {
             element.msRequestFullscreen();
         }
     }

}

$(document).ready(function() {
    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
});
function deleteInfo(handler, url){
    $.confirm({
        title: 'Apagar Conteúdo',
        content: 'Tem certeza que deseja apagar esse conteúdo?',
        type: 'red',
        typeAnimated: true,
        icon: 'fa fa-warning',
        buttons: {
            confirm: {
                text: 'Sim',
                btnClass: 'btn-red',
                action: function(){
                    $.ajax({
                        url: url,
                        type: "get",
                        success: function (response) {
                            response = JSON.parse(response);
                            
                            if(response.icon == 'success'){
                                var tr = $(handler).closest('tr');  
                                tr.fadeOut(400, function(){tr.remove();});
                            }
                            
                            $.toast({
                                heading: ''+response.heading+'',
                                text: ''+response.text+'',
                                position: 'bottom-right',
                                icon: ''+response.icon+'',
                                hideAfter: 3000, 
                                stack: 6
                            });
                        }
                    });
                }
            },
            close: {
                text: 'Fechar'
            }
        }
    });
}


function msgInfo(handler, title, content, type, url) {
    $.confirm({
        title: title,
        content: content,
        type: type,
        typeAnimated: true,
        icon: (type == 'blue' ? "fa fa-info" : "fa fa-warning"),
        buttons: {
            confirm: {
                text: 'Sim',
                btnClass: 'btn-blue',
                action: function () {
                    $.ajax({
                        url: url,
                        type: "get",
                        success: function (response) {
                            response = JSON.parse(response);

                            if (response.icon == 'success') {
                                var tr = $(handler).closest('tr');
                                tr.fadeOut(400, function () { tr.remove(); });
                            }

                            $.toast({
                                heading: '' + response.heading + '',
                                text: '' + response.text + '',
                                position: 'bottom-right',
                                icon: '' + response.icon + '',
                                hideAfter: 3000,
                                stack: 6
                            });
                        }
                    });
                }
            },
            close: {
                text: 'Fechar'
            }
        }
    });
}

function open_popup(url){
    var w = 880;
    var h = 570;
    var l = Math.floor((screen.width-w)/2);
    var t = Math.floor((screen.height-h)/2);
    var win = window.open(url, 'Gerenciador de Arquivos', "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
}

function deleteRedirect(url){
    $.confirm({
        title: 'Apagar Conteúdo',
        content: 'Tem certeza que deseja apagar esse conteúdo?',
        type: 'red',
        typeAnimated: true,
        icon: 'fa fa-warning',
        buttons: {
            confirm: {
                text: 'Sim',
                btnClass: 'btn-red',
                action: function(){
                    window.location = url;
                }
            },
            close: {
                text: 'Fechar'
            }
        }
    });
}

function mysqlDate(date){
    var dateVar = new Date(date);
    return dateVar.toISOString().split("T")[0].substr(0, 10).split('-').reverse().join('/');
}

$('#form-geek button[type="submit"]').click(function(event) {
    event.preventDefault();
    $("#btn_submit").prop("disabled", true);
    $('.form-control-feedback').html('');
    $('.form-control-feedback').parent().removeClass('has-danger');
    var fieldname = $('#geekeditor').data("fieldname");
    var sHTML = $('#geekeditor').keditor('getContent');

    if (fieldname == undefined){
        var data = $('#form-geek').serialize();
    }else{
        var data = $('#form-geek').serialize() + '&' + fieldname + '=' + encodeURIComponent(sHTML);
    }

    $.ajax({
        url: $(this).attr('action'),
        type: "post",
        data: data,
        success: function (response) {
            response = JSON.parse(response);
            $('body,html').animate({scrollTop:0}, 500);
            $("#btn_submit").removeAttr('disabled');
            
            if(response.error){
                response.error.forEach(element => {
                    var info = element.split('<span class="gump-field">');
                    var info2 = info[1].split('</span>');
                    var value = info2[0].toLowerCase();
                    $("#"+value+"-feedback").parent().addClass('has-danger');
                    $("#"+value+"-feedback").html(info[0] + info2[1]);
                });
            }

            $.toast({
                heading: ''+response.heading+'',
                text: ''+response.text+'',
                position: 'bottom-right',
                icon: ''+response.icon+'',
                hideAfter: 3000, 
                stack: 6
            });

        }
    });
});

$(".colorpicker").asColorPicker({ mode: 'simple'});
if ($('').filterizr) {
    $('.filtr-container').filterizr();
}


// Bootstrap DataTable
$('#table').bootstrapTable()
$('#toolbar').find('select').change(function () {
    $('#table').bootstrapTable('destroy').bootstrapTable({
        exportDataType: $(this).val()
    })
})