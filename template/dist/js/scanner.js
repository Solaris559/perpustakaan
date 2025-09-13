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

document.addEventListener("DOMContentLoaded", function () {

  // === Fungsi parsing teks QR anggota ===
  function parseMemberData(text) {
    const result = { Nama: '', 'No Anggota': '', Kelas: '' };

    try {
      const namaIndex = text.indexOf('Nama:');
      const noAnggotaIndex = text.indexOf('No Anggota:');
      const kelasIndex = text.indexOf('Kelas:');

      if (namaIndex !== -1 && noAnggotaIndex !== -1) {
        result.Nama = text.substring(namaIndex + 5, noAnggotaIndex).trim();
      }
      if (noAnggotaIndex !== -1 && kelasIndex !== -1) {
        result['No Anggota'] = text.substring(noAnggotaIndex + 11, kelasIndex).trim();
      } else if (noAnggotaIndex !== -1) {
        result['No Anggota'] = text.substring(noAnggotaIndex + 11).trim();
      }
      if (kelasIndex !== -1) {
        result.Kelas = text.substring(kelasIndex + 6).trim();
      }
    } catch (e) {
      console.error('Error parsing QR text:', e);
    }

    return result;
  }

  // === Elemen Anggota ===
  const scanAnggotaBtn = document.getElementById('scan-anggota-btn');
  const closeAnggotaBtn = document.getElementById('close-anggota-scan');
  const scanAnggotaRegion = document.getElementById('scan-anggota-region');
  const anggotaSelect = document.getElementById('id_anggota');
  const noAnggotaInput = document.getElementById('no_anggota');
  const namaAnggotaInput = document.getElementById('nama_anggota_scan'); 
  const idAnggotaHidden = document.getElementById('id_anggota_hidden');

  function pilihAnggota(noAnggotaScan) {
    let found = false;

    for (let i = 0; i < anggotaSelect.options.length; i++) {
      const option = anggotaSelect.options[i];
      const optionNo = option.getAttribute("data-no_anggota");

      if (optionNo && optionNo.trim() === noAnggotaScan.trim()) {
        // isi hidden id
        idAnggotaHidden.value = option.value;

        // tampilkan nama di input text
        anggotaSelect.style.display = 'none';
        namaAnggotaInput.style.display = 'block';
        namaAnggotaInput.value = option.text;

        // isi nomor anggota
        noAnggotaInput.value = noAnggotaScan;

        console.log("Scan berhasil:", option.text, "| ID:", option.value);
        found = true;
        break;
      }
    }

    if (!found) {
      alert("Anggota dengan nomor " + noAnggotaScan + " tidak ditemukan!");
      anggotaSelect.selectedIndex = 0;
      noAnggotaInput.value = "";
      namaAnggotaInput.style.display = 'none';
      anggotaSelect.style.display = 'block';
    }
  }

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
            data = JSON.parse(decodedText); // kalau QR JSON
          } catch (e) {
            data = parseMemberData(decodedText); // fallback: teks biasa
          }

          const noAnggotaScan = (data['No Anggota'] || '').trim();
          console.log('Hasil scan nomor anggota:', noAnggotaScan);

          if (noAnggotaScan) {
            pilihAnggota(noAnggotaScan);
          } else {
            alert("QR tidak valid untuk anggota!");
          }
          stopScanner();
        },
        (error) => { /* abaikan */ }
      ).catch(console.error);
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
  const judulSelect = document.getElementById('judul');
  const isbnInput = document.getElementById('isbn_scan'); // optional input ISBN hasil scan
  const judulInput = document.getElementById('judul_scan'); // optional input judul hasil scan

  function pilihBuku(isbnScan) {
    let found = false;

    for (let i = 0; i < judulSelect.options.length; i++) {
      if (judulSelect.options[i].value === isbnScan) {
        judulSelect.selectedIndex = i;
        if (isbnInput) isbnInput.value = isbnScan;
        if (judulInput) judulInput.value = judulSelect.options[i].text;

        console.log("Scan buku berhasil:", judulSelect.options[i].text, "| ISBN:", isbnScan);
        found = true;
        break;
      }
    }

    if (!found) {
      alert('Judul buku dengan ISBN ' + isbnScan + ' tidak ditemukan dalam daftar.');
      judulSelect.selectedIndex = 0;
      if (isbnInput) isbnInput.value = "";
      if (judulInput) judulInput.value = "";
    }
  }

  if (scanBukuBtn) {
    scanBukuBtn.addEventListener('click', function () {
      scanBukuRegion.style.display = 'block';
      html5QrCodeBuku = new Html5Qrcode("reader-buku");

      html5QrCodeBuku.start(
        { facingMode: "environment" },
        { fps: 10, qrbox: 250 },
        (decodedText) => {
          const scannedIsbn = decodedText.trim().replace(/-/g, '');
          pilihBuku(scannedIsbn);
          stopScanner();
        },
        (error) => { /* abaikan */ }
      ).catch(console.error);
    });
  }

  if (closeBukuBtn) {
    closeBukuBtn.addEventListener('click', function () {
      stopScanner();
    });
  }
});
