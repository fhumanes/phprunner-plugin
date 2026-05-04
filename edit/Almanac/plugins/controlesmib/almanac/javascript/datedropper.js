jQuery.easing._dd_easing = function (d, a, i, s, e) {
		return -s * ((a = a / e - 1) * a * a * a - 1) + i
	},
	function (d) {
		d.fn.dateDropper = function (a) {
			return d(this).each(function () {
				if (d(this).is("input") && "text" == d(this).attr("type")) {
					var i = new Date(d(this).val());
					"Invalid Date" == i && (i = new Date);
					var s, e, r, t, n = i.getFullYear(),
						o = i.getDate(),
						l = i.getMonth(),
						u = d(".dd-w").length,
						c = '<div class="dd-w dd-init" id="dd-w-' + u + '"><div class="dd-o"></div><div class="dd-c"><div class="dd-w-c"><div class="dd-b dd-m"><div class="dd-ul"><a class="dd-n dd-n-left"><i class="dd-icon-left" ></i></a><a class="dd-n dd-n-right"><i class="dd-icon-right" ></i></a><ul></ul></div></div><div class="dd-b dd-d"><div class="dd-ul"><a class="dd-n dd-n-left"><i class="dd-icon-left" ></i></a><a class="dd-n dd-n-right"><i class="dd-icon-right" ></i></a><ul></ul></div></div><div class="dd-b dd-y"><div class="dd-ul"><a class="dd-n dd-n-left"><i class="dd-icon-left" ></i></a><a class="dd-n dd-n-right"><i class="dd-icon-right" ></i></a><ul></ul></div></div><div class="dd-s-b dd-s-b-m dd-trans"><div class="dd-s-b-ul"><ul></ul></div></div><div class="dd-s-b dd-s-b-d dd-trans"><div class="dd-s-b-ul"><ul></ul></div></div><div class="dd-s-b dd-s-b-y dd-trans"><div class="dd-s-b-ul"><ul></ul></div></div><div class="dd-s-b dd-s-b-s-y dd-trans"><div class="dd-s-b-ul"><ul></ul></div></div><div class="dd-s-b-s"><i class="dd-icon-close" ></i></div><div class="dd-b dd-sub-y"><div class="dd-ul"><a class="dd-n dd-n-left"><i class="dd-icon-left" ></i></a><a class="dd-n dd-n-right"><i class="dd-icon-right" ></i></a><ul></ul></div></div><div class="dd-s"><a><i class="dd-icon-check" ></i></a></div></div></div></div>';
					d("body").append(c);
					var f = d(this),
						b = d("#dd-w-" + u),
						m = function (d) {
							return !(d % 4 || !(d % 100) && d % 400)
						},
						p = function (d) {
							return 10 > d ? "0" + d : d
						},
						v = d.extend({
							animate: !0,
							init_animation: "fadein",
							format: "m/d/Y",
							lang: "en",
							lock: !1,
							maxYear: n,
							minYear: 1970,
							yearsRange: 10,
							dropPrimaryColor: "#01CEFF",
							dropTextColor: "#333333",
							dropBackgroundColor: "#FFFFFF",
							dropBorder: "1px solid #08C",
							dropBorderRadius: 8,
							dropShadow: "0 0 10px 0 rgba(0, 136, 204, 0.45)",
							dropWidth: 124,
							dropTextWeight: "bold"
						}, a),
						h = null,
						g = !1,
						y = function (d, a) {
							var i = !1;
							"#" == d[0] && (d = d.slice(1), i = !0);
							var s = parseInt(d, 16),
								e = (s >> 16) + a;
							e > 255 ? e = 255 : 0 > e && (e = 0);
							var r = (s >> 8 & 255) + a;
							r > 255 ? r = 255 : 0 > r && (r = 0);
							var t = (255 & s) + a;
							return t > 255 ? t = 255 : 0 > t && (t = 0), (i ? "#" : "") + (t | r << 8 | e << 16).toString(16)
						};
					switch (d("<style>#dd-w-" + u + " { font-weight: " + v.dropTextWeight + "; } #dd-w-" + u + " .dd-w-c,#dd-w-" + u + " .dd-ul li,#dd-w-" + u + " .dd-s-b-ul ul { width:" + v.dropWidth + "px; } #dd-w-" + u + " .dd-w-c{color:" + v.dropTextColor + ";background:" + v.dropBackgroundColor + ";border:" + v.dropBorder + ";box-shadow:" + v.dropShadow + ";border-radius:" + v.dropBorderRadius + "px}#dd-w-" + u + " .dd-w-c,#dd-w-" + u + " .dd-s-b{background:" + v.dropBackgroundColor + "}#dd-w-" + u + " .dd-sun,#dd-w-" + u + " .dd-s-b-ul li.dd-on{color:" + v.dropPrimaryColor + "}#dd-w-" + u + " .dd-c .dd-s,#dd-w-" + u + " .dd-s-b-s,#dd-w-" + u + " .dd-s-b-sub-y,#dd-w-" + u + " .dd-sub-y{background:" + v.dropPrimaryColor + ";color:" + v.dropBackgroundColor + "}#dd-w-" + u + " .dd-c .dd-s a,#dd-w-" + u + " .dd-c .dd-s a:hover{color:" + v.dropBackgroundColor + "}#dd-w-" + u + " .dd-c:after{border-left:" + v.dropBorder + ";border-top:" + v.dropBorder + "}#dd-w-" + u + ".dd-bottom .dd-c:after{background:" + v.dropBackgroundColor + "}#dd-w-" + u + ".dd-top .dd-c:after{background:" + v.dropPrimaryColor + "}#dd-w-" + u + " .dd-n,#dd-w-" + u + " .dd-sun{color:" + v.dropPrimaryColor + "}#dd-w-" + u + " .dd-sub-y .dd-n{color:" + v.dropBackgroundColor + "} #dd-w-" + u + " .dd-c .dd-s:hover,#dd-w-" + u + " .dd-s-b-s:hover { "+ "; }</style>").appendTo("head"), v.lang) {
						case "ar":
							var k = ["جانفي", "فيفري", "مارس", "أفريل", "ماي", "جوان", "جويلية", "أوت", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"],
								C = ["الأحد", "الإثنين", "الثلثاء", "الأربعاء", "الخميس", "الجمعة", "السبت"];
							break;
						case "it":
							var k = ["Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre"],
								C = ["Domenica", "Lunedì", "Martedì", "Mercoledì", "Giovedì", "Venerdì", "Sabato"];
							break;
						case "hu":
							var k = ["január", "február", "március", "április", "május", "június", "július", "augusztus", "szeptember", "október", "november", "december"],
								C = ["vasárnap", "hétfő", "kedd", "szerda", "csütörtök", "péntek", "szombat"];
							break;
						case "gr":
							var k = ["Ιανουάριος", "Φεβρουάριος", "Μάρτιος", "Απρίλιος", "Μάιος", "Ιούνιος", "Ιούλιος", "Αύγουστος", "Σεπτέμβριος", "Οκτώβριος", "Νοέμβριος", "Δεκέμβριος"],
								C = ["Κυριακή", "Δευτέρα", "Τρίτη", "Τετάρτη", "Πέμπτη", "Παρασκευή", "Σάββατο"];
							break;
						case "es":
							var k = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
								C = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
							break;
						case "da":
							var k = ["januar", "februar", "marts", "april", "maj", "juni", "juli", "august", "september", "oktober", "november", "december"],
								C = ["søndag", "mandag", "tirsdag", "onsdag", "torsdag", "fredag", "lørdag"];
							break;
						case "de":
							var k = ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"],
								C = ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"];
							break;
						case "nl":
							var k = ["januari", "februari", "maart", "april", "mei", "juni", "juli", "augustus", "september", "oktober", "november", "december"],
								C = ["zondag", "maandag", "dinsdag", "woensdag", "donderdag", "vrijdag", "zaterdag"];
							break;
						case "fr":
							var k = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
								C = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
							break;
						case "pl":
							var k = ["styczeń", "luty", "marzec", "kwiecień", "maj", "czerwiec", "lipiec", "sierpień", "wrzesień", "październik", "listopad", "grudzień"],
								C = ["niedziela", "poniedziałek", "wtorek", "środa", "czwartek", "piątek", "sobota"];
							break;
						case "pt":
							var k = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
								C = ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"];
							break;
						case "si":
							var k = ["januar", "februar", "marec", "april", "maj", "junij", "julij", "avgust", "september", "oktober", "november", "december"],
								C = ["nedelja", "ponedeljek", "torek", "sreda", "četrtek", "petek", "sobota"];
							break;
						case "uk":
							var k = ["січень", "лютий", "березень", "квітень", "травень", "червень", "липень", "серпень", "вересень", "жовтень", "листопад", "грудень"],
								C = ["неділя", "понеділок", "вівторок", "середа", "четвер", "п'ятниця", "субота"];
							break;
						case "ru":
							var k = ["январь", "февраль", "март", "апрель", "май", "июнь", "июль", "август", "сентябрь", "октябрь", "ноябрь", "декабрь"],
								C = ["воскресенье", "понедельник", "вторник", "среда", "четверг", "пятница", "суббота"];
							break;
						case "tr":
							var k = ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],
								C = ["Pazar", "Pazartesi", "Sali", "Çarşamba", "Perşembe", "Cuma", "Cumartesi"];
							break;
						case "ko":
							var k = ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
								C = ["일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일"];
							break;
						case "fi":
							var k = ["Tammikuu", "Helmikuu", "Maaliskuu", "Huhtikuu", "Toukokuu", "Kesäkuu", "Heinäkuu", "Elokuu", "Syyskuu", "Lokakuu", "Marraskuu", "Joulukuu"],
								C = ["Sunnuntai", "Maanantai", "Tiistai", "Keskiviikko", "Torstai", "Perjantai", "Lauantai"];
							break;
						default:
							var k = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
								C = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
					}
					var w = function () {
							b.find(".dd-d li,.dd-s-b li").show(), m(r) && 2 == s ? (b.find(".dd-d ul").width(29 * v.dropWidth), (30 == e || 31 == e) && (e = 29), b.find("li[data-id=30],li[data-id=31]").hide()) : m(r) || 2 != s ? 4 == s || 6 == s || 9 == s || 11 == s ? (b.find(".dd-d ul").width(30 * v.dropWidth), 31 == e && (e = 30), b.find("li[data-id=31]").hide()) : b.find(".dd-d ul").width(31 * v.dropWidth) : (b.find(".dd-d ul").width(28 * v.dropWidth), (29 == e || 30 == e || 31 == e) && (e = 28), b.find("li[data-id=29],li[data-id=30],li[data-id=31]").hide()), b.find(".dd-d li").each(function () {
								var a = d(this).attr("data-id"),
									a = new Date(s + "/" + a + "/" + r),
									a = a.getDay();
								0 == a || 6 == a ? d(this).addClass("dd-sun") : d(this).removeClass("dd-sun"), d(this).find("span").html(C[a])
							}), b.find(".dd-s-b-d li").each(function () {
								var a = d(this).attr("data-id"),
									a = new Date(s + "/" + a + "/" + r),
									a = a.getDay();
								0 == a || 6 == a ? d(this).addClass("dd-sun") : d(this).removeClass("dd-sun"), d(this).find("span").html(C[a].substr(0, 3))
							}), b.find(".dd-s-b li").removeClass("dd-on"), b.find('.dd-s-b-d li[data-id="' + e + '"],.dd-s-b-m li[data-id="' + s + '"],.dd-s-b-s-y li[data-id="' + r + '"],.dd-s-b-y li[data-id="' + t + '"]').addClass("dd-on"), v.animate ? b.hasClass("dd-init") ? (b.find(".dd-m .dd-ul").animate({
								scrollLeft: b.find('.dd-m li[data-id="' + s + '"]').index() * v.dropWidth
							}, 1200, "swing"), setTimeout(function () {
								b.find(".dd-d .dd-ul").animate({
									scrollLeft: b.find('.dd-d li[data-id="' + e + '"]').index() * v.dropWidth
								}, 1200, "swing"), setTimeout(function () {
									b.find(".dd-y .dd-ul").animate({
										scrollLeft: b.find('.dd-y li[data-id="' + r + '"]').index() * v.dropWidth
									}, 1200, "swing", function () {
										g = !0, b.removeClass("dd-init")
									})
								}, 200)
							}, 400)) : (b.find(".dd-d .dd-ul").stop().animate({
								scrollLeft: b.find('.dd-d li[data-id="' + e + '"]').index() * v.dropWidth
							}, 260), b.find(".dd-m .dd-ul").stop().animate({
								scrollLeft: b.find('.dd-m li[data-id="' + s + '"]').index() * v.dropWidth
							}, 260), b.find(".dd-y .dd-ul").stop().animate({
								scrollLeft: b.find('.dd-y li[data-id="' + r + '"]').index() * v.dropWidth
							}, 260), b.find(".dd-sub-y .dd-ul").stop().animate({
								scrollLeft: b.find('.dd-sub-y li[data-id="' + t + '"]').index() * v.dropWidth
							}, 260)) : (setTimeout(function () {
								b.find(".dd-d .dd-ul").scrollLeft(b.find('.dd-d li[data-id="' + e + '"]').index() * v.dropWidth), b.find(".dd-m .dd-ul").scrollLeft(b.find('.dd-m li[data-id="' + s + '"]').index() * v.dropWidth), b.find(".dd-y .dd-ul").scrollLeft(b.find('.dd-y li[data-id="' + r + '"]').index() * v.dropWidth), b.find(".dd-sub-y .dd-ul").scrollLeft(b.find('.dd-sub-y li[data-id="' + t + '"]').index() * v.dropWidth)
							}, 1), b.hasClass("dd-init") && (b.removeClass("dd-init"), g = !0)), j(t)
						},
						M = function () {
							b.addClass("dd-bottom"), b.find(".dd-c").css({
								top: f.offset().top + f.innerHeight() - 6,
								left: f.offset().left + (f.innerWidth() / 2 - v.dropWidth / 2)
							}).addClass("dd-" + v.init_animation)
						},
						x = function () {
							b.find(".dd-c").addClass("dd-alert").removeClass("dd-" + v.init_animation), setTimeout(function () {
								b.find(".dd-c").removeClass("dd-alert")
							}, 500)
						},
						D = function () {
							if (v.lock) {
								var d = Date.parse(n + "-" + (l + 1) + "-" + o) / 1e3,
									a = Date.parse(r + "-" + s + "-" + e) / 1e3;
								if ("from" == v.lock) {
									if (d > a) return x(), !1
								} else if (a > d) return x(), !1
							}
							var i = new Date(s + "/" + e + "/" + r),
								i = i.getDay(),
								t = v.format.replace(/\b(d)\b/g, p(e)).replace(/\b(m)\b/g, p(s)).replace(/\b(Y)\b/g, r).replace(/\b(D)\b/g, C[i].substr(0, 3)).replace(/\b(l)\b/g, C[i]).replace(/\b(F)\b/g, k[s - 1]).replace(/\b(M)\b/g, k[s - 1].substr(0, 3)).replace(/\b(n)\b/g, s).replace(/\b(j)\b/g, e);
							f.val(t), b.find(".dd-c").addClass("dd-fadeout").removeClass("dd-" + v.init_animation), h = setTimeout(function () {
								b.hide(), b.find(".dd-c").removeClass("dd-fadeout")
							}, 400), f.change()
						},
						j = function (a) {
							b.find(".dd-s-b-s-y ul").empty();
							var i = parseInt(a),
								s = i + (v.yearsRange - 1);
							s > v.maxYear && (s = v.maxYear);
							for (var e = i; s >= e; e++) {
								if (e % v.yearsRange == 0) var n = e;
								b.find(".dd-s-b-s-y ul").append('<li data-id="' + e + '" data-filter="' + n + '">' + e + "</li>")
							}
							b.find(".dd-s-b-s-y ul").append('<div class="dd-clear"></div>'), t = parseInt(a), b.find(".dd-sub-y .dd-ul").scrollLeft(b.find('.dd-sub-y li[data-id="' + t + '"]').index() * v.dropWidth), b.find(".dd-s-b-s-y li").each(function () {
								d(this).click(function () {
									b.find(".dd-s-b-s-y li").removeClass("dd-on"), d(this).addClass("dd-on"), r = parseInt(d(this).attr("data-id")), b.find(".dd-s-b-y,.dd-s-b-s-y").removeClass("dd-show"), b.find(".dd-s-b-s,.dd-sub-y").hide(), w()
								})
							})
						},
						z = function () {
							b.find(".dd-s-b").each(function () {
								var a = d(this),
									i = 0;
								if (a.hasClass("dd-s-b-m") || a.hasClass("dd-s-b-d")) {
									if (a.hasClass("dd-s-b-m"))
										for (var r = 12, t = i; r > t; t++) a.find("ul").append('<li data-id="' + (t + 1) + '">' + k[t].substr(0, 3) + "<span>" + p(t + 1) + "</span></li>");
									if (a.hasClass("dd-s-b-d"))
										for (var r = 31, t = i; r > t; t++) a.find("ul").append('<li data-id="' + (t + 1) + '">' + p(t + 1) + "<span></span></li>")
								}
								if (a.hasClass("dd-s-b-y"))
									for (var t = v.minYear; t <= v.maxYear; t++) t % v.yearsRange == 0 && a.find("ul").append('<li data-id="' + t + '">' + t + "</li>");
								a.find("ul").append('<div class="dd-clear"></div>'), a.find("ul li").click(function () {
									(a.hasClass("dd-s-b-m") || a.hasClass("dd-s-b-d")) && (a.hasClass("dd-s-b-m") && (s = parseInt(d(this).attr("data-id"))), a.hasClass("dd-s-b-d") && (e = parseInt(d(this).attr("data-id"))), w(), a.removeClass("dd-show"), b.find(".dd-s-b-s").hide()), a.hasClass("dd-s-b-y") && (b.find(".dd-sub-y").show(), j(d(this).attr("data-id")), b.find(".dd-s-b-s-y").addClass("dd-show"))
								});
								var n = 0,
									o = !1;
								a.on("mousewheel DOMMouseScroll", function (d) {
									o = !0, (d.originalEvent.wheelDeltaY < 0 || d.originalEvent.detail > 0) && (n = a.scrollTop() + 100), (d.originalEvent.wheelDeltaY > 0 || d.originalEvent.detail < 0) && (n = a.scrollTop() - 100), a.stop().animate({
										scrollTop: n
									}, 600, "_dd_easing", function () {
										o = !1
									})
								}).on("scroll", function () {
									o || (n = a.scrollTop())
								})
							}), b.find(".dd-b").each(function () {
								var a, i = d(this),
									n = 0;
								if (i.hasClass("dd-m")) {
									for (var o = 0; 12 > o; o++) i.find("ul").append('<li data-id="' + (o + 1) + '">' + k[o].substr(0, 3) + "</li>");
									i.find("li").click(function () {
										return "m" == v.format || "n" == v.format || "F" == v.format || "M" == v.format ? !1 : void b.find(".dd-s-b-m").addClass("dd-show")
									})
								}
								if (i.hasClass("dd-d")) {
									for (var o = 1; 31 >= o; o++) i.find("ul").append('<li data-id="' + o + '"><strong>' + p(o) + "</strong><br><span></span></li>");
									i.find("li").click(function () {
										b.find(".dd-s-b-d").addClass("dd-show")
									})
								}
								if (i.hasClass("dd-y")) {
									for (var o = v.minYear; o <= v.maxYear; o++) {
										var l;
										o % v.yearsRange == 0 && (l = 'data-filter="' + o + '"'), i.find("ul").append('<li data-id="' + o + '" ' + l + ">" + o + "</li>")
									}
									i.find("li").click(function () {
										return "Y" == v.format ? !1 : void b.find(".dd-s-b-y").addClass("dd-show")
									})
								}
								if (i.hasClass("dd-sub-y"))
									for (var o = v.minYear; o <= v.maxYear; o++) o % v.yearsRange == 0 && i.find("ul").append('<li data-id="' + o + '">' + o + "</li>");
								i.find("ul").width(i.find("li").length * v.dropWidth), i.find(".dd-n").click(function () {
									clearInterval(a);
									var n, o, l;
									i.hasClass("dd-y") && (o = r), i.hasClass("dd-m") && (o = s), i.hasClass("dd-d") && (o = e), i.hasClass("dd-sub-y") && (o = t), d(this).hasClass("dd-n-left") ? (n = i.find('li[data-id="' + o + '"]').prev("li"), l = parseInt(n.length && n.is(":visible") ? n.attr("data-id") : i.find("li:visible:last").attr("data-id"))) : (n = i.find('li[data-id="' + o + '"]').next("li"), l = parseInt(n.length && n.is(":visible") ? n.attr("data-id") : i.find("li:first").attr("data-id"))), i.hasClass("dd-y") && (r = l), i.hasClass("dd-m") && (s = l), i.hasClass("dd-d") && (e = l), i.hasClass("dd-sub-y") && (t = l), w()
								});
								var u = function () {
									if (g) {
										n = Math.round(i.find(".dd-ul").scrollLeft() / v.dropWidth);
										var d = parseInt(i.find("li").eq(n).attr("data-id"));
										i.hasClass("dd-y") && (r = d), i.hasClass("dd-m") && (s = d), i.hasClass("dd-d") && (e = d), i.hasClass("dd-sub-y") && (t = d)
									}
								};
								i.find(".dd-ul").on("scroll", function () {
									u()
								});
								var c = !1;
								i.find(".dd-ul").on("mousedown touchstart", function () {
									c || (c = !0), clearInterval(a), d(window).on("mouseup touchend touchmove", function () {
										c && (clearInterval(a), a = setTimeout(function () {
											w(), c = !1
										}, 780))
									})
								}), "Y" == v.format && b.find(".dd-m,.dd-d").hide(), ("m" == v.format || "n" == v.format || "F" == v.format || "M" == v.format) && b.find(".dd-y,.dd-d").hide()
							}), b.find(".dd-b li").click(function () {
								return "m" == v.format || "n" == v.format || "F" == v.format || "M" == v.format || "Y" == v.format ? !1 : void b.find(".dd-s-b-s").show()
							}), b.find(".dd-s-b-s").click(function () {
								b.find(".dd-s-b").removeClass("dd-show"), b.find(".dd-s-b-s").hide()
							}), b.find(".dd-s").click(function () {
								D()
							}), b.find(".dd-o").click(function () {
								b.find(".dd-c").addClass("dd-fadeout").removeClass("dd-" + v.init_animation), h = setTimeout(function () {
									b.hide(), b.find(".dd-c").removeClass("dd-fadeout")
								}, 400)
							}), w()
						},
						W = function () {
							clearInterval(h), b.hasClass("dd-init") && (f.attr({
								readonly: "readonly"
							}).blur(), s = l + 1, e = o, r = n, parseInt(f.attr("data-d")) && parseInt(f.attr("data-d")) <= 31 && (e = parseInt(f.attr("data-d"))), parseInt(f.attr("data-m")) && parseInt(f.attr("data-m")) <= 11 && (s = parseInt(f.attr("data-m")) + 1), parseInt(f.attr("data-y")) && 4 == f.attr("data-y").length && (r = parseInt(f.attr("data-y"))), r > v.maxYear && (v.maxYear = r), r < v.minYear && (v.minYear = r), z()), b.show(), M()
						};
					f.click(function () {
						W()
					}), f.bind("focusin focus", function (d) {
						d.preventDefault()
					}), d(window).resize(function () {
						M()
					})
				}
			})
		}
	}(jQuery)

