let html5QrCodeAnggota;
let html5QrCodeBuku;

function stopScanner() {
  if (html5QrCodeAnggota) {
    html5QrCodeAnggota.stop().catch(console.error);
    document.getElementById('scan-anggota-region').style.display = 'none';
  }
  if (html5QrCodeBuku) {
    html5QrCodeBuku.stop().catch(console.error);
    document.getElementById('scan-buku-region').style.display = 'none';
  }
}

document.addEventListener('DOMContentLoaded', function () {
  // === Fungsi parsing teks QR anggota ===
  function parseMemberData(text) {
    const result = {
      Nama: '',
      no_anggota: '',
      Kelas: '',
    };

    try {
      // Split text into lines and process each line
      const lines = text.split('\n');

      lines.forEach((line) => {
        if (line.includes('Nama:')) {
          result.Nama = line.split('Nama:')[1].trim();
        } else if (line.includes('No Anggota:')) {
          result['No Anggota'] = line.split('No Anggota:')[1].trim();
        } else if (line.includes('Kelas:')) {
          result.Kelas = line.split('Kelas:')[1].trim();
        }
      });
    } catch (e) {
      console.error('Error parsing QR text:', e);
    }

    return result;
  }

  // === SCAN ANGGOTA ===
  const scanAnggotaBtn = document.getElementById('scan-anggota-btn');
  const closeAnggotaBtn = document.getElementById('close-anggota-scan');
  const scanAnggotaRegion = document.getElementById('scan-anggota-region');
  const anggotaSelect = document.getElementById('id_anggota');
  const noAnggotaInput = document.getElementById('no_anggota');

  function pilihAnggota(noAnggotaScan) {
    let found = false;

    for (let i = 0; i < anggotaSelect.options.length; i++) {
      const option = anggotaSelect.options[i];
      const optionNo = option.getAttribute('data-no_anggota');

      if (optionNo && optionNo.trim() === noAnggotaScan.trim()) {
        anggotaSelect.value = option.value;
        noAnggotaInput.value = noAnggotaScan;

        console.log('Dipilih:', option.text, '| ID:', option.value);

        found = true;
        break;
      }
    }

    if (!found) {
      alert('Anggota dengan nomor ' + noAnggotaScan + ' tidak ditemukan!');
      anggotaSelect.selectedIndex = 0;
      noAnggotaInput.value = '';
    }
  }

  if (scanAnggotaBtn) {
    scanAnggotaBtn.addEventListener('click', function () {
      scanAnggotaRegion.style.display = 'block';
      html5QrCodeAnggota = new Html5Qrcode('reader-anggota');

      html5QrCodeAnggota
        .start(
          { facingMode: 'environment' },
          { fps: 10, qrbox: 250 },
          (decodedText) => {
            let data;
            try {
              data = JSON.parse(decodedText); // kalau QR JSON
            } catch (e) {
              data = parseMemberData(decodedText); // fallback: QR teks biasa
            }

            const noAnggotaScan = (data['No Anggota'] || '').trim();
            console.log('Hasil scan nomor anggota:', noAnggotaScan);

            pilihAnggota(noAnggotaScan);
            stopScanner();
          },
          (error) => {
            // error scanning bisa diabaikan
          },
        )
        .catch(console.error);
    });
  }

  if (closeAnggotaBtn) {
    closeAnggotaBtn.addEventListener('click', function () {
      stopScanner();
    });
  }

  // === SCAN BUKU ===
  const scanBukuBtn = document.getElementById('scan-buku-btn');
  const closeBukuBtn = document.getElementById('close-buku-scan');
  const scanBukuRegion = document.getElementById('scan-buku-region');

  if (scanBukuBtn) {
    scanBukuBtn.addEventListener('click', function () {
      scanBukuRegion.style.display = 'block';
      html5QrCodeBuku = new Html5Qrcode('reader-buku');

      html5QrCodeBuku
        .start(
          { facingMode: 'environment' },
          { fps: 10, qrbox: 250 },
          (decodedText) => {
            const scannedIsbn = decodedText.trim().replace(/-/g, '');
            const select = document.getElementById('judul');
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
              select.selectedIndex = 0;
            }

            html5QrCodeBuku.stop().catch(console.error);
            scanBukuRegion.style.display = 'none';
          },
          (error) => {
            // error scanning bisa diabaikan
          },
        )
        .catch(console.error);
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
