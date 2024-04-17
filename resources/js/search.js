 /* Méthode de recherche sur tous les champs */
 function searchTable() {
    // Récupération de la valeur saisie dans l'input rechercher
    var input = document.getElementById('searchInput').value;
    console.log(input);
    input = input.toLowerCase();

    // Récupération des lignes de la table
    var rows = document.querySelectorAll('#myTable tbody tr');

    // Parcours de chaque ligne de la table
    for (var i = 0; i < rows.length; i++) {
        // Initialisation d'un flag pour savoir si la ligne doit être affichée ou non
        var showRow = false;

        // Récupération des cellules de la ligne
        var cells = rows[i].querySelectorAll('td');

        // Parcours de chaque cellule de la ligne
        for (var j = 0; j < cells.length; j++) {
            // Récupération du texte de la cellule
            var cellText = cells[j].textContent || cells[j].innerText;
            cellText = cellText.toLowerCase();

            // Vérification si le texte de la cellule contient la valeur saisie dans l'input rechercher
            if (cellText.includes(input)) {
                // Si oui, on met le flag à true et on sort de la boucle des cellules
                showRow = true;
                break;
            }
        }

        // Affichage ou masquage de la ligne en fonction de la valeur du flag
        if (showRow) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }