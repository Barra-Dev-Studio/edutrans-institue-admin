<div>
    @guest
    <div class="bg-sky-800 py-4 md:px-16">
        <div class="px-6 md:px-8 flex justify-between items-start md:items-center gap-8 md:gap-4 flex-col md:flex-row py-6 md:py-2">
            <h3 class="text-white">Belajar bersama Edutrans Institute untuk mengembangkan<br>skill dan karir yang dimimpikan</h3>
            <a href="{{ route('register') }}" class="bg-slate-50 text-sky-800 px-6 py-3 rounded font-medium">Daftar sekarang</a>
        </div>
    </div>
    @endguest
    <div class="bg-sky-950 py-10 md:px-16">
        <div class="px-6 md:px-8 grid grid-cols-1 md:grid-cols-12 gap-8 justify-between items-start">
            <div class="md:col-span-5">
                <h3 class="text-white">Education Institute</h3>
                <p class="text-slate-400 font-light mt-3">Edutrans Institute merupakan sebuah platform transformasi edukasi yang memiliki misi untuk menyederhanakan & mempermudah proses
                pembelajaran melalui berbagai pilihan e-course sesuai dengan kebutuhan pelanggan dan industri masa kini tentunya.</p>
                <div class="flex mt-8 items-center gap-4">
                    <div class="w-10 h-10 bg-sky-200 rounded-full flex items-center justify-center">
                        <a href="https://www.youtube.com/c/landersudiarto" class="text-2xl text-sky-950"><i class="bx bxl-youtube"></i></a>
                    </div>
                    <div class="w-10 h-10 bg-sky-200 rounded-full flex items-center justify-center">
                        <a href="https://www.instagram.com/hendipratama/" class="text-2xl text-sky-950"><i class="bx bxl-instagram"></i></a>
                    </div>
                    <div class="w-10 h-10 bg-sky-200 rounded-full flex items-center justify-center">
                        <a href="https://www.tiktok.com/@hendi.motivasi" class="text-2xl text-sky-950"><i class="bx bxl-tiktok"></i></a>
                    </div>
                    <div class="w-10 h-10 bg-sky-200 rounded-full flex items-center justify-center">
                        <a href="https://www.linkedin.com/in/hendi-pratama/" class="text-2xl text-sky-950"><i class="bx bxl-linkedin"></i></a>
                    </div>
                    <div class="w-10 h-10 bg-sky-200 rounded-full flex items-center justify-center">
                        <a href="https://wa.me/6287725774999" class="text-2xl text-sky-950"><i class="bx bxl-whatsapp"></i></a>
                    </div>
                    <div class="w-10 h-10 bg-sky-200 rounded-full flex items-center justify-center">
                        <a href="mailto:edutrans.institute@gmail.com" class="text-2xl text-sky-950"><i class="bx bx-envelope"></i></a>
                    </div>
                </div>
            </div>
            <div class="md:col-span-2">
                <h3 class="text-white mb-3">Menu Edutrans</h3>
                <ul class="list-none text-slate-400 flex flex-col gap-2">
                    <li><a href="{{ route('home')}}" class="!no-underline hover:text-white">Home</a></li>
                    <li><a href="{{ route('blog') }}" class="!no-underline hover:text-white">Blog</a></li>
                    <li><a href="{{ route('courses') }}" class="!no-underline hover:text-white">Courses</a></li>
                    <li><a href="{{ route('about') }}" class="!no-underline hover:text-white">About</a></li>
                    <li><a href="{{ route('terms') }}" class="!no-underline hover:text-white">Syarat & Ketentuan</a></li>
                    <li><a href="{{ route('privacy') }}" class="!no-underline hover:text-white">Kebijakan Privasi</a></li>
                </ul>
            </div>
            <div class="md:col-span-2">
                <h3 class="text-white mb-3">Siap belajar?</h3>
                <ul class="list-none text-slate-400 flex flex-col gap-2">
                    <li><a href="{{ route('login') }}" class="!no-underline hover:text-white">Masuk</a></li>
                    <li><a href="{{ route('register') }}" class="!no-underline hover:text-white">Daftar</a></li>
                </ul>
            </div>
            <div class="md:col-span-3">
                <h3 class="text-white mb-3">Hubungi kami</h3>
                <ul class="list-none text-slate-400 flex flex-col gap-2">
                    <li>Dr. Hendi Pratama, S.Pd., M.A.</li>
                    <li>Email: edutrans.institute@gmail.com</li>
                    <li>Whatsapp: +6287725774999</li>
                    <li>Coach Transformasi Pendidikan</li>
                </ul>
                <p class="text-white mt-8">Copyright © 2023 Edutrans Institute.</p>
            </div>
        </div>
    </div>
</div>
