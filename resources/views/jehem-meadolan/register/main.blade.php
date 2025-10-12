<section class="sm:section-padding relative">
    <div class="container mx-auto max-w-xl relative">
        <div class="sm:bg-white rounded-lg p-10 sm:shadow-md absolute top-[100%] right-0 left-0 h-screen md:h-auto ">
            <div class="text-left mb-10 flex justify-between items-center">
                <div class="rounded-full border-[1px solid secondary2-100]">
                    <a href="{{ route('home') }}"><i class="fa-solid fa-arrow-left sectionP text-xl"></i></a>
                </div>
            </div>

            <h3 class="capitalize text-2xl md:text-3xl">Selamat Datang di Jehem</h3>
            <p class="sectionP text-secondary2-100 capitalize mt-2 md:text-lg">Yuk registrasi akunmu dulu!</p>

            <form id="registrationForm" class="mt-6 space-y-6">
                <div class="input input-bordered flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor"
                        class="w-4 h-4 opacity-70">
                        <path
                            d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                        <path
                            d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
                    </svg>
                    <input id="name" type="text"
                        class="w-full py-2 pl-2 rounded-md focus:outline-none focus:border-primary2"
                        placeholder="Masukkan Nama Usaha Anda" />
                </div>
                <div class="input input-bordered flex items-center gap-2">
                    <svg fill="currentColor" class="w-4 h-4 opacity-70"
                        viewBox="0 0 512 512"><!-- Font Awesome Free 5.15.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) -->
                        <path
                            d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z" />
                    </svg>
                    <input id="phone_number" type="number"
                        class="w-full py-2 pl-2 rounded-md focus:outline-none focus:border-primary2"
                        placeholder="Masukkan Nomor Telephone Anda" />
                </div>
                <div class="input input-bordered flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                        class="w-4 h-4 opacity-70">
                        <path fill-rule="evenodd"
                            d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z"
                            clip-rule="evenodd" />
                    </svg>
                    <input id="password" type="password"
                        class="w-full py-2 pl-2 rounded-md focus:outline-none focus:border-primary2"
                        placeholder="Masukkan Password Anda" />
                </div>
                <div class="input input-bordered flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                        class="w-4 h-4 opacity-70">
                        <path fill-rule="evenodd"
                            d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z"
                            clip-rule="evenodd" />
                    </svg>
                    <input id="konfirmasi_password" type="password"
                        class="w-full py-2 pl-2 rounded-md focus:outline-none focus:border-primary2"
                        placeholder="Konfirmasi Password" />
                </div>

                <button id="buttonSubmit" type="submit"
                    class="w-full py-2 text-center text-white bg-primary2 hover:bg-hover-primary rounded-md focus:outline-none">Registrasi</button>
            </form>
            <div class="block mt-8 text-center">
                <p class="sectionP">
                    Sudah Memiliki Akun?
                    <a href="/admin/login" class="underline sectionP text-neutral-500">Login Sekarang</a>
                </p>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function registerUser(event) {
        event.preventDefault();

        let buttonSubmit = document.getElementById('buttonSubmit');

        let namaUsaha = document.getElementById('name').value;
        let nomorTelepon = document.getElementById('phone_number').value;
        let password = document.getElementById('password').value;
        let konfirmasiPassword = document.getElementById('konfirmasi_password').value;

        if (password !== konfirmasiPassword) {
            Swal.fire({
                title: "Konfirmasi Password Salah",
                text: "Pastikan konfirmasi password anda sama dengan password yang dimasukkan.",
                icon: "error",
                confirmButtonColor: "#d33",
                confirmButtonText: "OK",
            });
            return;
        }

        axios.post('/api/v1/auth/registration', {
                name: namaUsaha,
                phone_number: nomorTelepon,
                password: password,
            })
            .then(function(response) {
                if (buttonSubmit) {
                    Swal.fire({
                        title: "Registrasi Anda telah berhasil.",
                        text: "Tunggu sebentar, admin akan memverifikasi permintaan Anda",
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/admin/login";
                        }
                    });
                }
            })
            .catch(function(error) {
                Swal.fire({
                    title: "Registrasi Gagal",
                    text: "Terjadi kesalahan saat melakukan registrasi. Silakan coba lagi.",
                    icon: "error",
                    confirmButtonColor: "#d33",
                    confirmButtonText: "OK",
                });
            });
    }

    document.getElementById('registrationForm').addEventListener('submit', registerUser);
</script>
