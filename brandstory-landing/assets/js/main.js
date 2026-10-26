/**
 * Brandstory Landing - front-end behaviours.
 * 1. Mobile navigation toggle
 * 2. Accordion (Sets Us Apart, FAQ)
 * 3. Carousel arrows (Team, Case Studies)
 */
(function () {
  "use strict";

  /* 1. Mobile nav ------------------------------------------------------- */
  const navToggle = document.querySelector("[data-nav-toggle]");
  const nav = document.querySelector("[data-nav]");

  if (navToggle && nav) {
    navToggle.addEventListener("click", function () {
      const open = nav.classList.toggle("is-open");
      navToggle.setAttribute("aria-expanded", String(open));
      document.body.classList.toggle("nav-open", open);
    });
  }

  /* 2. Accordion -------------------------------------------------------- */
  document.querySelectorAll("[data-accordion]").forEach(function (accordion) {
    const items = accordion.querySelectorAll("[data-accordion-item]");

    items.forEach(function (item) {
      const trigger = item.querySelector("[data-accordion-trigger]");
      if (!trigger) return;

      trigger.addEventListener("click", function () {
        const isOpen = item.classList.contains("is-open");

        items.forEach(function (other) {
          other.classList.remove("is-open");
          other
            .querySelector("[data-accordion-trigger]")
            .setAttribute("aria-expanded", "false");
        });

        if (!isOpen) {
          item.classList.add("is-open");
          trigger.setAttribute("aria-expanded", "true");
        }
      });
    });
  });

  /* 3. Carousel --------------------------------------------------------- */
  document.querySelectorAll("[data-carousel]").forEach(function (carousel) {
    var track = carousel.querySelector("[data-carousel-track]");
    var scope = carousel.closest("section") || carousel;
    var prev = scope.querySelector("[data-carousel-prev]");
    var next = scope.querySelector("[data-carousel-next]");
    if (!track) return;

    var originals = Array.prototype.slice.call(track.querySelectorAll("[data-carousel-slide]"));
    var count = originals.length;
    var loop = carousel.hasAttribute("data-carousel-loop") && count > 1;
    var copies = 0;

    /* Infinite loop: clone the slide set before and after the originals */
    if (loop) {
      copies = 2;
      var makeClone = function (slide) {
        var clone = slide.cloneNode(true);
        clone.setAttribute("aria-hidden", "true");
        clone.setAttribute("data-carousel-clone", "");
        clone.querySelectorAll("img").forEach(function (img) { img.setAttribute("alt", ""); });
        return clone;
      };
      for (var i = 0; i < copies; i++) {
        originals.forEach(function (slide) { track.appendChild(makeClone(slide)); });
        originals.slice().reverse().forEach(function (slide) { track.insertBefore(makeClone(slide), track.firstChild); });
      }
    }

    var slides = Array.prototype.slice.call(track.querySelectorAll("[data-carousel-slide]"));

    var gap = function () { return parseFloat(getComputedStyle(track).gap) || 0; };
    var step = function () { return slides[0].offsetWidth + gap(); };
    var setWidth = function () { return count * step(); };

    var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    var centerOn = function (slide, smooth) {
      var left = slide.offsetLeft + slide.offsetWidth / 2 - track.clientWidth / 2;
      track.scrollTo({ left: left, behavior: smooth && !reduceMotion ? "smooth" : "auto" });
    };

    var activeIndex = 0;
    var markActive = function () {
      var center = track.scrollLeft + track.clientWidth / 2;
      var best = 0;
      var bestDist = Infinity;
      slides.forEach(function (slide, index) {
        var dist = Math.abs(slide.offsetLeft + slide.offsetWidth / 2 - center);
        if (dist < bestDist) { bestDist = dist; best = index; }
      });
      activeIndex = best;
      slides.forEach(function (slide, index) { slide.classList.toggle("is-active", index === best); });
    };

    /* When the user scrolls into a cloned set, jump silently by one set width */
    var pending = null; /* index the buttons are heading to while a smooth scroll runs */
    var normalise = function () {
      pending = null;
      if (!loop) return;
      var sw = setWidth();
      var lower = sw * copies * 0.5;
      var upper = sw * (copies + 1.5);
      if (track.scrollLeft < lower) {
        track.scrollTo({ left: track.scrollLeft + sw, behavior: "auto" });
      } else if (track.scrollLeft > upper) {
        track.scrollTo({ left: track.scrollLeft - sw, behavior: "auto" });
      }
    };

    /* Highlight follows the scroll; the wrap check runs once scrolling settles.
       scrollend is used where available, with a debounce as a safety net. */
    var settleTimer;
    track.addEventListener("scroll", function () {
      markActive();
      clearTimeout(settleTimer);
      settleTimer = setTimeout(normalise, 150);
    });
    if ("onscrollend" in window) {
      track.addEventListener("scrollend", function () { clearTimeout(settleTimer); normalise(); });
    }

    var go = function (direction) {
      var from = pending === null ? activeIndex : pending;
      var target = Math.max(0, Math.min(slides.length - 1, from + direction));
      pending = target;
      centerOn(slides[target], true);
    };
    if (prev) prev.addEventListener("click", function () { go(-1); });
    if (next) next.addEventListener("click", function () { go(1); });

    /* Start centred on the middle slide of the original set */
    var startIndex = loop ? copies * count + Math.floor(count / 2) : Math.floor(count / 2);
    if (slides[startIndex]) centerOn(slides[startIndex], false);
    markActive();

    var lastWidth = track.clientWidth;
    window.addEventListener("resize", function () {
      if (track.clientWidth === lastWidth) return;
      lastWidth = track.clientWidth;
      var active = track.querySelector(".is-active") || slides[startIndex];
      if (active) centerOn(active, false);
    });
  });

  /* 4. Count-up stats ---------------------------------------------------- */
  var counters = document.querySelectorAll("[data-counter]");
  var reduceMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)",
  ).matches;

  if (counters.length && "IntersectionObserver" in window && !reduceMotion) {
    var countUp = function (el) {
      var target = parseInt(el.getAttribute("data-counter"), 10) || 0;
      var duration = 1400;
      var start = null;

      var step = function (timestamp) {
        if (!start) start = timestamp;
        var progress = Math.min((timestamp - start) / duration, 1);
        var eased = 1 - Math.pow(1 - progress, 3);
        el.textContent = Math.round(target * eased);
        if (progress < 1) window.requestAnimationFrame(step);
      };
      window.requestAnimationFrame(step);
    };

    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            countUp(entry.target);
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.5 },
    );

    counters.forEach(function (el) {
      observer.observe(el);
    });
  }
})();
