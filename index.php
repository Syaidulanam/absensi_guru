<?php
require_once 'config.php';

// Fetch settings
$query_setting = mysqli_query($conn, "SELECT * FROM setting LIMIT 1");
$setting = mysqli_fetch_assoc($query_setting);

// Fetch slider images
$query_slider = mysqli_query($conn, "SELECT * FROM slider_foto");
$sliders = [];
while ($row = mysqli_fetch_assoc($query_slider)) {
    $sliders[] = $row['file_path'];
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Guru -
        <?php echo $setting['nama_sekolah']; ?>
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <style>
        :root {
            --primary-blue: #3b82f6;
            --dark-blue: #1e3a8a;
            --light-blue: #60a5fa;
            --bg-color: #f8fafc;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--bg-color);
            color: #1e293b;
            padding-bottom: 80px;
            /* Space for footer nav */
        }

        /* Header with World Map Background */
        .header {
            background-color: #3b82f6;
            background-image: linear-gradient(rgba(59, 130, 246, 0.8), rgba(59, 130, 246, 0.8)), url('https://upload.wikimedia.org/wikipedia/commons/e/ec/World_Map_Blank.svg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 3000;
            height: 150px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .headmaster-img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            border: 3px solid white;
            object-fit: cover;
        }

        .school-info h2 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 700;
        }

        .school-info p {
            margin: 2px 0 0 0;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .header-right {
            text-align: right;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .school-logo {
            width: 60px;
            height: 60px;
            object-fit: contain;
            background: white;
            border-radius: 5px;
            padding: 2px;
            margin-bottom: 10px;
        }

        .clock-container {
            font-weight: bold;
            font-size: 1.2rem;
        }

        .date-container {
            font-size: 0.85rem;
            opacity: 0.9;
        }

        .welcome-text {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 1.3rem;
            font-weight: bold;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        }

        /* Fixed Top Section (Slider + Support) */
        .fixed-top-wrapper {
            position: fixed;
            top: 180px;
            /* Lowered from 150px */
            left: 0;
            right: 0;
            z-index: 2500;
            display: flex;
            justify-content: center;
            background-color: var(--bg-color);
        }

        .fixed-top-box {
            width: 100%;
            max-width: 600px;
            /* Reverted from 800px */
            background: white;
            padding-top: 5px;
            border-left: 12px solid #3b82f6;
            border-right: 12px solid #3b82f6;
            margin-top: 0;
        }

        @media (max-width: 600px) {
            .fixed-top-wrapper {
                top: 180px;
                margin-top: -30px;
            }

            .fixed-top-box {
                max-width: 100%;
                border-left: none;
                border-right: none;
                border-radius: 30px 30px 0 0;
                padding-top: 20px;
            }
        }

        /* Main Scrollable Area */
        .dashboard-container {
            width: 100%;
            max-width: 600px;
            /* Reverted from 800px */
            margin: 480px auto 20px auto;
            /* Increased margin to account for taller elements */
            background: white;
            border-left: 12px solid #3b82f6;
            border-right: 12px solid #3b82f6;
            border-bottom: 20px solid #3b82f6;
            border-radius: 0 0 20px 20px;
            position: relative;
            z-index: 10;
        }

        @media (max-width: 600px) {
            .dashboard-container {
                max-width: 100%;
                margin: 460px 0 0 0;
                border-left: none;
                border-right: none;
                border-radius: 0;
            }
        }

        .main-content {
            padding: 15px;
        }

        /* Slider - Taller for vertical 'widen' */
        .slider-section {
            width: 100%;
            height: 220px;
            /* Balanced height */
            background: #ffffff;
            overflow: hidden;
            position: relative;
        }

        .slider-wrapper {
            display: flex;
            width: 100%;
            height: 100%;
            transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .slider-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            flex-shrink: 0;
            background: #ffffff;
        }

        /* Support Banner - Taller/Wider Downwards */
        .support-banner {
            background: #0f172a;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 15px;
            /* Increased vertical padding from 10px to 20px */
            margin-top: 5px;
        }

        .support-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .support-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 2px solid #10b981;
            background-size: cover;
            background-position: center top;
        }

        .support-left h4 {
            margin: 0;
            font-size: 0.8rem;
        }

        .support-left p {
            margin: 2px 0 0 0;
            opacity: 0.8;
            font-size: 0.65rem;
        }

        .chat-btn {
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Menu Grid */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px 10px;
            padding: 5px;
        }

        .menu-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #1e293b;
            transition: transform 0.2s;
        }

        .menu-item:active {
            transform: scale(0.95);
        }

        .menu-item img {
            width: 48px;
            height: 48px;
            margin-bottom: 8px;
            object-fit: contain;
        }

        .menu-item span {
            font-size: 0.6rem;
            font-weight: 800;
            text-align: center;
            line-height: 1.2;
            text-transform: uppercase;
        }

        /* Bottom Nav */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
            border-top: 2px solid #3b82f6;
            box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.1);
            z-index: 4000;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #64748b;
            font-size: 0.7rem;
            font-weight: 700;
        }

        .nav-item i {
            font-size: 1.4rem;
            margin-bottom: 4px;
        }

        .nav-item.active {
            color: #3b82f6;
        }

        .presensi-nav {
            position: relative;
            top: -28px;
            background: white;
            padding: 8px;
            border-radius: 50%;
            border: 3px solid #3b82f6;
            width: 68px;
            height: 68px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
        }

        .presensi-nav lord-icon {
            width: 48px;
            height: 48px;
        }
    </style>
