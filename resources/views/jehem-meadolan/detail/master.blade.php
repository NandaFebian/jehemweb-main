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
    @yield('product-desc')
    @yield('review')
    @yield('another')
    @yield('footer')
  </main>

  <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      let splide = new Splide("#image-carousel", {
        perPage: 3,
        gap: "2rem",
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
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>
</html>