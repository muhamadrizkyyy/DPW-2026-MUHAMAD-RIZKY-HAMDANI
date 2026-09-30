document.addEventListener("DOMContentLoaded", muatMember);

async function muatMember() {
    const tbody = document.querySelector(".table-responsive tbody")
    const loading = document.getElementById("loading-indicator")

    if (!tbody) {
        return
    }

    loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        await new Promise((resolve) => setTimeout(resolve, 1000));

        const member = await fetch("./../data/member.json");
        if (!member.ok) {
            throw new Error("Gagal mengambil data (status " + member.status + ")")
        }
        const datamember = await member.json();
        datamember.forEach(function (member) {
            const tr = document.createElement("tr");
            tr.innerHTML =
                "<td>" + member.no_anggota + "</td>" +
                "<td>" + member.nama + "</td>" +
                "<td>" + member.alamat + "</td>" +
                "<td>" + member.no_hp + "</td>" +
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