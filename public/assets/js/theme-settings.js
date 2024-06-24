!(function () {
    var i,
        c,
        e,
        b,
        j,
        o,
        f,
        g,
        k,
        d,
        p,
        q,
        a,
        E,
        y,
        I,
        z = document.querySelector(".sidebar").innerHTML,
        l = localStorage.getItem("language");
    function r(a) {
        var b;
        document.getElementById("header-lang-img") &&
            ("en" == a
                ? (document.getElementById("header-lang-img").src = "assets/images/flags/us.svg")
                : "sp" == a
                    ? (document.getElementById("header-lang-img").src = "assets/images/flags/spain.svg")
                    : "gr" == a
                        ? (document.getElementById("header-lang-img").src = "assets/images/flags/germany.svg")
                        : "it" == a
                            ? (document.getElementById("header-lang-img").src = "assets/images/flags/italy.svg")
                            : "ru" == a
                                ? (document.getElementById("header-lang-img").src = "assets/images/flags/russia.svg")
                                : "ch" == a
                                    ? (document.getElementById("header-lang-img").src = "assets/images/flags/china.svg")
                                    : "fr" == a && (document.getElementById("header-lang-img").src = "assets/images/flags/french.svg"),
                localStorage.setItem("language", a),
                null == (l = localStorage.getItem("language")) && r("en"),
                (b = new XMLHttpRequest()).open("GET", "assets/lang/" + l + ".json"),
                (b.onreadystatechange = function () {
                    var a;
                    4 === this.readyState &&
                        200 === this.status &&
                        ((a = JSON.parse(this.responseText)),
                            Object.keys(a).forEach(function (b) {
                                var c = document.querySelectorAll("[data-key='" + b + "']");
                                Array.from(c).forEach(function (c) {
                                    c.textContent = a[b];
                                });
                            }));
                }),
                b.send());
    }
    function s() {
        var a;
        document.querySelectorAll(".navbar-nav .collapse") &&
            ((a = document.querySelectorAll(".navbar-nav .collapse")),
                Array.from(a).forEach(function (a) {
                    var b = new bootstrap.Collapse(a, { toggle: !1 });
                    a.addEventListener("show.bs.collapse", function (c) {
                        c.stopPropagation();
                        var d,
                            c = a.parentElement.closest(".collapse");
                        c
                            ? ((d = c.querySelectorAll(".collapse")),
                                Array.from(d).forEach(function (a) {
                                    (a = bootstrap.Collapse.getInstance(a)) !== b && a.hide();
                                }))
                            : ((d = (function (b) {
                                for (var c = [], a = b.parentNode.firstChild; a;) 1 === a.nodeType && a !== b && c.push(a), (a = a.nextSibling);
                                return c;
                            })(a.parentElement)),
                                Array.from(d).forEach(function (a) {
                                    2 < a.childNodes.length && a.firstElementChild.setAttribute("aria-expanded", "false"),
                                        (a = a.querySelectorAll("*[id]")),
                                        Array.from(a).forEach(function (a) {
                                            a.classList.remove("show"),
                                                2 < a.childNodes.length &&
                                                ((a = a.querySelectorAll("ul li a")),
                                                    Array.from(a).forEach(function (a) {
                                                        a.hasAttribute("aria-expanded") && a.setAttribute("aria-expanded", "false");
                                                    }));
                                        });
                                }));
                    }),
                        a.addEventListener("hide.bs.collapse", function (b) {
                            b.stopPropagation(),
                                (b = a.querySelectorAll(".collapse")),
                                Array.from(b).forEach(function (a) {
                                    (childCollapseInstance = bootstrap.Collapse.getInstance(a)).hide();
                                });
                        });
                }));
    }
    function t() {
        var c,
            a,
            d = document.documentElement.getAttribute("data-layout"),
            b = sessionStorage.getItem("defaultAttribute"),
            b = JSON.parse(b);
        b &&
            ("twocolumn" == d || "twocolumn" == b["data-layout"]) &&
            ((document.querySelector(".sidebar").innerHTML = z),
                ((c = document.createElement("ul")).innerHTML = '<a href="#" class="logo"><img src="assets/img/logo.png" alt="User Image" height="22"></a>'),
                Array.from(document.getElementById("navbar-nav").querySelectorAll(".menu-link")).forEach(function (b) {
                    c.className = "twocolumn-iconview";
                    var d = document.createElement("li"),
                        a = b;
                    Array.from(a.querySelectorAll("span")).forEach(function (a) {
                        a.classList.add("d-none");
                    }),
                        b.parentElement.classList.contains("twocolumn-item-show") && b.classList.add("active"),
                        d.appendChild(a),
                        c.appendChild(d),
                        a.classList.contains("nav-link") && a.classList.replace("nav-link", "nav-icon"),
                        a.classList.remove("collapsed", "menu-link");
                }),
                (b = (b = "/" == location.pathname ? "index.html" : location.pathname.substring(1)).substring(b.lastIndexOf("/") + 1)) &&
                (!(b = document.getElementById("navbar-nav").querySelector('[href="' + b + '"]')) ||
                    ((a = b.closest(".collapse.menu-dropdown")) &&
                        (a.classList.add("show"),
                            a.parentElement.children[0].classList.add("active"),
                            a.parentElement.children[0].setAttribute("aria-expanded", "true"),
                            a.parentElement.closest(".collapse.menu-dropdown") &&
                            (a.parentElement.closest(".collapse").classList.add("show"),
                                a.parentElement.closest(".collapse").previousElementSibling && a.parentElement.closest(".collapse").previousElementSibling.classList.add("active"),
                                a.parentElement.parentElement.parentElement.parentElement.closest(".collapse.menu-dropdown") &&
                                (a.parentElement.parentElement.parentElement.parentElement.closest(".collapse").classList.add("show"),
                                    a.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling &&
                                    a.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling.classList.add("active")))))),
                //(document.getElementById("two-column-menu").innerHTML = c.outerHTML),
                1,
                // Array.from(document.querySelector("#two-column-menu ul").querySelectorAll("li a")).forEach(function (a) {
                //     var b = (b = "/" == location.pathname ? "index.html" : location.pathname.substring(1)).substring(b.lastIndexOf("/") + 1);
                //     a.addEventListener("click", function (c) {
                //         var d;
                //         (b != "/" + a.getAttribute("href") || a.getAttribute("data-bs-toggle")) && document.body.classList.contains("twocolumn-panel") && document.body.classList.remove("twocolumn-panel"),
                //             document.getElementById("navbar-nav").classList.remove("twocolumn-nav-hide"),
                //             document.querySelector(".hamburger-icon").classList.remove("open"),
                //             ((c.target && c.target.matches("a.nav-icon")) || (c.target && c.target.matches("i"))) &&
                //             (null !== document.querySelector("#two-column-menu ul .nav-icon.active") && document.querySelector("#two-column-menu ul .nav-icon.active").classList.remove("active"),
                //                 (c.target.matches("i") ? c.target.closest("a") : c.target).classList.add("active"),
                //                 0 < (d = document.getElementsByClassName("twocolumn-item-show")).length && d[0].classList.remove("twocolumn-item-show"),
                //                 (c = (c.target.matches("i") ? c.target.closest("a") : c.target).getAttribute("href").slice(1)),
                //                 document.getElementById(c) && document.getElementById(c).parentElement.classList.add("twocolumn-item-show"));
                //     }),
                //         b != "/" + a.getAttribute("href") ||
                //         a.getAttribute("data-bs-toggle") ||
                //         (a.classList.add("active"), document.getElementById("navbar-nav").classList.add("twocolumn-nav-hide"), document.querySelector(".hamburger-icon") && document.querySelector(".hamburger-icon").classList.add("open"));
                // }),
                1,
                1);
                // "horizontal" !== document.documentElement.getAttribute("data-layout") &&
                // ((a = new SimpleBar(document.getElementById("navbar-nav"))).getContentElement(), (a = new SimpleBar(document.getElementsByClassName("twocolumn-iconview")[0])).getContentElement()));
    }
    function u(a) {
        if (a) {
            var b = a.offsetTop,
                c = a.offsetLeft,
                d = a.offsetWidth,
                e = a.offsetHeight;
            if (a.offsetParent) for (; a.offsetParent;) (b += (a = a.offsetParent).offsetTop), (c += a.offsetLeft);
            return b >= window.pageYOffset && c >= window.pageXOffset && b + e <= window.pageYOffset + window.innerHeight && c + d <= window.pageXOffset + window.innerWidth;
        }
    }

    function m() {
        /*feather.replace();*/
        var a = document.documentElement.clientWidth;
        a < 1025 && 767 < a
            ? (document.body.classList.remove("twocolumn-panel"),
                "twocolumn" == sessionStorage.getItem("data-layout") &&
                (document.documentElement.setAttribute("data-layout", "twocolumn"), document.getElementById("customizer-layout03") && document.getElementById("customizer-layout03").click(), t(), B(), s()),
                "vertical" == sessionStorage.getItem("data-layout") && document.documentElement.setAttribute("data-sidebar-size", "sm"),
                document.querySelector(".hamburger-icon") && document.querySelector(".hamburger-icon").classList.add("open"))
            : 1025 <= a
                ? (document.body.classList.remove("twocolumn-panel"),
                    "twocolumn" == sessionStorage.getItem("data-layout") &&
                    (document.documentElement.setAttribute("data-layout", "twocolumn"), document.getElementById("customizer-layout03") && document.getElementById("customizer-layout03").click(), t(), B(), s()),
                    "vertical" == sessionStorage.getItem("data-layout") && document.documentElement.setAttribute("data-sidebar-size", sessionStorage.getItem("data-sidebar-size")),
                    document.querySelector(".hamburger-icon") && document.querySelector(".hamburger-icon").classList.remove("open"))
                : a <= 767 &&
                (document.body.classList.remove("vertical-sidebar-enable"),
                    document.body.classList.add("twocolumn-panel"),
                    "twocolumn" == sessionStorage.getItem("data-layout") && (document.documentElement.setAttribute("data-layout", "vertical"), E("vertical"), s()),
                    "horizontal" != sessionStorage.getItem("data-layout") && document.documentElement.setAttribute("data-sidebar-size", "lg"),
                    document.querySelector(".hamburger-icon") && document.querySelector(".hamburger-icon").classList.add("open")),
            (a = document.querySelectorAll("#navbar-nav > li.nav-item")),
            Array.from(a).forEach(function (a) {
                a.addEventListener("click", A.bind(this), !1), a.addEventListener("mouseover", A.bind(this), !1);
            });
    }
    function A(a) {
        if (a.target && a.target.matches("a.nav-link span")) {
            if (0 == u(a.target.parentElement.nextElementSibling)) {
                a.target.parentElement.nextElementSibling.classList.add("dropdown-custom-right"), a.target.parentElement.parentElement.parentElement.parentElement.classList.add("dropdown-custom-right");
                var c = a.target.parentElement.nextElementSibling;
                Array.from(c.querySelectorAll(".menu-dropdown")).forEach(function (a) {
                    a.classList.add("dropdown-custom-right");
                });
            } else if (1 == u(a.target.parentElement.nextElementSibling) && 1848 <= window.innerWidth) for (var b = document.getElementsByClassName("dropdown-custom-right"); 0 < b.length;) b[0].classList.remove("dropdown-custom-right");
        }
        if (a.target && a.target.matches("a.nav-link")) {
            if (0 == u(a.target.nextElementSibling))
                a.target.nextElementSibling.classList.add("dropdown-custom-right"),
                    a.target.parentElement.parentElement.parentElement.classList.add("dropdown-custom-right"),
                    (c = a.target.nextElementSibling),
                    Array.from(c.querySelectorAll(".menu-dropdown")).forEach(function (a) {
                        a.classList.add("dropdown-custom-right");
                    });
            else if (1 == u(a.target.nextElementSibling) && 1848 <= window.innerWidth) for (b = document.getElementsByClassName("dropdown-custom-right"); 0 < b.length;) b[0].classList.remove("dropdown-custom-right");
        }
    }
    function B() {
        //feather.replace();
        var c,
            a,
            b = "/" == location.pathname ? "index.html" : location.pathname.substring(1);
        (b = b.substring(b.lastIndexOf("/") + 1)) &&
            ("twocolumn-panel" == document.body.className &&
                document
                    .getElementById("two-column-menu")
                    .querySelector('[href="' + b + '"]')
                    .classList.add("active"),
                (c = document.getElementById("navbar-nav").querySelector('[href="' + b + '"]'))
                    ? (c.classList.add("active"),
                        (a =
                            (a = c.closest(".collapse.menu-dropdown")) && a.parentElement.closest(".collapse.menu-dropdown")
                                ? (a.classList.add("show"),
                                    a.parentElement.children[0].classList.add("active"),
                                    a.parentElement.closest(".collapse.menu-dropdown").parentElement.classList.add("twocolumn-item-show"),
                                    a.parentElement.parentElement.parentElement.parentElement.closest(".collapse.menu-dropdown") &&
                                    ((b = a.parentElement.parentElement.parentElement.parentElement.closest(".collapse.menu-dropdown").getAttribute("id")),
                                        a.parentElement.parentElement.parentElement.parentElement.closest(".collapse.menu-dropdown").parentElement.classList.add("twocolumn-item-show"),
                                        a.parentElement.closest(".collapse.menu-dropdown").parentElement.classList.remove("twocolumn-item-show"),
                                        document.getElementById("two-column-menu").querySelector('[href="#' + b + '"]') &&
                                        document
                                            .getElementById("two-column-menu")
                                            .querySelector('[href="#' + b + '"]')
                                            .classList.add("active")),
                                    a.parentElement.closest(".collapse.menu-dropdown").getAttribute("id"))
                                : (c.closest(".collapse.menu-dropdown").parentElement.classList.add("twocolumn-item-show"), a.getAttribute("id"))),
                        document.getElementById("two-column-menu").querySelector('[href="#' + a + '"]') &&
                        document
                            .getElementById("two-column-menu")
                            .querySelector('[href="#' + a + '"]')
                            .classList.add("active"))
                    : document.body.classList.add("twocolumn-panel"));
    }
    function C() {
        var a = "/" == location.pathname ? "index.html" : location.pathname.substring(1);
        !(a = a.substring(a.lastIndexOf("/") + 1)) ||
            ((a = document.getElementById("navbar-nav").querySelector('[href="' + a + '"]')) &&
                (a.classList.add("active"),
                    (a = a.closest(".collapse.menu-dropdown")) &&
                    (a.classList.add("show"),
                        a.parentElement.children[0].classList.add("active"),
                        a.parentElement.children[0].setAttribute("aria-expanded", "true"),
                        a.parentElement.closest(".collapse.menu-dropdown") &&
                        (a.parentElement.closest(".collapse").classList.add("show"),
                            a.parentElement.closest(".collapse").previousElementSibling && a.parentElement.closest(".collapse").previousElementSibling.classList.add("active"),
                            a.parentElement.parentElement.parentElement.parentElement.closest(".collapse.menu-dropdown") &&
                            (a.parentElement.parentElement.parentElement.parentElement.closest(".collapse").classList.add("show"),
                                a.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling &&
                                (console.log("parentCollapseDiv", a),
                                    a.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling.classList.add("active"),
                                    "horizontal" == document.documentElement.getAttribute("data-layout") &&
                                    a.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.closest(".collapse") &&
                                    a.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling.classList.add("active")))))));
    }
    function u(a) {
        if (a) {
            var b = a.offsetTop,
                c = a.offsetLeft,
                d = a.offsetWidth,
                e = a.offsetHeight;
            if (a.offsetParent) for (; a.offsetParent;) (b += (a = a.offsetParent).offsetTop), (c += a.offsetLeft);
            return b >= window.pageYOffset && c >= window.pageXOffset && b + e <= window.pageYOffset + window.innerHeight && c + d <= window.pageXOffset + window.innerWidth;
        }
    }
    function D() {
        (document.getElementById("two-column-menu").innerHTML = ""),
            (document.querySelector(".sidebar").innerHTML = z),
            document.getElementById("two-col-bar").removeAttribute("data-simplebar"),
            document.getElementById("navbar-nav").removeAttribute("data-simplebar"),
            document.getElementById("two-col-bar").classList.remove("h-100");
        var a = document.querySelectorAll("ul.navbar-nav > li.nav-item"),
            b = "",
            c = "";
        Array.from(a).forEach(function (d, e) {
            e + 1 === 7 && (c = d),
                7 < e + 1 && ((b += d.outerHTML), d.remove()),
                e + 1 === a.length &&
                c.insertAdjacentHTML &&
                c.insertAdjacentHTML(
                    "afterend",
                    '<li class="nav-item">						<a class="nav-link" href="#sidebarMore" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMore">							<i class="ri-briefcase-2-line"></i> More						</a>						<div class="collapse menu-dropdown" id="sidebarMore"><ul class="nav nav-sm flex-column">' +
                    b +
                    "</ul></div>					</li>"
                );
        });
    }

    function n(a) {
        if (a == a) {
            switch (a["data-layout"]) {
                case "vertical":
                    G("data-layout", "vertical"), sessionStorage.setItem("data-layout", "vertical"), document.documentElement.setAttribute("data-layout", "vertical"), /*E("vertical"),*/ s();
                    break;
                case "horizontal":
                    G("data-layout", "horizontal"), sessionStorage.setItem("data-layout", "horizontal"), document.documentElement.setAttribute("data-layout", "horizontal")/*, E("horizontal")*/;
                    break;
                case "twocolumn":
                    G("data-layout", "twocolumn"), sessionStorage.setItem("data-layout", "twocolumn"), document.documentElement.setAttribute("data-layout", "twocolumn")/*, E("twocolumn")*/;
                    break;
                default:
                    "vertical" == sessionStorage.getItem("data-layout") && sessionStorage.getItem("data-layout")
                        ? (G("data-layout", "vertical"), sessionStorage.setItem("data-layout", "vertical"), document.documentElement.setAttribute("data-layout", "vertical"), E("vertical"), s())
                        : "horizontal" == sessionStorage.getItem("data-layout")
                            ? (G("data-layout", "horizontal"), sessionStorage.setItem("data-layout", "horizontal"), document.documentElement.setAttribute("data-layout", "horizontal"), E("horizontal"))
                            : "twocolumn" == sessionStorage.getItem("data-layout") &&
                            (G("data-layout", "twocolumn"), sessionStorage.setItem("data-layout", "twocolumn"), document.documentElement.setAttribute("data-layout", "twocolumn"), E("twocolumn"));
            }
            switch (a["data-topbar"]) {
                case "light":
                    G("data-topbar", "light"), sessionStorage.setItem("data-topbar", "light"), document.documentElement.setAttribute("data-topbar", "light");
                    break;
                case "dark":
                    G("data-topbar", "dark"), sessionStorage.setItem("data-topbar", "dark"), document.documentElement.setAttribute("data-topbar", "dark");
                    break;
                default:
                    "dark" == sessionStorage.getItem("data-topbar")
                        ? (G("data-topbar", "dark"), sessionStorage.setItem("data-topbar", "dark"), document.documentElement.setAttribute("data-topbar", "dark"))
                        : (G("data-topbar", "light"), sessionStorage.setItem("data-topbar", "light"), document.documentElement.setAttribute("data-topbar", "light"));
            }
            switch (a["data-layout-style"]) {
                case "default":
                    G("data-layout-style", "default"), sessionStorage.setItem("data-layout-style", "default"), document.documentElement.setAttribute("data-layout-style", "default");
                    break;
                case "detached":
                    G("data-layout-style", "detached"), sessionStorage.setItem("data-layout-style", "detached"), document.documentElement.setAttribute("data-layout-style", "detached");
                    break;
                default:
                    "detached" == sessionStorage.getItem("data-layout-style")
                        ? (G("data-layout-style", "detached"), sessionStorage.setItem("data-layout-style", "detached"), document.documentElement.setAttribute("data-layout-style", "detached"))
                        : (G("data-layout-style", "default"), sessionStorage.setItem("data-layout-style", "default"), document.documentElement.setAttribute("data-layout-style", "default"));
            }
            switch (a["data-sidebar-size"]) {
                case "lg":
                    G("data-sidebar-size", "lg"), document.documentElement.setAttribute("data-sidebar-size", "lg"), sessionStorage.setItem("data-sidebar-size", "lg");
                    break;
                case "sm":
                    G("data-sidebar-size", "sm"), document.documentElement.setAttribute("data-sidebar-size", "sm"), sessionStorage.setItem("data-sidebar-size", "sm");
                    break;
                case "md":
                    G("data-sidebar-size", "md"), document.documentElement.setAttribute("data-sidebar-size", "md"), sessionStorage.setItem("data-sidebar-size", "md");
                    break;
                case "sm-hover":
                    G("data-sidebar-size", "sm-hover"), document.documentElement.setAttribute("data-sidebar-size", "sm-hover"), sessionStorage.setItem("data-sidebar-size", "sm-hover");
                    break;
                default:
                    "sm" == sessionStorage.getItem("data-sidebar-size")
                        ? (document.documentElement.setAttribute("data-sidebar-size", "sm"), G("data-sidebar-size", "sm"), sessionStorage.setItem("data-sidebar-size", "sm"))
                        : "md" == sessionStorage.getItem("data-sidebar-size")
                            ? (document.documentElement.setAttribute("data-sidebar-size", "md"), G("data-sidebar-size", "md"), sessionStorage.setItem("data-sidebar-size", "md"))
                            : "sm-hover" == sessionStorage.getItem("data-sidebar-size")
                                ? (document.documentElement.setAttribute("data-sidebar-size", "sm-hover"), G("data-sidebar-size", "sm-hover"), sessionStorage.setItem("data-sidebar-size", "sm-hover"))
                                : (document.documentElement.setAttribute("data-sidebar-size", "lg"), G("data-sidebar-size", "lg"), sessionStorage.setItem("data-sidebar-size", "lg"));
            }
            switch (a["data-layout-mode"]) {
                case "light":
                    G("data-layout-mode", "light"), document.documentElement.setAttribute("data-layout-mode", "light"), sessionStorage.setItem("data-layout-mode", "light");
                    break;
                case "dark":
                    G("data-layout-mode", "dark"), document.documentElement.setAttribute("data-layout-mode", "dark"), sessionStorage.setItem("data-layout-mode", "dark");
                    break;
                case "blue":
                    G("data-layout-mode", "blue"), document.documentElement.setAttribute("data-layout-mode", "blue"), sessionStorage.setItem("data-layout-mode", "blue");
                    break;
                case "marron":
                    G("data-layout-mode", "maroon"), document.documentElement.setAttribute("data-layout-mode", "maroon"), sessionStorage.setItem("data-layout-mode", "maroon");
                    break;
                case "purple":
                    G("data-layout-mode", "purple"), document.documentElement.setAttribute("data-layout-mode", "purple"), sessionStorage.setItem("data-layout-mode", "purple");
                    break;
                default:
                    sessionStorage.getItem("data-layout-mode") && "dark" == sessionStorage.getItem("data-layout-mode")
                        ? (sessionStorage.setItem("data-layout-mode", "dark"), document.documentElement.setAttribute("data-layout-mode", "dark"), G("data-layout-mode", "dark"))
                        : (sessionStorage.setItem("data-layout-mode", "orange"), document.documentElement.setAttribute("data-layout-mode", "orange"), G("data-layout-mode", "orange"));
            }
            switch (a["data-layout-width"]) {
                case "fluid":
                    G("data-layout-width", "fluid"), document.documentElement.setAttribute("data-layout-width", "fluid"), sessionStorage.setItem("data-layout-width", "fluid");
                    break;
                case "boxed":
                    G("data-layout-width", "boxed"), document.documentElement.setAttribute("data-layout-width", "boxed"), sessionStorage.setItem("data-layout-width", "boxed");
                    break;
                default:
                    "boxed" == sessionStorage.getItem("data-layout-width")
                        ? (sessionStorage.setItem("data-layout-width", "boxed"), document.documentElement.setAttribute("data-layout-width", "boxed"), G("data-layout-width", "boxed"))
                        : (sessionStorage.setItem("data-layout-width", "fluid"), document.documentElement.setAttribute("data-layout-width", "fluid"), G("data-layout-width", "fluid"));
            }
            switch (a["data-sidebar"]) {
                case "light":
                    G("data-sidebar", "light"), sessionStorage.setItem("data-sidebar", "light"), document.documentElement.setAttribute("data-sidebar", "light");
                    break;
                case "dark":
                    G("data-sidebar", "dark"), sessionStorage.setItem("data-sidebar", "dark"), document.documentElement.setAttribute("data-sidebar", "dark");
                    break;
                case "gradient":
                    G("data-sidebar", "gradient"), sessionStorage.setItem("data-sidebar", "gradient"), document.documentElement.setAttribute("data-sidebar", "gradient");
                    break;
                case "gradient-2":
                    G("data-sidebar", "gradient-2"), sessionStorage.setItem("data-sidebar", "gradient-2"), document.documentElement.setAttribute("data-sidebar", "gradient-2");
                    break;
                case "gradient-3":
                    G("data-sidebar", "gradient-3"), sessionStorage.setItem("data-sidebar", "gradient-3"), document.documentElement.setAttribute("data-sidebar", "gradient-3");
                    break;
                case "gradient-4":
                    G("data-sidebar", "gradient-4"), sessionStorage.setItem("data-sidebar", "gradient-4"), document.documentElement.setAttribute("data-sidebar", "gradient-4");
                    break;
                default:
                    sessionStorage.getItem("data-sidebar") && "light" == sessionStorage.getItem("data-sidebar")
                        ? (sessionStorage.setItem("data-sidebar", "light"), G("data-sidebar", "light"), document.documentElement.setAttribute("data-sidebar", "light"))
                        : "dark" == sessionStorage.getItem("data-sidebar")
                            ? (sessionStorage.setItem("data-sidebar", "dark"), G("data-sidebar", "dark"), document.documentElement.setAttribute("data-sidebar", "dark"))
                            : "gradient" == sessionStorage.getItem("data-sidebar")
                                ? (sessionStorage.setItem("data-sidebar", "gradient"), G("data-sidebar", "gradient"), document.documentElement.setAttribute("data-sidebar", "gradient"))
                                : "gradient-2" == sessionStorage.getItem("data-sidebar")
                                    ? (sessionStorage.setItem("data-sidebar", "gradient-2"), G("data-sidebar", "gradient-2"), document.documentElement.setAttribute("data-sidebar", "gradient-2"))
                                    : "gradient-3" == sessionStorage.getItem("data-sidebar")
                                        ? (sessionStorage.setItem("data-sidebar", "gradient-3"), G("data-sidebar", "gradient-3"), document.documentElement.setAttribute("data-sidebar", "gradient-3"))
                                        : "gradient-4" == sessionStorage.getItem("data-sidebar") &&
                                        (sessionStorage.setItem("data-sidebar", "gradient-4"), G("data-sidebar", "gradient-4"), document.documentElement.setAttribute("data-sidebar", "gradient-4"));
            }
            switch (a["data-sidebar-image"]) {
                case "none":
                    G("data-sidebar-image", "none"), sessionStorage.setItem("data-sidebar-image", "none"), document.documentElement.setAttribute("data-sidebar-image", "none");
                    break;
                case "img-1":
                    G("data-sidebar-image", "img-1"), sessionStorage.setItem("data-sidebar-image", "img-1"), document.documentElement.setAttribute("data-sidebar-image", "img-1");
                    break;
                case "img-2":
                    G("data-sidebar-image", "img-2"), sessionStorage.setItem("data-sidebar-image", "img-2"), document.documentElement.setAttribute("data-sidebar-image", "img-2");
                    break;
                case "img-3":
                    G("data-sidebar-image", "img-3"), sessionStorage.setItem("data-sidebar-image", "img-3"), document.documentElement.setAttribute("data-sidebar-image", "img-3");
                    break;
                case "img-4":
                    G("data-sidebar-image", "img-4"), sessionStorage.setItem("data-sidebar-image", "img-4"), document.documentElement.setAttribute("data-sidebar-image", "img-4");
                    break;
                default:
                    sessionStorage.getItem("data-sidebar-image") && "none" == sessionStorage.getItem("data-sidebar-image")
                        ? (sessionStorage.setItem("data-sidebar-image", "none"), G("data-sidebar-image", "none"), document.documentElement.setAttribute("data-sidebar-image", "none"))
                        : "img-1" == sessionStorage.getItem("data-sidebar-image")
                            ? (sessionStorage.setItem("data-sidebar-image", "img-1"), G("data-sidebar-image", "img-1"), document.documentElement.setAttribute("data-sidebar-image", "img-2"))
                            : "img-2" == sessionStorage.getItem("data-sidebar-image")
                                ? (sessionStorage.setItem("data-sidebar-image", "img-2"), G("data-sidebar-image", "img-2"), document.documentElement.setAttribute("data-sidebar-image", "img-2"))
                                : "img-3" == sessionStorage.getItem("data-sidebar-image")
                                    ? (sessionStorage.setItem("data-sidebar-image", "img-3"), G("data-sidebar-image", "img-3"), document.documentElement.setAttribute("data-sidebar-image", "img-3"))
                                    : "img-4" == sessionStorage.getItem("data-sidebar-image") &&
                                    (sessionStorage.setItem("data-sidebar-image", "img-4"), G("data-sidebar-image", "img-4"), document.documentElement.setAttribute("data-sidebar-image", "img-4"));
            }
            switch (a["data-layout-position"]) {
                case "fixed":
                    G("data-layout-position", "fixed"), sessionStorage.setItem("data-layout-position", "fixed"), document.documentElement.setAttribute("data-layout-position", "fixed");
                    break;
                case "scrollable":
                    G("data-layout-position", "scrollable"), sessionStorage.setItem("data-layout-position", "scrollable"), document.documentElement.setAttribute("data-layout-position", "scrollable");
                    break;
                default:
                    sessionStorage.getItem("data-layout-position") && "scrollable" == sessionStorage.getItem("data-layout-position")
                        ? (G("data-layout-position", "scrollable"), sessionStorage.setItem("data-layout-position", "scrollable"), document.documentElement.setAttribute("data-layout-position", "scrollable"))
                        : (G("data-layout-position", "fixed"), sessionStorage.setItem("data-layout-position", "fixed"), document.documentElement.setAttribute("data-layout-position", "fixed"));
            }
        }
    }
    function w() {
        setTimeout(function () {
            var c,
                b,
                a = document.getElementById("navbar-nav");
            a &&
                300 < (c = (a = a.querySelector(".nav-item .active")) ? a.offsetTop : 0) &&
                (b = document.getElementsByClassName("app-menu") ? document.getElementsByClassName("app-menu")[0] : "") &&
                b.querySelector(".simplebar-content-wrapper") &&
                setTimeout(function () {
                    b.querySelector(".simplebar-content-wrapper").scrollTop = 330 == c ? c + 85 : c;
                }, 0);
        }, 250);
    }
    function G(a, b) {
        Array.from(document.querySelectorAll("input[name=" + a + "]")).forEach(function (c) {
            b == c.value ? (c.checked = !0) : (c.checked = !1),
                c.addEventListener("change", function () {
                    document.documentElement.setAttribute(a, c.value),
                        sessionStorage.setItem(a, c.value),
                        "data-layout-width" == a && "boxed" == c.value
                            ? (document.documentElement.setAttribute("data-sidebar-size", "sm-hover"), sessionStorage.setItem("data-sidebar-size", "sm-hover"), (document.getElementById("sidebar-size-small-hover").checked = !0))
                            : "data-layout-width" == a &&
                            "fluid" == c.value &&
                            (document.documentElement.setAttribute("data-sidebar-size", "lg"), sessionStorage.setItem("data-sidebar-size", "lg"), (document.getElementById("sidebar-size-default").checked = !0));
                });
        }),
            Array.from(document.querySelectorAll("#collapseBgGradient .form-check input")).forEach(function (a) {
                var b = document.getElementById("collapseBgGradient");
                1 == a.checked && new bootstrap.Collapse(b, { toggle: !1 }).show(),
                    document.querySelector("[data-bs-target='#collapseBgGradient']").addEventListener("click", function (a) {
                        document.getElementById("sidebar-color-gradient").click();
                    });
            }),

            // Array.from(document.querySelectorAll("[name='data-sidebar']")).forEach(function (a) {
            //     document.querySelector("#collapseBgGradient .form-check input:checked")
            //     ? document.querySelector("[data-bs-target='#collapseBgGradient']").classList.add("active")
            //     : document.querySelector("[data-bs-target='#collapseBgGradient']").classList.remove("active")
            //     a.addEventListener("change", function () {
            //         document.querySelector("#collapseBgGradient .form-check input:checked")
            //             ? document.querySelector("[data-bs-target='#collapseBgGradient']").classList.add("active")
            //             : document.querySelector("[data-bs-target='#collapseBgGradient']").classList.remove("active");
            //     });
            // });

            Array.from(document.querySelectorAll("[name='data-sidebar']")).forEach(function (a) {
                var collapseBgGradient = document.querySelector("[data-bs-target='#collapseBgGradient']");
                var formCheckInput = document.querySelector("#collapseBgGradient .form-check input:checked");

                if (formCheckInput) {
                    collapseBgGradient && collapseBgGradient.classList.add("active");
                } else {
                    collapseBgGradient && collapseBgGradient.classList.remove("active");
                }

                a.addEventListener("change", function () {
                    var formCheckInput = document.querySelector("#collapseBgGradient .form-check input:checked");

                    if (formCheckInput) {
                        collapseBgGradient && collapseBgGradient.classList.add("active");
                    } else {
                        collapseBgGradient && collapseBgGradient.classList.remove("active");
                    }
                });
            });
    }
    function E() {

    }
    function H(b, c, a, d) {
        var e = document.getElementById(a);
        d.setAttribute(b, c), e && document.getElementById(a).click();
    }
    function h() {
        document.webkitIsFullScreen || document.mozFullScreen || document.msFullscreenElement || document.body.classList.remove("fullscreen-enable");
    }
    function x() {
        var a = 0;
        Array.from(document.getElementsByClassName("cart-item-price")).forEach(function (b) {
            a += parseFloat(b.innerHTML);
        }),
            document.getElementById("cart-item-total") && (document.getElementById("cart-item-total").innerHTML = "$" + a.toFixed(2));
    }
    sessionStorage.getItem("defaultAttribute")
        ? (((b = {})["data-layout"] = sessionStorage.getItem("data-layout")),
            (b["data-sidebar-size"] = sessionStorage.getItem("data-sidebar-size")),
            (b["data-layout-mode"] = sessionStorage.getItem("data-layout-mode")),
            (b["data-layout-width"] = sessionStorage.getItem("data-layout-width")),
            (b["data-sidebar"] = sessionStorage.getItem("data-sidebar")),
            (b["data-layout-position"] = sessionStorage.getItem("data-layout-position")),
            (b["data-layout-style"] = sessionStorage.getItem("data-layout-style")),
            (b["data-topbar"] = sessionStorage.getItem("data-topbar")),
            n(b))
        : ((a = document.documentElement.attributes),
            (b = {}),
            Array.from(a).forEach(function (a) {
                var c;
                a && a.nodeName && "undefined" != a.nodeName && ((b[(c = a.nodeName)] = a.nodeValue), sessionStorage.setItem(c, a.nodeValue));
            }),
            sessionStorage.setItem("defaultAttribute", JSON.stringify(b)),
            n(b),
            (a = document.querySelector('.btn[data-bs-target="#theme-settings-offcanvas"]')) && a.click()),
        t(),
        (j = document.getElementById("search-close-options")),
        (o = document.getElementById("search-dropdown")),
        (f = document.getElementById("search-options")) &&
        (f.addEventListener("focus", function () {
            0 < f.value.length ? (o.classList.add("show"), j.classList.remove("d-none")) : (o.classList.remove("show"), j.classList.add("d-none"));
        }),
            f.addEventListener("keyup", function (c) {
                var b, a;
                0 < f.value.length
                    ? (o.classList.add("show"),
                        j.classList.remove("d-none"),
                        (b = f.value.toLowerCase()),
                        (a = document.getElementsByClassName("notify-item")),
                        Array.from(a).forEach(function (a) {
                            var c = a.getElementsByTagName("span") ? a.getElementsByTagName("span")[0].innerText.toLowerCase() : "";
                            c && (a.style.display = c.includes(b) ? "block" : "none");
                        }))
                    : (o.classList.remove("show"), j.classList.add("d-none"));
            }),
            j.addEventListener("click", function () {
                (f.value = ""), o.classList.remove("show"), j.classList.add("d-none");
            }),
            document.body.addEventListener("click", function (a) {
                "search-options" !== a.target.getAttribute("id") && (o.classList.remove("show"), j.classList.add("d-none"));
            })),
        (g = document.getElementById("search-close-options")),
        (k = document.getElementById("search-dropdown-reponsive")),
        (d = document.getElementById("search-options-reponsive")),
        g &&
        k &&
        d &&
        (d.addEventListener("focus", function () {
            0 < d.value.length ? (k.classList.add("show"), g.classList.remove("d-none")) : (k.classList.remove("show"), g.classList.add("d-none"));
        }),
            d.addEventListener("keyup", function () {
                0 < d.value.length ? (k.classList.add("show"), g.classList.remove("d-none")) : (k.classList.remove("show"), g.classList.add("d-none"));
            }),
            g.addEventListener("click", function () {
                (d.value = ""), k.classList.remove("show"), g.classList.add("d-none");
            }),
            document.body.addEventListener("click", function (a) {
                "search-options" !== a.target.getAttribute("id") && (k.classList.remove("show"), g.classList.add("d-none"));
            })),
        (a = document.querySelector('[data-bs-toggle="fullscreen"]')) &&
        a.addEventListener("click", function (a) {
            a.preventDefault(),
                document.body.classList.toggle("fullscreen-enable"),
                document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement
                    ? document.cancelFullScreen
                        ? document.cancelFullScreen()
                        : document.mozCancelFullScreen
                            ? document.mozCancelFullScreen()
                            : document.webkitCancelFullScreen && document.webkitCancelFullScreen()
                    : document.documentElement.requestFullscreen
                        ? document.documentElement.requestFullscreen()
                        : document.documentElement.mozRequestFullScreen
                            ? document.documentElement.mozRequestFullScreen()
                            : document.documentElement.webkitRequestFullscreen && document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
        }),
        document.addEventListener("fullscreenchange", h),
        document.addEventListener("webkitfullscreenchange", h),
        document.addEventListener("mozfullscreenchange", h),
        (p = document.getElementsByTagName("HTML")[0]),
        (a = document.querySelectorAll(".light-dark-mode")) &&
        a.length &&
        a[0].addEventListener("click", function (a) {
            p.hasAttribute("data-layout-mode") && "dark" == p.getAttribute("data-layout-mode") ? H("data-layout-mode", "orange", "layout-mode-orange", p) : H("data-layout-mode", "dark", "layout-mode-dark", p);
        }),
        document.addEventListener("DOMContentLoaded", function () {
            var a = document.getElementsByClassName("code-switcher");
            Array.from(a).forEach(function (a) {
                a.addEventListener("change", function () {
                    var b = a.closest(".card"),
                        c = b.querySelector(".live-preview"),
                        b = b.querySelector(".code-view");
                    a.checked ? (c.classList.add("d-none"), b.classList.remove("d-none")) : (c.classList.remove("d-none"), b.classList.add("d-none"));
                });
            });
        }),
        window.addEventListener("resize", m),
        m(),
        document.addEventListener("scroll", function () {
            var a;
            (a = document.getElementById("page-topbar")) && (50 <= document.body.scrollTop || 50 <= document.documentElement.scrollTop ? a.classList.add("topbar-shadow") : a.classList.remove("topbar-shadow"));
        }),

        document.getElementById("topnav-hamburger-icon") &&
        document.getElementById("topnav-hamburger-icon").addEventListener("click", function () {
            var a = document.documentElement.clientWidth;
            767 < a && document.querySelector(".hamburger-icon").classList.toggle("open"),
                "horizontal" === document.documentElement.getAttribute("data-layout") && (document.body.classList.contains("menu") ? document.body.classList.remove("menu") : document.body.classList.add("menu")),
                "vertical" === document.documentElement.getAttribute("data-layout") &&
                (a < 1025 && 767 < a
                    ? (document.body.classList.remove("vertical-sidebar-enable"),
                        "sm" == document.documentElement.getAttribute("data-sidebar-size") ? document.documentElement.setAttribute("data-sidebar-size", "") : document.documentElement.setAttribute("data-sidebar-size", "sm"))
                    : 1025 < a
                        ? (document.body.classList.remove("vertical-sidebar-enable"),
                            "lg" == document.documentElement.getAttribute("data-sidebar-size") ? document.documentElement.setAttribute("data-sidebar-size", "sm") : document.documentElement.setAttribute("data-sidebar-size", "lg"))
                        : a <= 767 && (document.body.classList.add("vertical-sidebar-enable"), document.documentElement.setAttribute("data-sidebar-size", "lg"))),
                "twocolumn" == document.documentElement.getAttribute("data-layout") &&
                (document.body.classList.contains("twocolumn-panel") ? document.body.classList.remove("twocolumn-panel") : document.body.classList.add("twocolumn-panel"));
        }),
        (c = sessionStorage.getItem("defaultAttribute")),
        (i = JSON.parse(c)),
        (c = document.documentElement.clientWidth),
        "twocolumn" == i["data-layout"] &&
        c < 767 &&
        Array.from(document.getElementById("two-column-menu").querySelectorAll("li")).forEach(function (a) {
            a.addEventListener("click", function (a) {
                document.body.classList.remove("twocolumn-panel");
            });
        }),
        (function () {
            var a = document.querySelectorAll(".counter-value");
            function b(a) {
                return a.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
            a &&
                Array.from(a).forEach(function (a) {
                    !(function f() {
                        var c = +a.getAttribute("data-target"),
                            e = +a.innerText,
                            d = c / 250;
                        d < 1 && (d = 1), e < c ? ((a.innerText = (e + d).toFixed(0)), setTimeout(f, 1)) : (a.innerText = b(c)), b(a.innerText);
                    })();
                });
        })(),
        document.getElementsByClassName("dropdown-item-cart") &&
        ((q = document.querySelectorAll(".dropdown-item-cart").length),
            Array.from(document.querySelectorAll("#page-topbar .dropdown-menu-cart .remove-item-btn")).forEach(function (a) {
                a.addEventListener("click", function (a) {
                    q--,
                        this.closest(".dropdown-item-cart").remove(),
                        Array.from(document.getElementsByClassName("cartitem-badge")).forEach(function (a) {
                            a.innerHTML = q;
                        }),
                        x(),
                        document.getElementById("empty-cart") && (document.getElementById("empty-cart").style.display = 0 == q ? "block" : "none"),
                        document.getElementById("checkout-elem") && (document.getElementById("checkout-elem").style.display = 0 == q ? "none" : "block");
                });
            }),
            Array.from(document.getElementsByClassName("cartitem-badge")).forEach(function (a) {
                a.innerHTML = q;
            }),
            document.getElementById("empty-cart") && (document.getElementById("empty-cart").style.display = "none"),
            document.getElementById("checkout-elem") && (document.getElementById("checkout-elem").style.display = "block"),
            x()),
        document.getElementsByClassName("notification-check") &&
        Array.from(document.querySelectorAll(".notification-check input")).forEach(function (a) {
            a.addEventListener("click", function (a) {
                a.target.closest(".notification-item").classList.toggle("active");
            });
        }),
        [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')).map(function (a) {
            return new bootstrap.Tooltip(a);
        }),
        [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]')).map(function (a) {
            return new bootstrap.Popover(a);
        }),
        document.getElementById("reset-layout") &&
        document.getElementById("reset-layout").addEventListener("click", function () {
            sessionStorage.clear(), window.location.reload();
        }),
        (a = document.querySelectorAll("[data-toast]")),
        Array.from(a).forEach(function (a) {
            a.addEventListener("click", function () {
                var b = {},
                    c = a.attributes;
                c["data-toast-text"] && (b.text = c["data-toast-text"].value.toString()),
                    c["data-toast-gravity"] && (b.gravity = c["data-toast-gravity"].value.toString()),
                    c["data-toast-position"] && (b.position = c["data-toast-position"].value.toString()),
                    c["data-toast-className"] && (b.className = c["data-toast-className"].value.toString()),
                    c["data-toast-duration"] && (b.duration = c["data-toast-duration"].value.toString()),
                    c["data-toast-close"] && (b.close = c["data-toast-close"].value.toString()),
                    c["data-toast-style"] && (b.style = c["data-toast-style"].value.toString()),
                    c["data-toast-offset"] && (b.offset = c["data-toast-offset"]),
                    Toastify({
                        newWindow: !0,
                        text: b.text,
                        gravity: b.gravity,
                        position: b.position,
                        className: "bg-" + b.className,
                        stopOnFocus: !0,
                        offset: { x: b.offset ? 50 : 0, y: b.offset ? 10 : 0 },
                        duration: b.duration,
                        close: "close" == b.close,
                        style: "style" == b.style ? { background: "linear-gradient(to right, #0AB39C, #405189)" } : "",
                    }).showToast();
            });
        }),
        (a = document.querySelectorAll("[data-choices]")),
        Array.from(a).forEach(function (c) {
            var b = {},
                a = c.attributes;
            a["data-choices-groups"] && (b.placeholderValue = "This is a placeholder set in the config"),
                a["data-choices-search-false"] && (b.searchEnabled = !1),
                a["data-choices-search-true"] && (b.searchEnabled = !0),
                a["data-choices-removeItem"] && (b.removeItemButton = !0),
                a["data-choices-sorting-false"] && (b.shouldSort = !1),
                a["data-choices-sorting-true"] && (b.shouldSort = !0),
                a["data-choices-multiple-remove"] && (b.removeItemButton = !0),
                a["data-choices-limit"] && (b.maxItemCount = a["data-choices-limit"].value.toString()),
                a["data-choices-limit"] && (b.maxItemCount = a["data-choices-limit"].value.toString()),
                a["data-choices-editItem-true"] && (b.maxItemCount = !0),
                a["data-choices-editItem-false"] && (b.maxItemCount = !1),
                a["data-choices-text-unique-true"] && (b.duplicateItemsAllowed = !1),
                a["data-choices-text-disabled-true"] && (b.addItems = !1),
                a["data-choices-text-disabled-true"] ? new Choices(c, b).disable() : new Choices(c, b);
        }),
        (a = document.querySelectorAll("[data-provider]")),
        Array.from(a).forEach(function (d) {
            var c, b, a;
            "flatpickr" == d.getAttribute("data-provider")
                ? ((a = {}),
                    (c = d.attributes)["data-date-format"] && (a.dateFormat = c["data-date-format"].value.toString()),
                    c["data-enable-time"] && ((a.enableTime = !0), (a.dateFormat = c["data-date-format"].value.toString() + " H:i")),
                    c["data-altFormat"] && ((a.altInput = !0), (a.altFormat = c["data-altFormat"].value.toString())),
                    c["data-minDate"] && ((a.minDate = c["data-minDate"].value.toString()), (a.dateFormat = c["data-date-format"].value.toString())),
                    c["data-maxDate"] && ((a.maxDate = c["data-maxDate"].value.toString()), (a.dateFormat = c["data-date-format"].value.toString())),
                    c["data-deafult-date"] && ((a.defaultDate = c["data-deafult-date"].value.toString()), (a.dateFormat = c["data-date-format"].value.toString())),
                    c["data-multiple-date"] && ((a.mode = "multiple"), (a.dateFormat = c["data-date-format"].value.toString())),
                    c["data-range-date"] && ((a.mode = "range"), (a.dateFormat = c["data-date-format"].value.toString())),
                    c["data-inline-date"] && ((a.inline = !0), (a.defaultDate = c["data-deafult-date"].value.toString()), (a.dateFormat = c["data-date-format"].value.toString())),
                    c["data-disable-date"] && ((b = []).push(c["data-disable-date"].value), (a.disable = b.toString().split(","))),
                    flatpickr(d, a))
                : "timepickr" == d.getAttribute("data-provider") &&
                ((b = {}),
                    (a = d.attributes)["data-time-basic"] && ((b.enableTime = !0), (b.noCalendar = !0), (b.dateFormat = "H:i")),
                    a["data-time-hrs"] && ((b.enableTime = !0), (b.noCalendar = !0), (b.dateFormat = "H:i"), (b.time_24hr = !0)),
                    a["data-min-time"] && ((b.enableTime = !0), (b.noCalendar = !0), (b.dateFormat = "H:i"), (b.minTime = a["data-min-time"].value.toString())),
                    a["data-max-time"] && ((b.enableTime = !0), (b.noCalendar = !0), (b.dateFormat = "H:i"), (b.minTime = a["data-max-time"].value.toString())),
                    a["data-default-time"] && ((b.enableTime = !0), (b.noCalendar = !0), (b.dateFormat = "H:i"), (b.defaultDate = a["data-default-time"].value.toString())),
                    a["data-time-inline"] && ((b.enableTime = !0), (b.noCalendar = !0), (b.defaultDate = a["data-time-inline"].value.toString()), (b.inline = !0)),
                    flatpickr(d, b));
        }),
        Array.from(document.querySelectorAll('.dropdown-menu a[data-bs-toggle="tab"]')).forEach(function (a) {
            a.addEventListener("click", function (a) {
                a.stopPropagation(), bootstrap.Tab.getInstance(a.target).show();
            });
        }),
        r(null === l ? "en" : l),
        (e = document.getElementsByClassName("language")),
        e &&
        Array.from(e).forEach(function (a) {
            a.addEventListener("click", function (b) {
                r(a.getAttribute("data-lang"));
            });
        }),
        s(),
        w(),
        window.addEventListener("resize", function () {
            y && clearTimeout(y), (y = setTimeout(I, 2e3));
        });
})();

