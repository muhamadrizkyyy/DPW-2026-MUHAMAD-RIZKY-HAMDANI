function initCountData(dataInventaris, datapeminjaman) {
  var tot_pinjam = datapeminjaman.length;
  var tot_barang = dataInventaris.length;
  var tot_dipinjam = 0;
  var tot_maintenance = 0;
  dataInventaris.forEach(item => {
    if (item.status == "Dipinjam") {
      tot_dipinjam++;
    } else if (item.status == "Rusak" || item.status == "Perbaikan") {
      tot_maintenance++;
    }
  });

  console.log(tot_pinjam , tot_barang, tot_dipinjam, tot_maintenance);
  

  const totalPinjam = document.querySelector(".total-peminjaman p");
  totalPinjam.innerText = tot_pinjam;

  const totalBarang = document.querySelector(".total-barang p");
  totalBarang.innerText = tot_barang;

  const totalDipinjam = document.querySelector(".dipinjam p");
  totalDipinjam.innerText = tot_dipinjam;

  const totalBarangRusak = document.querySelector(".maintenance p");
  totalBarangRusak.innerText = tot_maintenance;
}

async function muatCountData() {
  try {
    const peminjaman = await fetch("./data/peminjaman.json");
    if (!peminjaman.ok) {
      throw new Error(
        "Gagal mengambil data peminjaman (status " + peminjaman.status + ")",
      );
    }
    const datapeminjaman = await peminjaman.json();

    const data = await fetch("./data/inventaris.json");
    if (!data.ok) {
      throw new Error("Data tidak ditemukan, error code :" + data.status);
    }
    const dataInventaris = await data.json();

    initCountData(dataInventaris, datapeminjaman);
  } catch (error) {
    console.log(error.message);
  }
}

muatCountData();