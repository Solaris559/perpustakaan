// assets/js/scan-handler.js

let html5QrCodeAnggota;
let html5QrCodeBuku;

document.addEventListener("DOMContentLoaded", function () {

  function parseMemberData(text) {
    // Contoh input: "Nama: tamu JahatNo Anggota: 008Kelas: 8C"
    const result = {
      Nama: '',
      'No Anggota': '',
      Kelas: ''
    };

    try {
      const namaIndex = text.indexOf('Nama:');
      const noAnggotaIndex = text.indexOf('No Anggota:');
      const kelasIndex = text.indexOf('Kelas:');

      if (namaIndex !== -1 && noAnggotaIndex !== -1) {
        result.Nama = text.substring(namaIndex + 5, noAnggotaIndex).trim();
      }
      if (noAnggotaIndex !== -1 && kelasIndex !== -1) {
        result['No Anggota'] = text.substring(noAnggotaIndex + 11, kelasIndex).trim();
      }
      if (kelasIndex !== -1) {
        result.Kelas = text.substring(kelasIndex + 6).trim();
      }
    } catch (e) {
      // jika error biarkan kosong saja
    }

    return result;
  }

  // SCAN ANGGOTA
  const scanAnggotaBtn = document.getElementById('scan-anggota-btn');
  const closeAnggotaBtn = document.getElementById('close-anggota-scan');
  const scanAnggotaRegion = document.getElementById('scan-anggota-region');

  if (scanAnggotaBtn) {
    scanAnggotaBtn.addEventListener('click', function () {
      scanAnggotaRegion.style.display = 'block';
      html5QrCodeAnggota = new Html5Qrcode("reader-anggota");

      html5QrCodeAnggota.start(
        { facingMode: "environment" },
        { fps: 10, qrbox: 250 },
        (decodedText) => {
          let data;
          try {
            data = JSON.parse(decodedText);
          } catch (e) {
            data = parseMemberData(decodedText);
          }

          document.getElementById('nama').value = data.Nama || '';
          document.getElementById('no_anggota').value = data['No Anggota'] || '';

          html5QrCodeAnggota.stop();
          scanAnggotaRegion.style.display = 'none';
        },
        (error) => {}
      ).catch(console.error);
    });
  }

  if (closeAnggotaBtn) {
    closeAnggotaBtn.addEventListener('click', function () {
      if (html5QrCodeAnggota) {
        html5QrCodeAnggota.stop().catch(console.error);
      }
      scanAnggotaRegion.style.display = 'none';
    });
  }

  // SCAN BUKU
  const scanBukuBtn = document.getElementById('scan-buku-btn');
  const closeBukuBtn = document.getElementById('close-buku-scan');
  const scanBukuRegion = document.getElementById('scan-buku-region');

  if (scanBukuBtn) {
    scanBukuBtn.addEventListener('click', function () {
      scanBukuRegion.style.display = 'block';
      html5QrCodeBuku = new Html5Qrcode("reader-buku");

      html5QrCodeBuku.start(
        { facingMode: "environment" },
        { fps: 10, qrbox: 250 },
        (decodedText) => {
    // Hilangkan strip jika ada dan trim
    const scannedIsbn = decodedText.trim().replace(/-/g, '');

    let select = document.getElementById('judul');
    let found = false;

    for (let i = 0; i < select.options.length; i++) {
        if (select.options[i].value === scannedIsbn) {
            select.selectedIndex = i;
            found = true;
            break;
        }
    }

    if (!found) {
        alert('Judul buku dari scan tidak ditemukan dalam daftar.');
    }

    html5QrCodeBuku.stop();
    scanBukuRegion.style.display = 'none';
        },
        (error) => {}
      ).catch(console.error);
    });
  }

  if (closeBukuBtn) {
    closeBukuBtn.addEventListener('click', function () {
      if (html5QrCodeBuku) {
        html5QrCodeBuku.stop().catch(console.error);
      }
      scanBukuRegion.style.display = 'none';
    });
  }

});