</head>

<body>

    <header class="header">
        <div class="header-left">
            <img src="<?php echo !empty($setting['foto_kepala']) ? 'uploads/' . $setting['foto_kepala'] : 'https://i.ibb.co.com/MkkXGzL5/sholeh.jpg'; ?>"
                alt="Kepala Sekolah" class="headmaster-img">
            <div class="school-info">
                <h2><?php echo $setting['nama_kepala']; ?></h2>
                <p><?php echo $setting['nama_sekolah']; ?></p>
            </div>
        </div>
        <div class="header-right">
            <img src="<?php echo !empty($setting['logo_sekolah']) ? 'uploads/' . $setting['logo_sekolah'] : 'https://i.ibb.co.com/zHZhPYTf/1.png'; ?>"
                alt="Logo" class="school-logo">
            <div id="clock" class="clock-container">00:00:00</div>
            <div id="date" class="date-container">Senin, 1 Januari 2024</div>
        </div>
        <div class="welcome-text">Selamat Datang</div>
    </header>

    <div class="fixed-top-wrapper">
        <div class="fixed-top-box">
            <!-- Slider -->
            <div class="slider-section">
                <div class="slider-wrapper" id="slider-wrapper">
                    <?php if (!empty($sliders)): ?>
                        <?php foreach ($sliders as $s): ?>
                            <img src="<?php echo $s; ?>" alt="Slide">
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div
                            style="width:100%; flex-shrink:0; display:flex; align-items:center; justify-content:center; background:#cbd5e1; color:#475569; font-weight:bold;">
                            UNGGAH FOTO SLIDE DI WEB FOTO
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Support Banner -->
            <div class="support-banner">
                <div class="support-left">
                    <div class="support-avatar"
                        style="background-image: url('https://i.ibb.co.com/MkkXGzL5/sholeh.jpg');">
                    </div>
                    <div>
                        <h4>Butuh Bantuan?</h4>
                        <p>Hubungi <strong>Muhammad Sholeh, S.Pd., Gr.</strong></p>
                        <span style="font-size: 0.8rem; color: #94a3b8;">Developer & IT Support</span>
                    </div>
                </div>
                <a href="https://wa.me/6285259393455" target="_blank" class="chat-btn">
                    <i class="fab fa-whatsapp"></i> Chat Admin
                </a>
            </div>
        </div>
    </div>

    <div class="dashboard-container">
        <div class="main-content">
            <!-- Menu Grid -->
            <div class="menu-grid">
                <a href="pages/guru.php" class="menu-item">
                    <img src="https://i.ibb.co.com/DDKHwM3g/Data-guru.png" alt="Data Guru">
                    <span>DATA GURU</span>
                </a>
                <a href="pages/kerja_5_hari.php" class="menu-item">
                    <img src="https://i.ibb.co.com/G4vymJKp/2.png" alt="5 Hari Kerja">
                    <span>5 HARI KERJA</span>
                </a>
                <a href="pages/data_foto.php" class="menu-item">
                    <img src="https://i.ibb.co.com/G4nfR9P6/3.png" alt="Data Foto">
                    <span>DATA FOTO</span>
                </a>
                <a href="pages/data_sekolah.php" class="menu-item">
                    <img src="https://i.ibb.co.com/rGLQjg8R/4.png" alt="Data Sekolah">
                    <span>DATA SEKOLAH</span>
                </a>
                <a href="pages/hari_libur.php" class="menu-item">
                    <img src="https://i.ibb.co.com/YTDHkFYc/5.png" alt="Hari Libur">
                    <span>HARI LIBUR</span>
                </a>
                <a href="pages/print.php" class="menu-item">
                    <img src="https://i.ibb.co.com/VYqvM1tk/6.png" alt="Print">
                    <span>PRINT</span>
                </a>
                <a href="pages/web_foto.php" class="menu-item">
                    <img src="https://i.ibb.co.com/fZNnxRT/7.png" alt="Web Foto">
                    <span>WEB FOTO</span>
                </a>
                <a href="pages/absen_manual.php" class="menu-item">
                    <img src="https://i.ibb.co.com/zWHvtLnY/8.png" alt="Absen Manual">
                    <span>ABSEN MANUAL</span>
                </a>
                <a href="pages/realita_guru.php" class="menu-item">
                    <img src="https://i.ibb.co.com/VcWXd3jL/9.png" alt="Realita Guru">
                    <span>REALITA GURU</span>
                </a>
                <a href="pages/laporan_bulanan.php" class="menu-item">
                    <img src="https://i.ibb.co.com/B20Q5XJ1/Lap-Bulanan.png" alt="Laporan">
                    <span>LAPORAN BULANAN</span>
                </a>
                <a href="pages/lampiran_bulanan.php" class="menu-item">
                    <img src="https://i.ibb.co.com/Mx784tdx/Lampiran-Bulanan.png" alt="Lampiran">
                    <span>LAMPIRAN BULANAN</span>
                </a>
                <a href="pages/edit_lampiran.php" class="menu-item">
                    <img src="https://i.ibb.co.com/k639c3nw/Edit-Lap-Bulanan.png" alt="Edit Lap">
                    <span>EDIT LAP. BULANAN</span>
                </a>
                <a href="pages/sarana_lain.php" class="menu-item">
                    <img src="https://i.ibb.co.com/VYqvM1tk/6.png" alt="Sarana & Lain">
                    <span>SARANA & LAIN</span>
                </a>
            </div>
        </div>
    </div>

    <nav class="bottom-nav">
        <a href="index.php" class="nav-item active">
            <i class="fas fa-home"></i>
            <span>BERANDA</span>
        </a>
        <a href="pages/presensi.php" class="nav-item">
            <div class="presensi-nav">
                <lord-icon src="https://cdn.lordicon.com/rhrmfnhf.json" trigger="hover"
                    colors="primary:#3b82f6,secondary:#2ca58d,tertiary:#ffc738,quaternary:#ebe6ef,quinary:#646e78,senary:#f24c00">
                </lord-icon>
            </div>
            <span>PRESENSI</span>
        </a>
        <a href="pages/setting.php" class="nav-item" style="color: #3b82f6;">
            <i class="fas fa-cog"></i>
            <span>SETTING</span>
        </a>
    </nav>

    <script>
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            document.getElementById('clock').textContent = `${hours} : ${minutes} : ${seconds}`;

            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            const dayName = days[now.getDay()];
            const day = now.getDate();
            const monthName = months[now.getMonth()];
            const year = now.getFullYear();

            document.getElementById('date').textContent = `${dayName}, ${day} ${monthName} ${year}`;
        }

        setInterval(updateClock, 1000);
        updateClock();

        // Improved Sliding Slider
        const sliders = <?php echo json_encode($sliders); ?>;
        let currentSlider = 0;
        const wrapper = document.getElementById('slider-wrapper');

        if (sliders.length > 1 && wrapper) {
            setInterval(() => {
                currentSlider = (currentSlider + 1) % sliders.length;
                wrapper.style.transform = `translateX(-${currentSlider * 100}%)`;
            }, 3000);
        }
    </script>

</body>

</html>