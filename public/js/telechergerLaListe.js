const pdfBtn = document.querySelector('.pdf');
    const exelBtn = document.querySelector('.exel');
    const sortir = document.querySelector('.contFichierType');
    const telechargerListe = document.querySelector('.telechargerListe');

    // Fonction pour récupérer le tableau visible
    function getVisibleTable() {
        return retenu.style.display !== "none"
            ? document.getElementById("ListeRetenuTableau")
            : document.getElementById("ListeAttenteTableau");
    }

    // Export CSV (Excel)
    exelBtn.addEventListener("click", function () {
        const table = getVisibleTable();
        let csv = [];
        table.querySelectorAll("tr").forEach(row => {
            let rowData = [];
            row.querySelectorAll("th, td").forEach(cell => {
                let text = cell.innerText.replace(/"/g, '""');
                rowData.push(`"${text}"`);
            });
            csv.push(rowData.join(","));
        });

        const blob = new Blob([csv.join("\n")], { type: "text/csv;charset=utf-8;" });
        const link = document.createElement("a");
        link.href = URL.createObjectURL(blob);
        link.download = "liste_apprenants.csv";
        link.click();

        sortir.style.scale = "0";
        sortir.style.opacity = "0";
    });

    // Export PDF
    pdfBtn.addEventListener("click", async function () {
        const table = getVisibleTable();
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        let y = 10;

        table.querySelectorAll("tr").forEach(row => {
            let rowText = "";
            row.querySelectorAll("th, td").forEach(cell => {
                rowText += cell.innerText.trim() + " | ";
            });
            doc.text(rowText, 10, y);
            y += 10;
        });

        doc.save("liste_apprenants.pdf");

        sortir.style.scale = "0";
        sortir.style.opacity = "0";
    });

    // Afficher les boutons PDF/Excel
    telechargerListe.addEventListener('click', function () {
        sortir.style.scale = "1";
        sortir.style.opacity = "1";
    });