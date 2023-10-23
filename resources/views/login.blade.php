<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
    @vite('resources/css/app.css')
    <title>login</title>
</head>

<body>
    <section class=" min-h-screen flex items-center justify-center">
        <!-- login container -->
        <div class= "flex rounded-2xl shadow  p-5 max-w-4xl items-center">
            <!-- form -->

            <div class="md:w-1/2 px-8  sm:px-16 ">
                <div>
                    <img class="" src="{{ asset('assets/icons/projectLogo.svg') }}" alt="">
                </div>

                <h2 class="font-bold text-2xl mt-16 text-[#000000]">Log In</h2>
                <form action="" class="flex flex-col gap-4">
                    <div class="relative mt-16">
                    <label for="" class="">Email</label>
                    <input class="p-2 pl-5 relative  focus:outline-none  border-b border-black w-full " type="email"
                        name="email" placeholder="Email">
                        <svg class="absolute top-[60%] " width="17" height="12" viewBox="0 0 17 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M1.49414 0H15.5059C16.3297 0 17 0.670272 17 1.49414V10.1529C17 10.9768 16.3297 11.6471 15.5059 11.6471H1.49414C0.670271 11.6471 0 10.9768 0 10.1529V1.49414C0 0.670272 0.670271 0 1.49414 0ZM1.68914 0.996094L1.88856 1.16214L7.90719 6.17386C8.25071 6.45987 8.74936 6.45987 9.09281 6.17386L15.1114 1.16214L15.3109 0.996094H1.68914ZM16.0039 1.71521L11.1001 5.79863L16.0039 9.06226V1.71521ZM1.49414 10.651H15.5059C15.7465 10.651 15.9478 10.4794 15.9939 10.2522L10.3014 6.46365L9.73018 6.93932C9.37377 7.23609 8.93685 7.38447 8.49997 7.38447C8.06308 7.38447 7.62619 7.23609 7.26976 6.93932L6.69853 6.46365L1.00605 10.2521C1.05221 10.4794 1.25348 10.651 1.49414 10.651ZM0.996094 9.06226L5.89993 5.79866L0.996094 1.71521V9.06226Z" fill="#000842"/>
                          </svg>
                    </div>
                    <div class="relative">
                    <label for="">Password</label>
                    <input class="p-2 pl-5 border-black focus:outline-none border-b w-full" type="password" name="password"
                        placeholder="Password">
                        <svg  width="13" height="17" viewBox="0 0 13 17" fill="none" class="absolute 
                        top-[60%] "
                        xmlns="http://www.w3.org/2000/sv">
                        <path
                            d="M10.6318 7.2296V4.53742C10.639 3.31927 10.1524 2.14798 9.28387 1.29383C8.44414 0.457706 7.34492 0 6.18084 0C6.16282 0 6.14119 0 6.12317 0C3.64003 0.00360399 1.62179 2.03625 1.62179 4.53742V7.2296C0.684757 7.34132 0 8.12699 0 9.07844V15.1259C0 16.1531 0.821709 17 1.84884 17H10.4083C11.4354 17 12.2572 16.1531 12.2572 15.1259V9.07844C12.2535 8.13059 11.5688 7.34132 10.6318 7.2296ZM2.33899 4.53742H2.34259C2.34259 2.43269 4.04007 0.709985 6.12678 0.709985H6.13038C7.12148 0.706381 8.07293 1.09922 8.7757 1.79839C9.50731 2.52279 9.91457 3.51028 9.90736 4.53742V7.2332H9.11448V4.53742C9.12169 3.71931 8.79733 2.93364 8.21709 2.35701C7.66928 1.8092 6.92686 1.49926 6.152 1.49926H6.13038C4.47255 1.49926 3.13186 2.86156 3.13186 4.53381V7.2332H2.33899V4.53742ZM8.39729 4.53742V7.2332H3.85626V4.53742C3.85626 3.26161 4.87259 2.22366 6.13398 2.22366H6.15561C6.73945 2.22366 7.30167 2.45792 7.71613 2.87238C8.15582 3.31206 8.40449 3.91393 8.39729 4.53742ZM11.5688 15.1367C11.5688 15.7674 11.057 16.2792 10.4263 16.2792H1.86326C1.23256 16.2792 0.720797 15.7674 0.720797 15.1367V9.09646C0.720797 8.46576 1.23256 7.954 1.86326 7.954H10.4263C11.057 7.954 11.5688 8.46576 11.5688 9.09646V15.1367Z"
                            fill="#000842" />
                    </svg>
                  </div>
                  <a href="" class="text-[#FF0000] text-[12px]/[18px] text-end m-0 	">forget your password</a>
                    <button
                        class="bg-[#930027] rounded-full text-white py-2 hover:scale-105 duration-300">Login</button>
                </form>
            </div>

            <!-- image -->
            <div class="md:block hidden w-1/2">
                <img class="rounded-2xl" src="{{ asset('assets/images/loginPage.svg') }}">
            </div>
        </div>
    </section>
</body>

</html>
