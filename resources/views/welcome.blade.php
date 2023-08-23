<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
<body>
  <div class="bg-[url('https://cdn.pixabay.com/photo/2016/11/14/03/16/book-1822474_1280.jpg')] bg-center bg-cover h-screen">
        <div class='md:flex md:justify-between py-4 px-10'>
            <div class="md:ml-8 ml-0 flex justify-between items-center">
              <div class='text-2xl font-bold text-white py-2'>
                  School
              </div>
              <span class="text-3xl cursor-pointer mx-2 md:hidden block">
                <ion-icon name="menu" onclick="Menu(this)"></ion-icon>
              </span>
            </div>

            <ul class='md:flex md:items-center z-[10] absolute md:z-auto md:static w-full left-0 md:w-auto md:py-0 py-4 md:pl-0 md:opacity-100 opacity-0 top-[-400px] transition-all ease-in duration-500 bg-slate-200 md:bg-transparent md:text-white'>
                <li class="hover:bg-slate-400 w-26 py-2 px-2 mx-2 rounded-full duration-500">Home</li>
                <li class="hover:bg-slate-400 w-26 py-2 px-2 mx-2 rounded-full duration-500">About</li>
                <li class="hover:bg-slate-400 w-26 py-2 px-2 mx-2 rounded-full duration-500">Register</li>
            </ul>
       </div>

            <div class="flex flex-col absolute top-20 left-[50%] translate-x-[-50%] text-center">
              <h1 class="text-[40px] m-auto font-bold">SCHOOL CODING
              </h1>
              <p class="whitespace-nowrap pt-1 text-[16px] text-[#5c5d61]">
                  Upgrade Skill
                  <span class="underline underline-offset-4 hover:decoration-2 cursor-pointer">
                      Keep Learning
                  </span>
              </p>
            </div>

          <div class="md:space-x-4 absolute bottom-[80px] left-[50%] translate-x-[-50%]">
              <button class="mt-2 md:mt-0 uppercase bg-slate-200 rounded-full text-gray-900 w-96 h-10 md:w-60">Get Started</button>
          </div>

          <div class="absolute left-[50%] translate-x-[-50%] bottom-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 animate-bounce" viewBox="0 0 20 20"
                  fill="currentColor">
                  <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd" />
              </svg>
          </div>
  </div>
  <script>
     function Menu(e) {
            let list = document.querySelector('ul');
            e.name === 'menu' ? (e.name = "close", list.classList.add('top-[80px]'), list.classList.add('opacity-100')) : (e.name = "menu", list.classList.remove('top-[80px]'), list.classList.remove('opacity-100'))
        }
  </script>
</body>
</html>
