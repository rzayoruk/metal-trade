<?php
require __DIR__ . "/../../autoloader.php";
include "../helpers/httpflags.php";


setCookieFlags();
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link href="assets/css/output.css" rel="stylesheet">
</head>

<body class="bg-[#fafafa]">
    <header class="px-[4%] py-4 bg-[#101b20] text-white">
        <nav class="flex items-center justify-between">
            <h1 class="text-2xl"><a href="#">Meta<span class="text-secondary">Lunna</span></a></h1>
            <ul class="flex gap-x-8">
                <li class="hover:text-secondary trantisition duration-300"><a href="">Kategoriler</a></li>
                <li class="hover:text-secondary trantisition duration-300"><a href="">Hakkımızda</a></li>
                <li class="hover:text-secondary trantisition duration-300"><a href="">Servisler</a></li>
                <li class="hover:text-secondary trantisition duration-300"><a href="">Kataloglar</a></li>
                <li class="hover:text-secondary trantisition duration-300"><a href="">İletişim</a></li>
            </ul>
            <a href="#" class="py-2.5 px-6 no-highlight border border-white lg:hover:bg-secondary lg:hover:border-secondary transition duration-200">Giriş Yap</a>


        </nav>
    </header>

    <section class="bg-[url('/assets/img/welding_hero2.png')] aspect-[8/3] bg-no-repeat bg-cover">

    </section>

    <section class="px-[4%] pb-20 bg-[url('/assets/img/42tb4et.png')] bg-left bg-no-repeat">
        <h2 class=" text-3xl font-normal mb-4 pt-16">
            Çok Satanlar
        </h2>
        <div class="grid grid-flow-col grid-cols-5 pt-4 gap-x-10 overflow-x auto-cols-min">




            <div class="flex flex-col  border border-accent3 rounded-md">
                <img src="/assets/img/nut.png" class="aspect-square mb-2 rounded-t-md" alt="">

                <div class="px-3 pb-3">
                    <p class="font-semibold mb-1">Metal Parçalar</p>
                    <p class="text-accent3 mb-2.5 font-normal">Min sipariş Adedi:100</p>

                    <div class="flex justify-between items-center">
                        <p class="font-semibold">Birim Fiyatı:</p>
                        <p class="p-2 bg-secondary inline rounded-md text-white">2.40 TL</p>

                    </div>
                </div>
            </div>
            <div class="flex flex-col  border border-accent3 rounded-md">
                <img src="/assets/img/nut.png" class="aspect-square mb-2 rounded-t-md" alt="">

                <div class="px-3 pb-3">
                    <p class="font-semibold mb-1">Metal Parçalar</p>
                    <p class="text-accent3 mb-2.5 font-normal">Min sipariş Adedi:100</p>

                    <div class="flex justify-between items-center">
                        <p class="font-semibold">Birim Fiyatı:</p>
                        <p class="p-2 bg-secondary inline rounded-md text-white">2.40 TL</p>

                    </div>
                </div>
            </div>
            <div class="flex flex-col  border border-accent3 rounded-md">
                <img src="/assets/img/nut.png" class="aspect-square mb-2 rounded-t-md" alt="">

                <div class="px-3 pb-3">
                    <p class="font-semibold mb-1">Metal Parçalar</p>
                    <p class="text-accent3 mb-2.5 font-normal">Min sipariş Adedi:100</p>

                    <div class="flex justify-between items-center">
                        <p class="font-semibold">Birim Fiyatı:</p>
                        <p class="p-2 bg-secondary inline rounded-md text-white">2.40 TL</p>

                    </div>
                </div>
            </div>
            <div class="flex flex-col  border border-accent3 rounded-md">
                <img src="/assets/img/nut.png" class="aspect-square mb-2 rounded-t-md" alt="">

                <div class="px-3 pb-3">
                    <p class="font-semibold mb-1">Metal Parçalar</p>
                    <p class="text-accent3 mb-2.5 font-normal">Min sipariş Adedi:100</p>

                    <div class="flex justify-between items-center">
                        <p class="font-semibold">Birim Fiyatı:</p>
                        <p class="p-2 bg-secondary inline rounded-md text-white">2.40 TL</p>

                    </div>
                </div>
            </div>
            <div class="flex flex-col  border border-accent3 rounded-md">
                <img src="/assets/img/nut.png" class="aspect-square mb-2 rounded-t-md" alt="">

                <div class="px-3 pb-3">
                    <p class="font-semibold mb-1">Metal Parçalar</p>
                    <p class="text-accent3 mb-2.5 font-normal">Min sipariş Adedi:100</p>

                    <div class="flex justify-between items-center">
                        <p class="font-semibold">Birim Fiyatı:</p>
                        <p class="p-2 bg-secondary inline rounded-md text-white">2.40 TL</p>

                    </div>
                </div>
            </div>





        </div>
    </section>


    <section class="pb-16 bg-accent5 h-[800px] relative">

        <!-- bgimage left -->
        <div class="aspect-[393/455] bg-[url('/assets/img/42tb4et.png')] absolute  bottom-0 bg-no-repeat w-[393px] bg-cover opacity-20">
        </div>
        <!-- bgimage right -->
        <div class="aspect-[393/455] bg-[url('/assets/img/53yj53b.png')] absolute  top-0 right-0 bg-no-repeat w-[393px] bg-cover opacity-20">
        </div>
    </section>

    <div class="h-40"></div>


    <?php if (isset($_SESSION["name"])): ?>
        Welcome <?= $_SESSION["name"] ?>
        <a href="account.php">view my account</a>
        <a href="includes/logout.php">logout</a>
        <?php if ($_SESSION["roleId"] == 2): ?>
            <a href="/admin">Admin Panel</a>
        <?php endif; ?>
    <?php else : ?>
        <a href="login.php">Login</a><br>
        <a href="signup.php">Sign Up</a>
    <?php endif; ?>


</body>

</html>