document.addEventListener("DOMContentLoaded", muatBuku);

async function muatBuku() {
    const tbody = document.querySelector(".table-responsive tbody")
    const loading = document.getElementById("loading-indicator")

    if (!tbody) {
        return
    }

    loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        await new Promise((resolve) => setTimeout(resolve, 1000));

        const buku = await fetch("./../data/buku.json");
        if (!buku.ok) {
            throw new Error("Gagal mengambil data (status " + buku.status + ")")
        }
        const dataBuku = await buku.json();
        dataBuku.forEach(function (buku) {
            const tr = document.createElement("tr");
            tr.innerHTML =
                "<td>" + buku.judul + "</td>" +
                "<td>" + buku.pengarang + "</td>" +
                "<td>" + buku.tahun + "</td>" +
                "<td>" + buku.stok + "</td>" +
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