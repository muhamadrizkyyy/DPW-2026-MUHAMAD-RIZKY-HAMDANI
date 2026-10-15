const refreshButton = document.querySelector(".refresh-btn");
document.addEventListener("DOMContentLoaded", function () {
  muatinventaris();
  refreshButton.addEventListener("click", function () {
    muatinventaris();
  })
});



async function muatinventaris() {
    const tbody = document.querySelector(".table-responsive tbody")
    const loading = document.getElementById("loading-indicator")
    

    if (!tbody) {
        return
    }

    loading.style.display = "block";
    tbody.innerHTML = "";
    refreshButton.style.display = "none";

    try {
        await new Promise((resolve) => setTimeout(resolve, 3000));

        const inventaris = await fetch("./../data/inventaris.json");
        if (!inventaris.ok) {
            throw new Error("Gagal mengambil data (status " + inventaris.status + ")")
        }
        const datainventaris = await inventaris.json();
        var i = 1;
        datainventaris.forEach(function (inventaris) {
            const tr = document.createElement("tr");
            tr.innerHTML =
                "<td>" + i++ + "</td>" +
                "<td>" + inventaris.nama_alat + "</td>" +
                "<td>" + inventaris.status + "</td>" +
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
        refreshButton.style.display = "block";
    }
}