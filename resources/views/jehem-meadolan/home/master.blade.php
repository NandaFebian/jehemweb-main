<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @vite('resources/css/app.css')
  @include("jehem-meadolan.components.template")
  @yield('meta_data')

</head>

<body>
  
  <main>
    @yield('navbar')
    @yield('hero')
    @yield('trend')
    @yield('product')
    @yield('say')
    @yield('footer')
  </main>

  <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
  
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      let splide = new Splide("#image-carousel", {
        arrows: false,
        perPage: 3,
        gap: "3rem",
        focus: 0,
        omitEnd: true,
        breakpoints: {
          1180: {
            perPage: 2,
          },
          640: {
            perPage: 1,
          },
          575: {
            perPage: 1,
          },
        },
      }).mount();
  
      const btnNext = document.getElementById("btnNext");
      const btnPrev = document.getElementById("btnPrev");
  
      function updateButtonState() {
        var isStart = splide.index <= 0;
        var isEnd = splide.index === splide.length - 1;
  
        btnPrev.disabled = isStart;
        btnPrev.className = isStart
          ? "rounded-full w-[56px] h-[56px] btn bg-gray-400"
          : "rounded-full w-[56px] h-[56px] btn bg-primary2";
  
        btnNext.disabled = isEnd;
        btnNext.className = isEnd
          ? "rounded-full w-[56px] h-[56px] btn bg-gray-400"
          : "rounded-full w-[56px] h-[56px] btn bg-primary2";
      }
  
      btnNext.addEventListener("click", (e) => {
        splide.go("+1");
        updateButtonState();
      });
  
      btnPrev.addEventListener("click", (e) => {
        splide.go("-1");
        updateButtonState();
      });
  
      splide.on("moved", function () {
        updateButtonState();
      });
  
      updateButtonState();
  
      function createNotFoundSlide() {
        const notFoundSlide = document.createElement("li");
        notFoundSlide.className = "";
        notFoundSlide.innerHTML = `
      <div class="flex justify-center">
        <div class="block gap-4 items-center justify-center">
            <img src="./images/notfound.svg" alt="" class="sm:h-[12rem] h-[10rem] mt-6 mx-auto">
            {{-- <i class="fa-solid fa-triangle-exclamation md:text-[40px] sm:text-[35px] xs:text-[30px] text-[25px] bg-red-600"></i> --}}
            <h1 class="md:text-[40px] sm:text-[35px] xs:text-[30px] text-[25px] mt-6 font-jakarta font-extrabold text-center text-primary">No Data</h1>
          </div>
      </div>
      `;
        return notFoundSlide;
      }
    });
  </script>
  
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      let splide = new Splide("#say-carousel", {
        arrows: false,
        perPage: 3,
        gap: "3rem",
        focus: 0,
        omitEnd: true,
        breakpoints: {
          1180: {
            perPage: 2,
          },
          640: {
            perPage: 1,
          },
          575: {
            perPage: 1,
          },
        },
      }).mount();
  
      const btnNext = document.getElementById("btnNext-say");
      const btnPrev = document.getElementById("btnPrev-say");
  
      function updateButtonState() {
        var isStart = splide.index <= 0;
        var isEnd = splide.index === splide.length - 1;
  
        btnPrev.disabled = isStart;
        btnPrev.className = isStart
          ? "rounded-full w-[56px] h-[56px] btn bg-gray-400"
          : "rounded-full w-[56px] h-[56px] btn bg-primary2";
  
        btnNext.disabled = isEnd;
        btnNext.className = isEnd
          ? "rounded-full w-[56px] h-[56px] btn bg-gray-400"
          : "rounded-full w-[56px] h-[56px] btn bg-primary2";
      }
  
      btnNext.addEventListener("click", (e) => {
        splide.go("+1");
        updateButtonState();
      });
  
      btnPrev.addEventListener("click", (e) => {
        splide.go("-1");
        updateButtonState();
      });
  
      splide.on("moved", function () {
        updateButtonState();
      });
  
      updateButtonState();
  
      function createNotFoundSlide() {
        const notFoundSlide = document.createElement("li");
        notFoundSlide.className = "";
        notFoundSlide.innerHTML = `
    <div class="flex justify-center">
      <div class="block gap-4 items-center justify-center">
          <img src="./images/notfound.svg" alt="" class="sm:h-[12rem] h-[10rem] mt-6 mx-auto">
          {{-- <i class="fa-solid fa-triangle-exclamation md:text-[40px] sm:text-[35px] xs:text-[30px] text-[25px] bg-red-600"></i> --}}
          <h1 class="md:text-[40px] sm:text-[35px] xs:text-[30px] text-[25px] mt-6 font-jakarta font-extrabold text-center text-primary">No Data</h1>
        </div>
    </div>
    `;
        return notFoundSlide;
      }
    });
  </script>
  
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      new Splide("#thumbnail-carousel", {
        fixedWidth: 150,
        gap: 20,
        pagination: false,
        drag: "free",
        snap: true,
        perPage: 1,
        arrows: false,
        autoplay: false,
        autoScroll: {
          speed: 1,
        },
        breakpoints: {
          992: {
            gap: 10,
            fixedWidth: 130,
          },
          576: {
            gap: 5,
            fixedWidth: 110,
          },
        },
      }).mount();
    });
  </script>
  

  <script>
    new Splide('.splide', {
      classes: {
        pagination: 'splide__pagination custome-pagination',
        page: 'splide__pagination__page custome-pagination-page',
      },
    });
  </script>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>
</html>