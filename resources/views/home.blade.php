<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JUDUL</title>

    <!-- Tailwind & Flowbite -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <!-- Navbar -->
    <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
      <div class="max-w-screen-full flex flex-wrap items-center justify-between mx-auto p-4">
        <!-- Kiri -->
        <a href="" class="flex items-center space-x-3 rtl:space-x-reverse">
          <img
            src="https://w7.pngwing.com/pngs/606/201/png-transparent-mississauga-library-system-school-library-public-library-online-public-access-catalog-library-miscellaneous-trademark-logo.png"
            class="h-8"
            alt="Logo"
          />
          <span
            class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white"
            >Perpustakaan</span
          >
        </a>

        <!-- Tengah -->
        <div class="flex-grow flex justify-center md:order-1">
          <div class="relative w-1/2 mx-20 hidden md:block">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
              <svg
                class="w-4 h-4 text-gray-500 dark:text-gray-400"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 20 20"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                />
              </svg>
              <span class="sr-only">Search icon</span>
            </div>
            <input
              type="text"
              id="search-navbar"
              class="w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="Cari judul buku kamu disini !"
            />
          </div>
        </div>

        <!-- Kanan -->
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <button
              id="dropdownDividerButton"
              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              type="button"
              onclick="toggleDrawer()"
              >
              Hi, {{ explode(' ', Auth::user()->name)[0] }}
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky"></div>
      </div>
    </nav>
    <!-- Dropdown menu -->
    <div id="dropdownDivider" class="absolute right-1 top-20 z-10 md:right-1 md:w-56 md:top-16 md:z-20 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
      <ul
        class="py-2 text-sm text-gray-700 dark:text-gray-200"
        aria-labelledby="dropdownDividerButton"
      >       
        <li>
          <a
            href="#"
            class="md:hidden block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
            >Search</a
          >
        </li>
        <li>
          <a
            href="#"
            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
            >Home</a
          >
        </li>
        <li>
          <a
            href="#"
            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
            >History</a
          >
        </li>
        <li>
          <a
            href="#"
            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
            >Settings</a
          >
        </li>
      </ul>
      <div class="py-2">
        <a
          href="#"
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
          >Logout</a
        >
      </div>
    </div>

    <div class="p-3 mt-28 flex justify-center items-center flex-col gap-4 md:grid md:grid-cols-4 md:gap-4 md:justify-center md:justify-items-center">
      <div class="w-96  bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
          <img
            class="rounded-t-lg max-h-60 w-full object-cover object-center"
            src="https://marketplace.canva.com/EAFQkSHF0OM/2/0/1003w/canva-coklat-hijau-illustrasi-pemandangan-sampul-buku-kedamaian-HdpxHRHUaPc.jpg"
            alt=""
          />
        </a>
        <div class="p-5">
          <a href="#">
            <h5
              class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
            >
              Judul Buku
            </h5>
          </a>
          <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
            Penulis Buku
          </p>
          <a
            href="#"
            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          >
            Read more
            <svg
              class="rtl:rotate-180 w-3.5 h-3.5 ms-2"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 14 10"
            >
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M1 5h12m0 0L9 1m4 4L9 9"
              />
            </svg>
          </a>
        </div>
      </div>
    </div>

    <!-- SCRIPT -->
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script>
      function toggleDrawer() {
          const drawer = document.getElementById('dropdownDivider');
          drawer.classList.toggle('hidden');
      }
  
      window.onclick = function(event) {
          const drawer = document.getElementById('dropdownDivider');
          const button = document.getElementById('dropdownDividerButton');
          if (!drawer.contains(event.target) && !button.contains(event.target)) {
              drawer.classList.add('hidden');
          }
      }
  </script>
  </body>
</html>
