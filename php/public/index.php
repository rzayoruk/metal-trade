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
    <header class="px-[4%] py-4 bg-primary text-white">
        <nav class="flex items-center justify-between">
            <h1 class="text-2xl"><a href="#">Meta<span class="text-secondary">Lunna</span></a></h1>
            <ul class="flex gap-x-8">
                <li class="hover:text-secondary trantisition duration-300"><a href="">Kategoriler</a></li>
                <li class="hover:text-secondary trantisition duration-300"><a href="">Hakkımızda</a></li>
                <li class="hover:text-secondary trantisition duration-300"><a href="">Servisler</a></li>
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


    <section class="pb-16  py-20 relative bg-[url('/assets/img/metal-texture-dark.jpg')] bg-cover px-[4%]">

        <!-- bgimage left -->
        <div class="aspect-[393/455] bg-[url('/assets/img/42tb4et.png')] absolute left-0 bottom-0 bg-no-repeat w-2/6 bg-cover opacity-15 max-w-[480px]">
        </div>
        <!-- bgimage right -->
        <div class="aspect-[848/618] bg-[url('/assets/img/53yj53b.png')] absolute  top-0 right-0 bg-no-repeat w-1/5 bg-cover opacity-10">
        </div>

        <div class="text-white">
            <h2 class="text-3xl text-center font-medium pb-6">Hakkımızda</h2>
            <article class="max-w-[750px] mx-auto text-center text-lg leading-7">
                Metalunna, 10 yıllık deneyimiyle metal parça tasarımı ve üretiminde sektörde kendine sağlam bir yer edinmiş, uzman bir firmadır. AutoCAD, SolidWorks ve CATIA gibi ileri teknoloji çizim programlarıyla, müşterilerinin ihtiyaçlarına uygun, yüksek hassasiyette teknik çizimler sunmaktadır. Hem tekil tasarımlar hem de seri üretime uygun çözümler sağlayarak, projelerin tüm aşamalarında kalite ve verimlilikten ödün vermeyen bir hizmet anlayışını benimsemektedir. <br><br> Metalunna, yalnızca metal parça tasarımı ve üretimiyle kalmayıp hammadde ve sac satışı da yaparak geniş bir ürün ve hizmet yelpazesi sunmaktadır. Yüksek kaliteli ham maddeler ve farklı ölçülerde sac tedariki sayesinde, müşterilerinin üretim süreçlerini eksiksiz desteklemeyi hedeflemektedir. Bu sayede Metalunna, tasarımdan üretime kadar tüm aşamalarda müşteri ihtiyaçlarına yönelik bütünsel bir çözüm ortağı olarak hizmet vermektedir. Metalunna, müşteri memnuniyeti ve kaliteli işçilik ile, metal parça üretimi konusunda güvenilir bir iş ortağı olmayı hedeflemektedir.
            </article>
            <div class="text-center pt-8">
                <a href="#" class="py-2.5 px-6 border border-secondary bg-secondary transition duration-200 hover:opacity-90 text-xl rounded-sm">İletişim</a>
            </div>
        </div>
    </section>

    <div class="h-40"></div>

    <footer>
        <div class="grid grid-cols-[2fr_1fr_1fr_1fr] py-20 px-[4%] bg-accent5 grid-flow-col text-white">
            <div>
                <h2 class=" text-xl mb-2"><a class="" href="#">Meta<span class="text-secondary">Lunna</span></a></h2>
                <article class="text-accent6 max-w-[280px] leading-6 mb-2">Güçlü ve Dayanıklı Çözümler İçin Doğru Adres!</article>
                <p class="text-accent6 max-w-[280px]">
                    Australia-
                    175 24th Street, Office 3567 Melbourn, EA 265
                </p>
            </div>
            <div>
                <h2 class="text-xl mb-2 text-secondary">Bağlantılar</h2>
                <ul class="flex flex-col gap-y-1">
                    <li class="text-accent6"><a class="hover:underline transition duration-300 hover:text-white" href="#">Anasayfa</a></li>
                    <li class="text-accent6"><a class="hover:underline transition duration-300 hover:text-white" href="#">Hakkımızda</a></li>
                    <li class="text-accent6"><a class="hover:underline transition duration-300 hover:text-white" href="#">Hizmetlerimiz</a></li>
                    <li class="text-accent6"><a class="hover:underline transition duration-300 hover:text-white" href="#">İletişim</a></li>
                </ul>
            </div>
            <div>
                <h2 class="text-xl mb-2 text-secondary">Servisler</h2>
                <ul class="flex flex-col gap-y-1">
                    <li class="text-accent6"><a class="hover:underline transition duration-300 hover:text-white" href="#">Anasayfa</a></li>
                    <li class="text-accent6"><a class="hover:underline transition duration-300 hover:text-white" href="#">Hakkımızda</a></li>
                    <li class="text-accent6"><a class="hover:underline transition duration-300 hover:text-white" href="#">Hizmetlerimiz</a></li>
                    <li class="text-accent6"><a class="hover:underline transition duration-300 hover:text-white" href="#">İletişim</a></li>
                </ul>
            </div>
            <div class="flex justify-end flex-col">
                <div>

                    <h2 class="text-xl mb-2 text-secondary">Sosyal Medya</h2>
                    <ul class="flex flex-col gap-y-1">
                        <li class="text-accent6"><a class="hover:underline transition duration-300 hover:text-white" href="#">Instagram</a></li>
                        <li class="text-accent6"><a class="hover:underline transition duration-300 hover:text-white" href="#">Facebook</a></li>
                        <li class="text-accent6"><a class="hover:underline transition duration-300 hover:text-white" href="#">X</a></li>
                        <li class="text-accent6"><a class="hover:underline transition duration-300 hover:text-white" href="#">İletişim</a></li>
                    </ul>
                </div>
            </div>
        </div>


        <!-- deep -->

        <div class="bg-primary flex justify-center px-[4%] py-2 text-accent6">
            <div>
                <small>&#169 2024 Metalunna. All Rights Reserved.</small>

            </div>
        </div>
    </footer>



    <!-- <?php if (isset($_SESSION["name"])): ?>
        Welcome <?= $_SESSION["name"] ?>
        <a href="account.php">view my account</a>
        <a href="includes/logout.php">logout</a>
        <?php if ($_SESSION["roleId"] == 2): ?>
            <a href="/admin">Admin Panel</a>
        <?php endif; ?>
    <?php else : ?>
        <a href="login.php">Login</a><br>
        <a href="signup.php">Sign Up</a>
    <?php endif; ?> -->


</body>

</html>