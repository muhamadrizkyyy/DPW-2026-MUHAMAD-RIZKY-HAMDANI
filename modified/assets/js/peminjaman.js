document.addEventListener("DOMContentLoaded", muatpeminjaman);

async function muatpeminjaman() {
    const tbody = document.querySelector(".table-responsive tbody")
    const loading = document.getElementById("loading-indicator")

    if (!tbody) {
        return
    }

    loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        await new Promise((resolve) => setTimeout(resolve, 1000));

        const peminjaman = await fetch("./../data/peminjaman.json");
        if (!peminjaman.ok) {
            throw new Error("Gagal mengambil data (status " + peminjaman.status + ")")
        }
        const datapeminjaman = await peminjaman.json();
        datapeminjaman.forEach(function (peminjaman) {
            const tr = document.createElement("tr");
            tr.innerHTML =
                "<td>" + peminjaman.no_peminjaman + "</td>" +
                "<td>" + peminjaman.nama_peminjaman + "</td>" +
                "<td>" + peminjaman.asal + "</td>" +
                "<td>" + peminjaman.no_hp + "</td>" +
                "<td>" + peminjaman.tanggal_pinjam + "</td>" +
                "<td>" + peminjaman.tanggal_kembali + "</td>" +
                "<td>" + peminjaman.status + "</td>" +
                "<td>" +
                "<button type=\"button\">Edit</button> " +
                "<button type=\"button\" class=\"btn-hapus\">Hapus</button>" +
                "</td>";
            tbody.appendChild(tr);
        });
    } catch (error) {
        tbody.innerHTML =
            "<tr><td colspan=\"5\">Gagal memuat data: " + error.message + "</td></tr>";
    } finally {
        loading.style.display = "none";
    }
}